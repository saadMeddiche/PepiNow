<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RunMeFirst extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qfqsfqsfqsqf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        //Create Permissions Of Plante
        $Show_Plantes = Permission::create(['name' => 'Show-Plantes', 'guard_name' => 'web']);
        $Show_Plante = Permission::create(['name' => 'Show-Plante', 'guard_name' => 'web']);
        $Add_Plante = Permission::create(['name' => 'Add-Plante', 'guard_name' => 'web']);
        $Update_Plante = Permission::create(['name' => 'Update-Plante', 'guard_name' => 'web']);
        $Delete_Plante = Permission::create(['name' => 'Delete-Plante', 'guard_name' => 'web']);

        //Create Permissions Of Categorie
        $Show_Categories = Permission::create(['name' => 'Show-Categories', 'guard_name' => 'web']);
        $Show_Categorie = Permission::create(['name' => 'Show-Categorie', 'guard_name' => 'web']);
        $Add_Categorie = Permission::create(['name' => 'Add-Categorie', 'guard_name' => 'web']);
        $Update_Categorie = Permission::create(['name' => 'Update-Categorie', 'guard_name' => 'web']);
        $Delete_Categorie = Permission::create(['name' => 'Delete-Categorie', 'guard_name' => 'web']);

        //Create Permissions Of Role
        $Show_Roles = Permission::create(['name' => 'Show-Roles', 'guard_name' => 'web']);
        $Show_Role = Permission::create(['name' => 'Show-Role', 'guard_name' => 'web']);
        $Add_Role = Permission::create(['name' => 'Add-Role', 'guard_name' => 'web']);
        $Update_Role = Permission::create(['name' => 'Update-Role', 'guard_name' => 'web']);
        $Delete_Role = Permission::create(['name' => 'Delete-Role', 'guard_name' => 'web']);
        $ShowPermissionsOfaRole = Permission::create(['name' => 'ShowPermissionsOfaRole', 'guard_name' => 'web']);
        $ShowRolesOfaPermissions = Permission::create(['name' => 'ShowRolesOfaPermissions', 'guard_name' => 'web']);
        $assignPermissions = Permission::create(['name' => 'assignPermissions', 'guard_name' => 'web']);
        $assignRole = Permission::create(['name' => 'assignRole', 'guard_name' => 'web']);
        $RemovePermissions = Permission::create(['name' => 'RemovePermissions', 'guard_name' => 'web']);
        $RemoveRole = Permission::create(['name' => 'RemoveRole', 'guard_name' => 'web']);

        //Access To All
        $accessToAll = Permission::create(['name' => '*', 'guard_name' => 'web']);

        //Create Roles
        $Admin_Role = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $Sailler_Role = Role::create(['name' => 'Sailler', 'guard_name' => 'web']);

        //Assign Permissions to roles
        $Admin_Role->givePermissionTo($accessToAll);
        $Sailler_Role->givePermissionTo([$Show_Plantes, $Show_Plante, $Add_Plante, $Update_Plante, $Delete_Plante]);

        // Create Users
        $users = [
            ['name' => 'Admin', 'email' => 'Admin@gmail.com', 'password' => Hash::make('Password$2004')],
            ['name' => 'User', 'email' => 'User@gmail.com', 'password' => Hash::make('Password$2004')],
            ['name' => 'Sailler', 'email' => 'Sailler@gmail.com', 'password' => Hash::make('Password$2004')],
        ];

        for ($i = 0; $i < count($users); $i++) {
            User::create($users[$i]);
        }

        $Admin = User::where('name', 'Admin')->first();
        $Sailler = User::where('name', 'Sailler')->first();

        //Asign Role to Users
        $Admin->assignRole($Admin_Role);
        $Sailler->assignRole($Sailler_Role);

        //Return Mess
        $this->info('Done :D');
    }
}
