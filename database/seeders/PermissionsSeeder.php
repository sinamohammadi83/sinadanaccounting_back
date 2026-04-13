<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p = Permission::query()->insert([
            [
                "title" => "مشاهده شخص",
                "permission" => "read-person"
            ],
            [
                "title" => "ایجاد شخص",
                "permission" => "create-person"
            ],[
                "title" => "ویرایش شخص",
                "permission" => "edit-person"
            ],[
                "title" => "حذف شخص",
                "permission" => "delete-person"
            ],
            [
                "title" => "مشاهده انبار",
                "permission" => "read-storage"
            ],
            [
                "title" => "ایجاد انبار",
                "permission" => "create-storage"
            ],[
                "title" => "ویرایش انبار",
                "permission" => "edit-storage"
            ],[
                "title" => "حذف انبار",
                "permission" => "delete-storage"
            ],
            [
                "title" => "مشاهده فاکتور",
                "permission" => "read-factor"
            ],
            [
                "title" => "ایجاد فاکتور",
                "permission" => "create-factor"
            ],[
                "title" => "ویرایش فاکتور",
                "permission" => "edit-factor"
            ],[
                "title" => "حذف فاکتور",
                "permission" => "delete-factor"
            ],
            [
                "title" => "مشاهده نقش",
                "permission" => "read-role"
            ],
            [
                "title" => "ایجاد نقش",
                "permission" => "create-role"
            ],[
                "title" => "ویرایش نقش",
                "permission" => "edit-role"
            ],[
                "title" => "حذف نقش",
                "permission" => "delete-role"
            ],
            [
                "title" => "مشاهده کارمند",
                "permission" => "read-staff"
            ],
            [
                "title" => "ایجاد کارمند",
                "permission" => "create-staff"
            ],[
                "title" => "ویرایش کارمند",
                "permission" => "edit-staff"
            ],[
                "title" => "حذف کارمند",
                "permission" => "delete-staff"
            ],
            [
                "title" => "مشاهده گزارشات",
                "permission" => "read-reports"
            ],
            [
                "title" => "مشاهده شخص",
                "permission" => "read-person-admin"
            ],
            [
                "title" => "ایجاد شخص",
                "permission" => "create-person-admin"
            ],[
                "title" => "ویرایش شخص",
                "permission" => "edit-person-admin"
            ],[
                "title" => "حذف شخص",
                "permission" => "delete-person-admin"
            ],
            [
                "title" => "مشاهده انبار",
                "permission" => "read-storage-admin"
            ],
            [
                "title" => "ایجاد انبار",
                "permission" => "create-storage-admin"
            ],[
                "title" => "ویرایش انبار",
                "permission" => "edit-storage-admin"
            ],[
                "title" => "حذف انبار",
                "permission" => "delete-storage-admin"
            ],
            [
                "title" => "مشاهده فاکتور",
                "permission" => "read-factor-admin"
            ],
            [
                "title" => "ایجاد فاکتور",
                "permission" => "create-factor-admin"
            ],[
                "title" => "ویرایش فاکتور",
                "permission" => "edit-factor-admin"
            ],[
                "title" => "حذف فاکتور",
                "permission" => "delete-factor-admin"
            ],
            [
                "title" => "مشاهده نقش",
                "permission" => "read-role-admin"
            ],
            [
                "title" => "ایجاد نقش",
                "permission" => "create-role-admin"
            ],[
                "title" => "ویرایش نقش",
                "permission" => "edit-role-admin"
            ],[
                "title" => "حذف نقش",
                "permission" => "delete-role-admin"
            ],
            [
                "title" => "مشاهده کارمند",
                "permission" => "read-staff-admin"
            ],
            [
                "title" => "ایجاد کارمند",
                "permission" => "create-staff-admin"
            ],[
                "title" => "ویرایش کارمند",
                "permission" => "edit-staff-admin"
            ],[
                "title" => "حذف کارمند",
                "permission" => "delete-staff-admin"
            ],
            [
                "title" => "مشاهده شعبه",
                "permission" => "read-branch-admin"
            ],
            [
                "title" => "ایجاد شعبه",
                "permission" => "create-branch-admin"
            ],[
                "title" => "ویرایش شعبه",
                "permission" => "edit-branch-admin"
            ],[
                "title" => "حذف شعبه",
                "permission" => "delete-branch-admin"
            ],
            [
                "title" => "مشاهده گزارشات",
                "permission" => "read-reports-admin"
            ],
        ]);

        $branchRole = Role::query()->create([
            "title" => "مدیر شعبه 1"
        ]);

        $branchRole->permission()->attach(Permission::query()->where("permission", "not like","%-admin")->get());

        $adminRole = Role::query()->create([
            "title" => "مدیر کل"
        ]);

        $adminRole->permission()->attach(Permission::query()->where("permission", "like","%-admin")->get());
    }
}
