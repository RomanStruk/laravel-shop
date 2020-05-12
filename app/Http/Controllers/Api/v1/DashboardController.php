<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Analytics\Analytics;
use App\Services\Analytics\DateGeneration;
use App\SoldProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function sales(DateGeneration $dateGeneration, Analytics $analytics)
    {
        $date = Carbon::now(2);

        $graph = [];
        // цикл по днях місяця
        foreach ($dateGeneration->daysForMonth($date, true) as $day){
            // вибірка з БД і сумування ціни товарів
            $graph[] = round(
                SoldProduct::whereBetween('created_at', $dateGeneration->generateStartEndDay($day))
                    ->get()
                    ->sum('sale_price')/100, 2);
        }
        $subDate = $date->copy()->subMonth();
        $graph2 = [];
        foreach ($dateGeneration->daysForMonth($subDate, true) as $day){
            $graph2[] = round(SoldProduct::whereBetween('created_at', $dateGeneration->generateStartEndDay($day))
                    ->get()
                    ->sum('sale_price')/100, 2);
        }

        $labels = [];
        foreach ($dateGeneration->daysForMonth($date, true) as $day){
            $labels[] = $day->format('d');
        }

        $sinceLastMonth = $analytics->growthRates(collect($graph)->sum(), collect($graph2)->sum());
        $salesOverTime = round(SoldProduct::salesOverTime()->first()->sale_price_sum/100, 2);
        return[
            'sinceLastMonth' => $sinceLastMonth,
            'salesOverTime' => number_format($salesOverTime, 2), // английский формат
            'graph' =>[
                'labels'  => $labels,
                'datasets' => [
                    [
                        'backgroundColor'=> '#007bff',
                        'borderColor'    => '#007bff',
                        'data'           => $graph
                    ],
                    [
                        'backgroundColor'=> '#ced4da',
                        'borderColor'    => '#ced4da',
                        'data'           => $graph2
                    ]
                ]
        ]];
    }

}
