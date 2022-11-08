<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles = Role::get();

       return view('backend.roles.index',['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::get();
        return view('backend.roles.form',['modules' => $modules]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required | unique:roles',
            'permissions.*' => 'integer',
            'permissions' => 'required | array',

        ]);

        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => 'Default description',
        ])->permissions()->attach($request->permissions);

        return redirect()->route('app.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $modules = Module::get();
        return view('backend.roles.form',['modules' => $modules,'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // dd($request->all());
        $request->validate([
            // 'name'=>'required|unique:categories,name,'.$id,
            'name' => 'required | unique:roles,name,'.$role->id,
            'permissions.*' => 'integer',
            'permissions' => 'required | array',

        ]);

        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => 'Default description',
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('app.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // dd($role->permissions->pluck('id'));
        if ($role->deletable) {
            $role->permissions()->detach($role->permissions->pluck('id'));
            $role->delete();
        }
    }
}
