<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view book']);
        Permission::create(['name' => 'create book']);
        Permission::create(['name' => 'delete book']);
        Permission::create(['name' => 'edit book']);
        Permission::create(['name' => 'hide book']);

        Permission::create(['name' => 'view exam']);
        Permission::create(['name' => 'create exam']);
        Permission::create(['name' => 'delete exam']);
        Permission::create(['name' => 'edit exam']);
        Permission::create(['name' => 'hide exam']);

        Permission::create(['name' => 'create question']);
        Permission::create(['name' => 'delete question']);
        Permission::create(['name' => 'edit question']);
        Permission::create(['name' => 'approve question']);

        Permission::create(['name' => 'create answer']);
        Permission::create(['name' => 'delete answer']);
        Permission::create(['name' => 'edit answer']);
        Permission::create(['name' => 'approve answer']);
        Permission::create(['name' => 'view answer']);

        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'hide category']);

        Permission::create(['name' => 'create rating']);
        Permission::create(['name' => 'delete rating']);
        Permission::create(['name' => 'edit rating']);
        Permission::create(['name' => 'hide rating']);

        Permission::create(['name' => 'view comment']);
        Permission::create(['name' => 'create comment']);
        Permission::create(['name' => 'delete comment']);
        Permission::create(['name' => 'edit comment']);
        Permission::create(['name' => 'hide comment']);

        Permission::create(['name' => 'create step']);
        Permission::create(['name' => 'delete step']);
        Permission::create(['name' => 'edit step']);
        Permission::create(['name' => 'view step']);

        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());
        Role::create(['name' => 'moderator'])
            ->givePermissionTo([
                'view book',
                'create book',
                'edit book',
                'hide book',
                'delete book',
                'view exam',
                'create exam',
                'edit exam',
                'hide exam',
                'delete exam',
                'create question',
                'edit question',
                'approve question',
                'delete question',
                'edit answer',
                'view answer',
                'view step',
                'edit step',
                'create rating',
                'edit rating'
            ]);
        Role::create(['name' => 'contributor'])
            ->givePermissionTo([
                'view question',
                'view book',
                'view exam',
                'create answer',
                'edit answer',
                'view answer',
                'create comment',
                'edit comment',
                'delete comment',
                'create rating',
                'edit rating',
                'view step',
                'create step',
                'edit step',
                'create comment',
                'delete comment',
                'view comment'
            ]);
        Role::create(['name' => 'paid user'])
            ->givePermissionTo([
                'view book',
                'view exam',
                'view answer',
                'view step',
                'create rating',
                'edit rating',
                'create comment',
                'edit comment',
                'delete comment',

            ]);
        Role::create(['name' => 'regular user'])
            ->givePermissionTo([
                'view answer',
                'view book',
                'view exam'
            ]);
    }
}
