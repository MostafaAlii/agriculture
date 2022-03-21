<?php
namespace App\Http\Repositories\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\Farmer;
use App\Models\Country;
use App\Models\User;

use App\Models\Department;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\TagInterface;
use App\Models\Tag;

class TagRepository implements TagInterface {

    public function index($request) {
        $tags = Tag::get();
        return view('dashboard.admin.tags.index', compact('tags'));
    }


}
