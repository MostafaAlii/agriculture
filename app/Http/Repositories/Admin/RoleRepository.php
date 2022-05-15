<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RoleRepository implements RoleRepositoryInterface {
    public function index() {
        return 'Roles Managment';
    }
}