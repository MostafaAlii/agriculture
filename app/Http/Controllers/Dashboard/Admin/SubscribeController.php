<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SubscribeInterface;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SubscribeController extends Controller
{
    protected $Data;
    public function __construct(SubscribeInterface $Data) {
        $this->middleware('permission:subscribes', ['only' => ['data']]);
        $this->middleware('permission:subscribe-delete', ['only' => ['destroy']]);
        $this->middleware('permission:subscribe-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }
    public function data(Request $request) {
        return $this->Data->data($request);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }
}
