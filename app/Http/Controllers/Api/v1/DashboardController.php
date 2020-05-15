<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\OrderProduct;
use App\Services\Analytics\Analytics;
use App\Services\Analytics\DateGeneration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function sales(DateGeneration $dateGeneration, Analytics $analytics)
    {
        $date = Carbon::now(2);

        $graph = [];
        // цикл по днях місяця
        foreach ($dateGeneration->daysForMonth($date, true) as $day) {
            // вибірка з БД і сумування ціни товарів

            $graph[] = OrderProduct::sold($dateGeneration->generateStartEndDay($day))->get()
                ->sum(function ($orderProduct) {
                    return $orderProduct->sale_price * $orderProduct->count;
                });
        }
        $subDate = $date->copy()->subMonth();
        $graph2 = [];
        foreach ($dateGeneration->daysForMonth($subDate, true) as $day) {
            $graph2[] = OrderProduct::sold($dateGeneration->generateStartEndDay($day))->get()
                ->sum(function ($orderProduct) {
                    return $orderProduct->sale_price * $orderProduct->count;
                });
        }

        $labels = [];
        foreach ($dateGeneration->daysForMonth($date, true) as $day) {
            $labels[] = $day->format('d');
        }

        $sinceLastMonth = $analytics->growthRates(collect($graph)->sum(), collect($graph2)->sum());
        $salesOverTime = OrderProduct::salesOverTime()->first()->sale_price_sum;
        return [
            'sinceLastMonth' => $sinceLastMonth,
            'salesOverTime' => number_format($salesOverTime, 2), // английский формат
            'graph' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'backgroundColor' => '#007bff',
                        'borderColor' => '#007bff',
                        'data' => $graph
                    ],
                    [
                        'backgroundColor' => '#ced4da',
                        'borderColor' => '#ced4da',
                        'data' => $graph2
                    ]
                ]
            ]];
    }

}
