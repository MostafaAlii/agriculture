<?php
namespace App\Http\Repositories\Admin;

use App\Models\Team;
use App\Traits\UploadT;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\TeamInterface;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TeamRepository implements TeamInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.teams.index');
    }
//------------------------------------------------------------------------------------------
    public function data() {

        // $team = Team::get();
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
        try{
            //  if (!$request->file('image')->isValid()) {
            //     flash('Invalid Image!')->error()->important();
            //     return redirect()->back()->withInput();
            // }
            //  $photo = $request->image;
            //  $filename =$request->image->getClientOriginalName();
            //  $photo->storeAs('', $filename, 'team');
            $input['name'] = $request->name;
            $input['position'] = $request->position;
            $input['description'] = $request->description;
            if ($image = $request->file('image')) {
                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension();
                $file_name = $request->image->hashName();
                $path = public_path('/Dashboard/img/team/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image'] = $file_name;
            }
            Team::create($input);
            // Team::Create(
            //     [
            //         'name' => $request->name,
            //         'position' => $request->position,
            //         'description'=>$request->description,
            //         'image'=>$filename
            //     ]
            // );

            //==============update cache file=================
            $t=Team::get();
            Cache::store('file')->put('teams',$t);
           //==================================================
            toastr()->success(__('Admin/attributes.added_done'));
            return redirect()->route('team.index');

        } catch (\Exception $ex) {
             // dd($ex->getMessage());
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
            $input['name'] = $request->name;
            $input['position'] = $request->position;
            $input['description'] = $request->description;
            if ($image = $request->file('image')) {
                if($team->image != null && file_exists(public_path('/Dashboard/img/team/' . $team->image))){
                    unlink('Dashboard/img/team/' . $team->image);
                }
                $file_name = $request->image->hashName();
                $path = public_path('/Dashboard/img/team/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image'] = $file_name;
            }
            $team->update($input);
            //============================================================================
        //     if(isset($request->image)){
        //         if($team->image) {//delete old image
        //             $old_photo = $team->image;
        //             $this->Delete_attachment('team', $old_photo, $team->id, $old_photo);
        //         }
        //          // Check img
        //         if (!$request->file('image')->isValid()) {
        //             flash('Invalid Image!')->error()->important();
        //             return redirect()->back()->withInput();
        //         }

        //         $photo = $request->image;
        //         $filename =$request->image->getClientOriginalName();
        //         $photo->storeAs('', $filename, 'team');

        //         $team->image=$filename;
        //     }
        //    //============================================================================

        //     $team->save();

             //==============update cache file=================
             $t=Team::get();
             Cache::store('file')->put('teams',$t);
            //==================================================


            toastr()->success(__('Admin/attributes.updated_done'));
            return redirect()->route('team.index');
        } catch (\Exception $e) {
            // toastr()->success(__('Admin/attributes.edit_wrong'));
            // return redirect()->route('team.index');
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
         }
    }
//------------------------------------------------------------------------------------------
    public function destroy($id) {
        try{
            $real_id = decrypt($id);

            $t= Team::findorfail($real_id);
            if($t->image != null && file_exists(public_path('/Dashboard/img/team/' . $t->image))){
                unlink('Dashboard/img/team/' . $t->image);
            }
            // unlink(public_path().'\Dashboard\img\team\\'.$t->image);
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
                    if($t->image != null && file_exists(public_path('/Dashboard/img/team/' . $t->image))){
                        unlink('Dashboard/img/team/' . $t->image);
                    }
                    // unlink(public_path().'\Dashboard\img\team\\'.$t->image);
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
