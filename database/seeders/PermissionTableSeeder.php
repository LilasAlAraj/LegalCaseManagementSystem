<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
    '2',
    '6'
    
];
foreach ($permissions as $permission) {
 Permission::create(['name' => $permission]);
}
}

}