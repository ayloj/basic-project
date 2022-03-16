<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionComponent extends Component
{

    public $roles, $permissions, $rol_name, $route_name, $description;

    public $formActionRole = 'store_role';
    public $formColorRole = 'secondary';
    public $formBtnRole = 'Crear';
    public $rolModel;

    public $formActionPermission = 'store_permission';
    public $formColorPermission = 'secondary';
    public $formBtnPermission = 'Crear';
    public $permissionModel;


    public $rolePermissions;
    public $permissionAtRole = [];
    

    public function mount()
    {
        Log::debug(__METHOD__ . ", Rmountole: ");
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.permission-component');
    }

    public function store_role()
    {
        $this->validate([
            'rol_name' => 'required'
        ]);
        Role::create(['name' => $this->rol_name]);

        $this->refresData();
        $this->success('Rol creado correctamente!');
    }

    public function store_permission()
    {
        $this->validate([
            'route_name' => 'required',
            'description' => 'required'
        ]);
        Permission::create(['name' => $this->route_name, 'description' => $this->description]);

        $this->success('Permiso creado correctamente!');
        $this->refresData();
    }

    public function roleEditForm($id)
    {
        try {
            $this->rolModel = Role::findOrFail($id);
            $this->rol_name = $this->rolModel->name;
        } catch (ModelNotFoundException $e) {
            Log::debug(__METHOD__ . ", Exception ModelNotFoundException: " . print_r($e->getMessage(), 1));
            $this->success("Error: Rol indefinido!");
            return;
        }

        $this->formActionRole = 'roleUpdate';
        $this->formColorRole = 'info';
        $this->formBtnRole = 'Actualizar';
    }

    public function permissionEditForm($id)
    {
        try {
            $this->permissionModel = Permission::findOrFail($id);
            $this->route_name = $this->permissionModel->name;
            $this->description = $this->permissionModel->description;
        } catch (ModelNotFoundException $e) {
            Log::debug(__METHOD__ . ", Exception ModelNotFoundException: " . print_r($e->getMessage(), 1));
            $this->success("Error: Permiso indefinido!");
            return;
        }

        $this->formActionPermission = 'permissionUpdate';
        $this->formColorPermission = 'info';
        $this->formBtnPermission = 'Actualizar';
    }

    public function permissionUpdate()
    {
        $this->permissionModel->name = $this->route_name;
        $this->permissionModel->description = $this->description;
        $this->permissionModel->save();

        $this->refresData();
        $this->success("Permiso actualizado corectamente!");
    }


    public function roleUpdate()
    {
        $this->rolModel->name = $this->rol_name;
        //$this->rolModel->description = $this->description;
        $this->rolModel->save();

        $this->refresData();
        $this->success("Rol actualizado corectamente!");
    }



    public function deleteRole($rol)
    {
        try {
            Log::debug(__METHOD__ . ", Eliminar Rol: $rol");
            $role = Role::findOrFail($rol);
            $roleName = $role->name;
            $role->delete();
        } catch (ModelNotFoundException $e) {
            Log::debug(__METHOD__ . ", Exception ModelNotFoundException: " . print_r($e->getMessage(), 1));
            $this->success("Error: Rol indefinido!");
            return;
        }

        $this->refresData();
        $this->success("Se eliminó Rol: {$roleName}");
    }


    public function deletePermission($permissionId)
    {
        try {
            Log::debug(__METHOD__ . ", Eliminar Permiso: $permissionId");
            $permission = Permission::findOrFail($permissionId);
            $permissionName = $permission->description;
            $permission->delete();
            $this->refresData();
        $this->success("Se eliminó Permiso: {$permissionName}");
        } catch (ModelNotFoundException $e) {
            Log::debug(__METHOD__ . ", Exception ModelNotFoundException: " . print_r($e->getMessage(), 1));
            $this->success("Error: Permiso indefinido!");
            return;
        }
    }

    #Section assign permission to rol
    public function onChengeRole($value)
    {
        $this->permissionAtRole = [];
        try {
            $this->rolePermissions = $value;
            $role = Role::findOrFail($value);
            $this->permissionAtRole = $role->permissions()->pluck('id')->all();

            Log::debug(__METHOD__ . ", permissionAtRole: " . print_r($this->permissionAtRole, 1));
        } catch (ModelNotFoundException $e) {
            Log::debug(__METHOD__ . ", Exception ModelNotFoundException: " . print_r($e->getMessage(), 1));
            $this->success("Error: Rol indefinido!");
            return;
        }
    }

    public function savePermissionToRole(){
        try {
            //Obtengo el Rol
            $role = Role::findOrFail($this->rolePermissions);
            //De los permisos originales, voy a eliminarlos-revocarlos
            Log::debug(__METHOD__ . ", Revovocando permisos del ROL: ".$this->rolePermissions);
            $role->revokePermissionTo($role->permissions()->pluck('name')->all());
            Log::debug(__METHOD__ . ", Permisos Revocados del ROL: ".print_r($role->permissions()->pluck('id')->all(), 1));
            //Asignar los nuevos permisos
            Log::debug(__METHOD__ . ", Asignando nuevos permisos: " . print_r($this->permissionAtRole, 1));
            $role->givePermissionTo($this->permissionAtRole);
            //Retornar los nuevos permisos guardados
            $this->permissionAtRole = $role->permissions()->pluck('id')->all();

            Log::debug(__METHOD__ . ", Nuevos permisos asignados: " . print_r($this->permissionAtRole, 1));
        } catch (ModelNotFoundException $e) {
            Log::debug(__METHOD__ . ", Exception ModelNotFoundException: " . print_r($e->getMessage(), 1));
            $this->success("Error: Rol indefinido!");
            return;
        }
        Log::debug(__METHOD__ . ", Data permission to Role END: ");
    }


    #Common functions
    private function refresData()
    {
        $this->reset(['formActionRole', 'formColorRole', 'formBtnRole', 'rol_name', 
        'formActionPermission', 'formColorPermission', 'formBtnPermission', 'route_name', 'description']);
        $this->roles = Role::all();
        $this->permissions = Permission::all();

    }

    private function success($message)
    {
        $this->dispatchBrowserEvent('succesAlert', ['message' => $message]);
        //$this->emit('succesAlert', $message); //Using Livewire.on in view
    }
}
