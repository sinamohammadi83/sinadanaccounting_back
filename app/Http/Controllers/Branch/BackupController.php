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

        $backupFile = base_path().'/backups/'.date('Y-m-d').'.sql';
        $command = "mysqldump --user=root --password= --host=localhost --ssl-mode=DISABLED sinadanaaccounting --result-file=\"{$backupFile}\" 2>&1";
        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            dd($output);
        }

        return response()->json([
            'msg' => 'پشتیبان گیری با موفقیت انجام شد'
        ])->setStatusCode(200);
    }

    // پردازش آپلود و بازیابی
    public function restore(Request $request)
    {
        // 1. اعتبارسنجی فایل
        $request->validate([
            'backup_file' => 'required|file|max:51200' // حداکثر 50 مگابایت
        ]);

        $file = $request->file('backup_file');
        $originalName = $file->getClientOriginalName();
        $tempPath = storage_path('app/temp_restore/');

        // ایجاد پوشه موقت اگر وجود ندارد
        if (!is_dir($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        // ذخیره فایل در پوشه موقت با نام یکتا
        $tempFile = $tempPath . time() . '_' . basename($originalName);
        move_uploaded_file($file->getPathname(), $tempFile);

        try {
            // 2. اگر فایل zip است، آن را خارج کنید
            $sqlFile = $tempFile;
            if (pathinfo($tempFile, PATHINFO_EXTENSION) === 'zip') {
                $zip = new ZipArchive();
                if ($zip->open($tempFile) === true) {
                    $extractPath = $tempPath . 'extracted_' . time();
                    $zip->extractTo($extractPath);
                    $zip->close();

                    // پیدا کردن اولین فایل .sql در زیپ
                    $files = scandir($extractPath);
                    $sqlFile = null;
                    foreach ($files as $f) {
                        if (pathinfo($f, PATHINFO_EXTENSION) === 'sql') {
                            $sqlFile = $extractPath . '/' . $f;
                            break;
                        }
                    }
                    if (!$sqlFile) {
                        throw new \Exception('هیچ فایل SQL در زیپ یافت نشد.');
                    }
                } else {
                    throw new \Exception('خطا در باز کردن فایل ZIP.');
                }
            }

            // 3. اجرای بازیابی با mysql client
            $database = env('DB_DATABASE');
            $user = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $host = env('DB_HOST');
            $port = env('DB_PORT', 3306);

            // دستور restore با SSL غیرفعال
            $command = "mysql --user={$user} --password={$password} --host={$host} --port={$port} --ssl-mode=DISABLED {$database} < \"{$sqlFile}\" 2>&1";

            exec($command, $output, $returnCode);

            if ($returnCode !== 0) {
                throw new \Exception('خطا در بازیابی: ' . implode("\n", $output));
            }

            // 4. همه چیز موفقیت‌آمیز بود
            $success = true;
            $message = 'بازیابی با موفقیت انجام شد.';

        } catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        // 5. پاکسازی فایل‌های موقت (حذف فایل‌های آپلود شده و زیپ استخراجی)
        $this->cleanupTempFiles($tempPath, $tempFile, $sqlFile ?? null, $extractPath ?? null);

        if ($success) {
            return response()->json([
                'msg' => 'بازیابی با موفقیت انجام شد'
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'msg' => 'بازیابی با خطا روبه رو شد'
            ])->setStatusCode(200);
        }
    }

    // متد پاکسازی فایل‌های موقت
    private function cleanupTempFiles($tempPath, $uploadedFile, $sqlFile, $extractPath)
    {
        // حذف فایل آپلود شده
        if (file_exists($uploadedFile)) {
            @unlink($uploadedFile);
        }

        // حذف فایل SQL استخراج شده (اگر از زیپ خارج شده باشد)
        if ($sqlFile && file_exists($sqlFile) && $sqlFile !== $uploadedFile) {
            @unlink($sqlFile);
        }

        // حذف پوشه استخراجی زیپ
        if ($extractPath && is_dir($extractPath)) {
            $this->deleteDirectory($extractPath);
        }

        // پاک کردن پوشه موقت اگر خالی شد
        if (is_dir($tempPath) && count(scandir($tempPath)) == 2) { // فقط . و ..
            @rmdir($tempPath);
        }
    }

    // متد کمکی برای حذف بازگشتی پوشه
    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;
        }
        return rmdir($dir);
    }
}
