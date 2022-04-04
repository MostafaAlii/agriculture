<?php
namespace  App\Http\Repositories\Admin;
use App\Models\TreeType;
use App\Models\Tree;

use App\Http\Interfaces\Admin\TreeInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
class TreeRepository implements TreeInterface {


    public function index() {
        $tree_types = TreeType::get();
        return view('dashboard.admin.trees.index',compact('tree_types'));

    }
    public function data() {

        $trees = Tree::with(['tree_type']);
        return DataTables::of($trees)
            ->addColumn('trees', function (Tree $tree) {
                return view('dashboard.admin.trees.btn.related', compact('tree'));
            })
            ->addColumn('record_select', 'dashboard.admin.trees.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Tree $tree) {
                return $tree->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.trees.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            Tree::create([
                'tree_type_id'=>$validated['tree_type_id'],
                'name'=>$validated['name']
            ]);

            DB::commit();

            toastr()->success(__('Admin/trees.added_successfully'));
            return redirect()->route('Trees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }

    public function update( $request,$id) {

        try{
            DB::beginTransaction();

            $treeID = Crypt::decrypt($id);
            $tree=Tree::findorfail($treeID);
            $tree->tree_type_id = $request->tree_type_id;
            $tree->name = $request->name;
            $tree->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Trees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }
    public function destroy($id) {

        $data = [];
        $treeID = Crypt::decrypt($id);
        $data['tree'] = Tree::where('tree_type_id', $treeID)->pluck('tree_type_id');
        if($data['tree']->count() == 0) {
            $tree=Tree::findorfail($treeID);

            $tree->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Trees.index');
        } else {
            toastr()->error(__('Admin/trees.cant_delete'));
            return redirect()->route('Trees.index');
        }
    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $tree_ids) {
//                    $tree_ids = Crypt::decrypt($tree_ids);
                    $trees = Tree::findorfail($tree_ids);
                    $tree_type = $trees->tree_type->count();
                    if ($tree_type > 0) {
                        toastr()->error(__('Admin/countries.delete_related_trees'));
                        return redirect()->route('Trees.index');
                    }

                    Tree::destroy($tree_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Trees.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Trees.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}