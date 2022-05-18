<?php
namespace App\Http\Repositories\Admin;

use App\Models\Team;
use App\Traits\UploadT;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\TeamInterface;

class TeamRepository implements TeamInterface {
    use UploadT;
    public function index() {
       // dd('fff');
        return view('dashboard.admin.teams.index');
    }
//------------------------------------------------------------------------------------------
    public function data() {
        
        // $t = Team::get();
        $team = Cache::get('teams');
        
        return DataTables::of($team)
            ->addColumn('record_select', 'dashboard.admin.teams.data_table.record_select')
            ->editColumn('created_at', function (Team $team) {
                return $team->created_at->diffforhumans();
            })
            ->editColumn('description', function (Team $team) {
                //remove HTML tags (all) from a string--------
                return substr(strip_tags($team->description),0,50).' ....';
            })
            ->editColumn('image', function (Team $team) {
                return view('dashboard.admin.teams.data_table.image', compact('team'));
            })
            ->addColumn('actions', 'dashboard.admin.teams.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
//------------------------------------------------------------------------------------------
    public function store($request) {
    //  dd('gggg');
        try{
            $team=new Team();
            $team->name=$request->name;
            $team->position=$request->position;
            $team->description=$request->description;
            // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
            // Check img
            if (!$request->file('image')->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }

            $photo = $request->image;
            $filename =$request->image->getClientOriginalName();
            $photo->storeAs('', $filename, 'team');
            // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
            $team->image=$filename;
            $team->save();

            //==============update cache file=================
            $t=Team::get();
            Cache::store('file')->put('teams',$t);
           //==================================================
           
            toastr()->success(__('Admin/attributes.added_done'));
            return redirect()->route('team.index');   

        } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.add_wrong'));
            return redirect()->route('team.index');
         }
    }
//------------------------------------------------------------------------------------------
    public function edit($id) {
        $real_id = Crypt::decrypt($id);
        $team = Team::orderBy('id', 'DESC')->find($real_id);
       return view('dashboard.admin.teams.edit', compact('team'));
    }
//------------------------------------------------------------------------------------------
    public function update($request,$id) {
        try{
            $real_id = Crypt::decrypt($id);

            $team=Team::findOrfail($real_id);
            $team->name=$request->name;
            $team->position=$request->position;
            $team->description=$request->description;
            if(isset($request->image)){
                if($team->image) {//delete old image
                    $old_photo = $team->image;
                    $this->Delete_attachment('team', $old_photo, $team->id, $old_photo);
                }
                 // Check img
                if (!$request->file('image')->isValid()) {
                    flash('Invalid Image!')->error()->important();
                    return redirect()->back()->withInput();
                }

                $photo = $request->image;
                $filename =$request->image->getClientOriginalName();
                $photo->storeAs('', $filename, 'team');
                
                $team->image=$filename;
                 //============================================================================
            }
            $team->save();

             //==============update cache file=================
             $t=Team::get();
             Cache::store('file')->put('teams',$t);
            //==================================================
            
            
            toastr()->success(__('Admin/attributes.updated_done'));
            return redirect()->route('team.index');
        } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->route('team.index');
         }
    }
//------------------------------------------------------------------------------------------
    public function destroy($id) {
        try{
            $real_id = decrypt($id);

            $t= Team::findorfail($real_id);
            unlink(public_path().'\Dashboard\img\team\\'.$t->image);
            $t->delete();

            //==============update cache file=================
            $t=Team::get();
            Cache::store('file')->put('teams',$t);
           //==================================================
           
                toastr()->error(__('Admin/attributes.delete_done'));
                return redirect()->route('team.index');
           
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->route('team.index');
        }
    }
    
//------------------------------------------------------------------------------------------
    public function bulkDelete($request)
    {
       // dd($request->delete_select_id);
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);

            $delete_or_no=0;
            
            foreach($all_ids as $ids){
                
                    $t=Team::findorfail($ids);
                    unlink(public_path().'\Dashboard\img\team\\'.$t->image);
                    //$this->Delete_attachment('team', $t->image, $t->id, $t->image);
                    $t->delete();
                    $delete_or_no++;
            }
            if($delete_or_no==0){
                toastr()->error(__('Admin/attributes.cant_delete'));
                return redirect()->route('team.index');
            }else{
                //==============update cache file=================
                    $t=Team::get();
                    Cache::store('file')->put('teams',$t);
                //==================================================
           
                toastr()->error(__('Admin/attributes.delete_done'));
                return redirect()->route('team.index');
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('team.index');
        }
    }// end of bulkDelete
}