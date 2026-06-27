<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Category;
use App\Models\City;
use App\Models\document;
use App\Models\documentRows;
use App\Models\Factor;
use App\Models\Ledger;
use App\Models\Permission;
use App\Models\Person;
use App\Models\Product;
use App\Models\Province;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function store()
    {
        $textBackup = '';

        foreach(Factor::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(User::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Account::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Branch::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Category::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(City::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(document::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(documentRows::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Ledger::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Permission::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Person::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Product::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Province::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Role::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Staff::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        foreach(Storage::all() as $item){
            $textBackup .= "INSERT INTO `factors` (`id`, `branch_id`, `staff_id`, `category_id`, `person_id`, `title`, `date`, `due_date`, `paid_price`, `total_price`, `type`, `created_at`, `updated_at`) VALUES ('$item->id', '$item->branch_id', '$item->staff_id', '$item->category_id', '$item->person_id', '$item->title', '$item->date', '$item->due_date', '$item->paid_price', '$item->total_price', '$item->type', '$item->created_at', '$item->updated_at');";
        }

        $file = fopen(app_path('../').'/backups/'.date('y-m-d').'.sql','w');
        fwrite($file,$textBackup);
        fclose($file);
    }
}
