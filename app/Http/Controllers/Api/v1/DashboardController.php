<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Analytics\Analytics;
use App\Services\Analytics\DateGeneration;
use App\Services\Data\SoldProduct\GetCountProductGroupByWeek;
use App\Services\Data\SoldProduct\GetSoldProductBetweenDate;
use App\Services\Data\SoldProduct\GetSoldProductsBetweenDate;
use App\Services\Data\SoldProduct\GetTopProductsByLimit;
use App\Services\Data\SoldProduct\SalesOverTime;
use App\SoldProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function chartJsBar(GetSoldProductsBetweenDate $soldProductsBetweenDate, DateGeneration $dateGeneration)
    {
        $date = Carbon::now(2);

        $sold = $soldProductsBetweenDate->handel($dateGeneration->generateStartEndWeek($date));

        $graph = [];
        foreach ($dateGeneration->daysForWeek($date) as $day){
            $graph[] = $sold->whereBetween('created_at', $dateGeneration->generateStartEndDay($day))->count();
        }

        $subDate = $date->copy()->subWeek();
        $sold2 = $soldProductsBetweenDate->handel($dateGeneration->generateStartEndWeek($subDate));
        $graph2 = [];
        foreach ($dateGeneration->daysForWeek($subDate) as $day){
            $graph2[] = $sold2->whereBetween('created_at', $dateGeneration->generateStartEndDay($day))->count();
        }

        $labels = [];
        foreach ($dateGeneration->daysForWeek($date) as $day){
            $labels[] = $day->format('l');
        }

        return[
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
        ];
    }

    public function sales(GetSoldProductsBetweenDate $soldProductsBetweenDate,
        DateGeneration $dateGeneration,
        Analytics $analytics,
        SalesOverTime $sales)
    {
        $date = Carbon::now(2);

        $graph = [];
        // цикл по днях місяця
        foreach ($dateGeneration->daysForMonth($date, true) as $day){
            // вибірка з БД і сумування ціни товарів
            $graph[] = round($soldProductsBetweenDate->handel($dateGeneration->generateStartEndDay($day))->sum('sale_price')/100, 2);
        }
        $subDate = $date->copy()->subMonth();
        $graph2 = [];
        foreach ($dateGeneration->daysForMonth($subDate, true) as $day){
            $graph2[] = round($soldProductsBetweenDate->handel($dateGeneration->generateStartEndDay($day))->sum('sale_price')/100, 2);
        }

        $labels = [];
        foreach ($dateGeneration->daysForMonth($date, true) as $day){
            $labels[] = $day->format('d');
        }

        $sinceLastMonth = $analytics->growthRates(collect($graph)->sum(), collect($graph2)->sum());
        $salesOverTime = $sales->handel();
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
