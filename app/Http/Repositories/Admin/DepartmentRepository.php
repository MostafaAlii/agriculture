<?php
namespace App\Http\Repositories\Admin;
use App\Models\Department;
use App\Http\Interfaces\Admin\DepartmentInterface;
class DepartmentRepository implements DepartmentInterface {
    public function index() {
        $departments = Department::get();
        return view('dashboard.admin.departments.index', compact('departments'));
    }
}