<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $roles = Role::all();
        $permissions = Permission::all();
        
        return view('admin.roles-livewire', compact('roles', 'permissions'));
        //return view('admin.index', compact('roles', 'permissions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_role(Request $request)
    {
        //dd($request->all());
        Role::create(['name' => $request->rol_name]);
        return back()->with(['status' => 'success', 'message' => "Rol registrado correctamente."]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_permission(Permission $permission)
    {
        //dd($permission);
        return view('admin.roles.edit_permission', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function store_permission(Request $request)
    {
        //dd($request->all());
        Permission::create(['name' => $request->route_name, 'description' => $request->description]);
        return back()->with(['status' => 'success', 'message' => "Ruta/Permiso registrado correctamente."]);
    }


}
