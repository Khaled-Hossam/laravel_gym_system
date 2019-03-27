<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::truncate();
        Permission::truncate();

        Permission::create(['name'=> 'crud sessions']);
        Permission::create(['name'=> 'crud gyms']);
        Permission::create(['name'=> 'crud gym_managers']); 
        Permission::create(['name'=> 'crud cities']);
        Permission::create(['name'=> 'crud city_managers']);
        Permission::create(['name'=> 'crud packages']);
        Permission::create(['name'=> 'crud coaches']);
        Permission::create(['name'=> 'crud attendance',]);
        Permission::create(['name'=> 'crud buy_package_for_user']); 
        Permission::create(['name'=> 'crud revenue']);
        
        
        // or may be done by chaining
        Role::create(['name' => 'city_manager'])
            ->givePermissionTo([
                'crud sessions',
                'crud gyms',
                'crud gym_managers', 
            ]);

        Role::create(['name' => 'gym_manager'])
            ->givePermissionTo([
                'crud sessions',
            ]);

        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'crud sessions',
                'crud gyms',
                'crud gym_managers', 
                'crud cities',
                'crud city_managers',
                'crud packages',
                'crud coaches', 
                'crud attendance', 
                'crud buy_package_for_user', 
                'crud revenue',
            ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}