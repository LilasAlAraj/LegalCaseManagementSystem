<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    
         $user = User::create([
        'first_name' => 'boushra', 
        'last_name' => 'almouhammad', 
        'mother_name' => 'amina', 
        'father_name' => 'omer', 
        'email' => 'boushra.MHD@gmail.com',
        'password' => bcrypt('123456'),
        'location'=>'syria',
        'phone'=>'0982371710',
        'roles_name' => ["owner"],
        'Status' => 'مفعل',
        ]);
  
        $role = Role::create(['name' => 'owner']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);


}
}