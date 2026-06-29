<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Branch\PersonResource;
use App\Models\Factor;
use App\Models\Person;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $staff = auth()->user()->staff;
        $branch = $staff->branch;

        $popular_products = Factor::query()
            ->where('branch_id',$branch->id)
            ->where('type',1)
            ->get();
        $factorProducts = [];
        foreach ($popular_products as $product){
            $factorProducts[] = $product->factorProduct;
        }

        $products_with_count = [];
        foreach ($factorProducts as $products){
                foreach ($products as $product){
                    if (!isset($products_with_count[$product->id]))
                        $products_with_count[$product->id] = [
                            'product' => $product,
                            'count' => 0
                        ];
                    $products_with_count[$product->id] += [
                        'product' => $product,
                        'count' => $products_with_count[$product->id]['count'] += $product->pivot->count
                    ];
                }
        }

        uasort($products_with_count,function ($a, $b){
                return $b['count'] <=> $a['count'];
        });

        $persianMonths = [
            1 => 'دی',      // January
            2 => 'بهمن',    // February
            3 => 'اسفند',   // March
            4 => 'فروردین', // April
            5 => 'اردیبهشت',// May ← اینجا اصلاح شد
            6 => 'خرداد',   // June
            7 => 'تیر',     // July
            8 => 'مرداد',   // August
            9 => 'شهریور',  // September
            10 => 'مهر',    // October
            11 => 'آبان',   // November
            12 => 'آذر'     // December
        ];

        $factors = $branch->factors()
            ->select(
                DB::raw('MONTH(date) as month_num'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('date', date('Y'))  // فیلتر سال جاری میلادی
            ->groupBy('month_num')
            ->orderBy('month_num', 'desc')
            ->get()
            ->map(function($item) use ($persianMonths) {
                // تبدیل عدد ماه میلادی به اسم ماه شمسی
                $item->solar_month_fa = $persianMonths[$item->month_num];
                return $item;
            });
        $yearFactors = $branch->factors()->select(
            DB::raw("YEAR(date) as year"),
            DB::raw('COUNT(*) as count')
        )->groupBy('year')
            ->orderBy('year', 'asc')
            ->get()
            ->map(function ($item){
                $item->year = $item->year - 621;
                return $item;
            });

        $low_products = auth()->user()->staff->branch->products()->orderBy('count')->limit(5)->get();

        $top_customers = $branch->factors()
            ->select('person_id',DB::raw('COUNT(*) as count'))
            ->groupBy('person_id')
            ->limit(3)
            ->get()
            ->map(function ($item){
                $item->person = new PersonResource(Person::query()->where('id',$item->person_id)->firstOrFail());
                return $item;
            });

        return response()->json([
            'popular_products' => $products_with_count,
            'monthly_sell' => $factors,
            'low_products' => $low_products,
            'yearly_sell' => $yearFactors,
            'top_customers' => $top_customers
        ])->setStatusCode(200);
    }

    public function filter(Request $request)
{

    $staff = auth()->user()->staff;
    $branch = $staff->branch;

    $from = $request->from;
    $to = $request->to;

    $factors = $branch->factors();

    if ($from) {
        $factors->whereDate('date', '>=', $from);
    }

    if ($to) {
        $factors->whereDate('date', '<=', $to);
    }

    return response()->json([
        'monthly_sell' => $this->monthlySell(clone $factors),
        'yearly_sell' => $this->yearlySell(clone $factors),
        'top_customers' => $this->topCustomers(clone $factors),
        'popular_products' => $this->popularProducts(clone $factors),
        'low_products' => $this->lowProducts(),
    ]);
}
private function monthlySell($query)
{
    return $query
        ->get()
        ->groupBy(function ($factor) {

            return Jalalian::fromCarbon(
                Carbon::parse($factor->date)
            )->format('%B');

        })
        ->map(function ($items, $month) {

            return [
                'solar_month_fa' => $month,
                'count' => $items->count()
            ];

        })
        ->values();
}

private function yearlySell($query)
{
    return $query
        ->select(
            DB::raw('YEAR(date) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('year')
        ->orderBy('year')
        ->get()
        ->map(function ($item) {

            $item->year -= 621;

            return $item;

        });
}

private function lowProducts($from = null, $to = null)
{
    $branch = auth()->user()->staff->branch;

    $query = $branch->products();

    if ($from || $to) {

        $query->whereHas('factors', function ($q) use ($from, $to) {

            if ($from) {
                $q->whereDate('date', '>=', $from);
            }

            if ($to) {
                $q->whereDate('date', '<=', $to);
            }

        });

    }

    return $query
        ->orderBy('count')
        ->limit(5)
        ->get();
}

private function topCustomers($query)
{
    return $query
        ->select(
            'person_id',
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('person_id')
        ->limit(3)
        ->get()
        ->map(function ($item) {

            $item->person =
                new PersonResource(
                    Person::findOrFail($item->person_id)
                );

            return $item;

        });
}

private function popularProducts($query)
{
    $factors = (clone $query)
        ->where('type', 1)
        ->get();

    $factorProducts = [];

    foreach ($factors as $factor) {

        $factorProducts[] =
            $factor->factorProduct;

    }

    $productsWithCount = [];

    foreach ($factorProducts as $products) {

        foreach ($products as $product) {

            if (!isset($productsWithCount[$product->id])) {

                $productsWithCount[$product->id] = [

                    'product' => $product,

                    'count' => 0

                ];

            }

            $productsWithCount[$product->id]['count']
                += $product->pivot->count;

        }

    }

    uasort(
        $productsWithCount,
        fn ($a, $b) => $b['count'] <=> $a['count']
    );

    return $productsWithCount;
}
}
