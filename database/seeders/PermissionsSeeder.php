<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list academiclevels']);
        Permission::create(['name' => 'view academiclevels']);
        Permission::create(['name' => 'create academiclevels']);
        Permission::create(['name' => 'update academiclevels']);
        Permission::create(['name' => 'delete academiclevels']);

        Permission::create(['name' => 'list academicprograms']);
        Permission::create(['name' => 'view academicprograms']);
        Permission::create(['name' => 'create academicprograms']);
        Permission::create(['name' => 'update academicprograms']);
        Permission::create(['name' => 'delete academicprograms']);

        Permission::create(['name' => 'list academies']);
        Permission::create(['name' => 'view academies']);
        Permission::create(['name' => 'create academies']);
        Permission::create(['name' => 'update academies']);
        Permission::create(['name' => 'delete academies']);

        Permission::create(['name' => 'list agreements']);
        Permission::create(['name' => 'view agreements']);
        Permission::create(['name' => 'create agreements']);
        Permission::create(['name' => 'update agreements']);
        Permission::create(['name' => 'delete agreements']);

        Permission::create(['name' => 'list basiccores']);
        Permission::create(['name' => 'view basiccores']);
        Permission::create(['name' => 'create basiccores']);
        Permission::create(['name' => 'update basiccores']);
        Permission::create(['name' => 'delete basiccores']);

        Permission::create(['name' => 'list becas']);
        Permission::create(['name' => 'view becas']);
        Permission::create(['name' => 'create becas']);
        Permission::create(['name' => 'update becas']);
        Permission::create(['name' => 'delete becas']);

        Permission::create(['name' => 'list benefits']);
        Permission::create(['name' => 'view benefits']);
        Permission::create(['name' => 'create benefits']);
        Permission::create(['name' => 'update benefits']);
        Permission::create(['name' => 'delete benefits']);

        Permission::create(['name' => 'list bonds']);
        Permission::create(['name' => 'view bonds']);
        Permission::create(['name' => 'create bonds']);
        Permission::create(['name' => 'update bonds']);
        Permission::create(['name' => 'delete bonds']);

        Permission::create(['name' => 'list campuses']);
        Permission::create(['name' => 'view campuses']);
        Permission::create(['name' => 'create campuses']);
        Permission::create(['name' => 'update campuses']);
        Permission::create(['name' => 'delete campuses']);

        Permission::create(['name' => 'list cities']);
        Permission::create(['name' => 'view cities']);
        Permission::create(['name' => 'create cities']);
        Permission::create(['name' => 'update cities']);
        Permission::create(['name' => 'delete cities']);

        Permission::create(['name' => 'list comments']);
        Permission::create(['name' => 'view comments']);
        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'update comments']);
        Permission::create(['name' => 'delete comments']);

        Permission::create(['name' => 'list convenios']);
        Permission::create(['name' => 'view convenios']);
        Permission::create(['name' => 'create convenios']);
        Permission::create(['name' => 'update convenios']);
        Permission::create(['name' => 'delete convenios']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'list economies']);
        Permission::create(['name' => 'view economies']);
        Permission::create(['name' => 'create economies']);
        Permission::create(['name' => 'update economies']);
        Permission::create(['name' => 'delete economies']);

        Permission::create(['name' => 'list educationlevels']);
        Permission::create(['name' => 'view educationlevels']);
        Permission::create(['name' => 'create educationlevels']);
        Permission::create(['name' => 'update educationlevels']);
        Permission::create(['name' => 'delete educationlevels']);

        Permission::create(['name' => 'list internalizations']);
        Permission::create(['name' => 'view internalizations']);
        Permission::create(['name' => 'create internalizations']);
        Permission::create(['name' => 'update internalizations']);
        Permission::create(['name' => 'delete internalizations']);

        Permission::create(['name' => 'list knowledgeareas']);
        Permission::create(['name' => 'view knowledgeareas']);
        Permission::create(['name' => 'create knowledgeareas']);
        Permission::create(['name' => 'update knowledgeareas']);
        Permission::create(['name' => 'delete knowledgeareas']);

        Permission::create(['name' => 'list lifestyles']);
        Permission::create(['name' => 'view lifestyles']);
        Permission::create(['name' => 'create lifestyles']);
        Permission::create(['name' => 'update lifestyles']);
        Permission::create(['name' => 'delete lifestyles']);

        Permission::create(['name' => 'list allmedia']);
        Permission::create(['name' => 'view allmedia']);
        Permission::create(['name' => 'create allmedia']);
        Permission::create(['name' => 'update allmedia']);
        Permission::create(['name' => 'delete allmedia']);

        Permission::create(['name' => 'list mediatypes']);
        Permission::create(['name' => 'view mediatypes']);
        Permission::create(['name' => 'create mediatypes']);
        Permission::create(['name' => 'update mediatypes']);
        Permission::create(['name' => 'delete mediatypes']);

        Permission::create(['name' => 'list modalities']);
        Permission::create(['name' => 'view modalities']);
        Permission::create(['name' => 'create modalities']);
        Permission::create(['name' => 'update modalities']);
        Permission::create(['name' => 'delete modalities']);

        Permission::create(['name' => 'list prestiges']);
        Permission::create(['name' => 'view prestiges']);
        Permission::create(['name' => 'create prestiges']);
        Permission::create(['name' => 'update prestiges']);
        Permission::create(['name' => 'delete prestiges']);

        Permission::create(['name' => 'list rectorias']);
        Permission::create(['name' => 'view rectorias']);
        Permission::create(['name' => 'create rectorias']);
        Permission::create(['name' => 'update rectorias']);
        Permission::create(['name' => 'delete rectorias']);

        Permission::create(['name' => 'list requeriments']);
        Permission::create(['name' => 'view requeriments']);
        Permission::create(['name' => 'create requeriments']);
        Permission::create(['name' => 'update requeriments']);
        Permission::create(['name' => 'delete requeriments']);

        Permission::create(['name' => 'list students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        Permission::create(['name' => 'delete students']);

        Permission::create(['name' => 'list universities']);
        Permission::create(['name' => 'view universities']);
        Permission::create(['name' => 'create universities']);
        Permission::create(['name' => 'update universities']);
        Permission::create(['name' => 'delete universities']);

        Permission::create(['name' => 'list wellnesses']);
        Permission::create(['name' => 'view wellnesses']);
        Permission::create(['name' => 'create wellnesses']);
        Permission::create(['name' => 'update wellnesses']);
        Permission::create(['name' => 'delete wellnesses']);

        Permission::create(['name' => 'list zones']);
        Permission::create(['name' => 'view zones']);
        Permission::create(['name' => 'create zones']);
        Permission::create(['name' => 'update zones']);
        Permission::create(['name' => 'delete zones']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
