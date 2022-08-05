<?php

namespace App\Http\Repositories\Admin;

use App\Models\TreeType;
use App\Models\Tree;

use App\Http\Interfaces\Admin\TreeTypeInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TreeTypeRepository implements TreeTypeInterface
{

    public function index()
    {

        return view('dashboard.admin.tree_types.index');
    }

    public function data()
    {

        $tree_types = TreeType::with('trees')->get();
        return DataTables::of($tree_types)
            ->addColumn('trees', function (TreeType $tree_type) {
                return view('dashboard.admin.tree_types.btn.related', compact('tree_type'));
            })
            ->addColumn('record_select', 'dashboard.admin.tree_types.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (TreeType $tree_type) {
                return $tree_type->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.tree_types.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();

            TreeType::create([
                'tree_type' => $validated['tree_type']
            ]);


            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('TreeTypes.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }


    }

    public function update($request, $id)
    {

        try {

            $treeTypeID = Crypt::decrypt($id);
            $tree_type = TreeType::findorfail($treeTypeID);
            $tree_type->tree_type = $request->tree_type;

            $tree_type->update();

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('TreeTypes.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();

        }


    }

    public function destroy($id)
    {
        try {
            $data = [];
            $treeTypeID = Crypt::decrypt($id);
            $data['tree'] = Tree::where('tree_type_id', $treeTypeID)->pluck('tree_type_id');
            if ($data['tree']->count() == 0) {
                $treeType = TreeType::findorfail($treeTypeID);

                $treeType->delete();
                toastr()->success(__('Admin/site.deleted_successfully'));
                return redirect()->route('TreeTypes.index');
            } else {
                toastr()->error(__('Admin/trees.cant_delete'));
                return redirect()->route('TreeTypes.index');
            }
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));
            return redirect()->back();

        }

    }


    public function bulkDelete($request)
    {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $tree_type_ids) {
                    $tree_type = TreeType::findorfail($tree_type_ids);
                    $trees = $tree_type->trees->count();
                    if ($trees > 0) {
                        toastr()->error(__('Admin/countries.delete_related_trees'));
                        return redirect()->route('TreeTypes.index');
                    }

                    Country::destroy($tree_type_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('TreeTypes.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('TreeTypes.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

}