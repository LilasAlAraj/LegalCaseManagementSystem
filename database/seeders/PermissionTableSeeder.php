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
    'لوحة القيادة',

    'القضايا',// الصلاحيات الخاصة بالقضايا
    'القضايا المؤرشفة',
    ' الخاصةالقضايا',
    'اضافة قضية',
    'تعديل قضة',

    'العملاء', // الصلاحيات الخاصة بالعملاء
    'اضافة عميل جديد',
    'حذف عميل',

    'المواعيد',//الصلاحيات الخاصة بالمواعيد

    'المهام', //الصلاحيات الخاصة بالمهام

    'افراد المكتب',//الصلاحيات الخاصة بافراد المكتب
    'ا ضافة فرد جديد',

    
];
foreach ($permissions as $permission) {
 Permission::create(['name' => $permission]);
}
}

}