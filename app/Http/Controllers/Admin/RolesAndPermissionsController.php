<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesAndPermissionsController extends Controller
{
    public function createAdmin(CreateAdminRequest $request)
    {
    $role =Role::create ([
        'name' => $request->name ,

    ]);

    $role->save();
    // return $admin;
    return response()->json([
        'role' => $role,
        'message' => "Role Created Successfully."
    ], 200);
}
}
