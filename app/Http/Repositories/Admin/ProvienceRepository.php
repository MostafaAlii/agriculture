<?php
namespace App\Http\Repositories\Admin;
use App\Models\Province;
use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\ProvienceInterface;
class ProvienceRepository implements ProvienceInterface {
    public function index() {
        return view('dashboard.admin.proviences.index');
    }

    public function data() {
        $proviences = Province::with(['country','areas']);
        return DataTables::of($proviences)
            ->addColumn('country', function (Province $provience) {
                return $provience->country->name;
            })
            ->addColumn('areas', function (Province $provience) {
                return view('dashboard.admin.proviences.btn.related', compact('provience'));
            })
            ->addColumn('record_select', 'dashboard.admin.proviences.data_table.record_select')
            ->editColumn('created_at', function (Province $provience) {
                return $provience->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.proviences.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
}