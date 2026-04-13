<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::query()->where("title","مدیر کل")->first();
        $branchRole = Role::query()->where("title","مدیر شعبه 1")->first();

        $admin = Admin::query()->create([
            'name' => 'سینا',
            'family' => 'محمدی',
            "mobile" => "09306747180",
            "admin_code" => "ee2244",
            "national_code" => "2283845111",
            "education" => "فوق دیپلم",
            "role" => "مدیر اجرایی",
            "father_name" => "شهریار",
            "address" => "شیراز"
        ]);

        User::query()->create([
            "user_id" => $admin->id,
            "role_id" => $branchRole->id,
            "model" => "App\Http\Models\Admin",
            "username" => "admin",
            "password" => hash("sha256","12345678")
        ]);

        $branch = Branch::query()->create([
            "name" => "شعبه شیراز",
            "code" => "44225",
            "count_staff" => 5,
            "address" => "خیابان گاز"
        ]);

        Storage::query()->create([
            "branch_id" => $branch->id,
            "name" => "انبار اصلی",
            "address" => "شعبه"
        ]);

        $staff = Staff::query()->create([
            'name' => 'سینا',
            'family' => 'محمدی',
            "mobile" => "09306747180",
            "personal_code" => "ee2244",
            "national_code" => "2283845111",
            "education" => "فوق دیپلم",
            "role" => "مدیر اجرایی",
            "father_name" => "شهریار",
            "address" => "شیراز",
            "branch_id" => $branch->id
        ]);

        User::query()->create([
            "user_id" => $staff->id,
            "role_id" => $adminRole->id,
            "model" => "App\Http\Models\Staff",
            "username" => "staff",
            "password" => hash("sha256","12345678")
        ]);
    }
}
