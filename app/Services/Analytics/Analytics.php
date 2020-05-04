<?php


namespace App\Services\Analytics;


use App\SoldProduct;
use Illuminate\Support\Carbon;

class Analytics
{

    /**
     * Цепной прирост рассчитывают как разность между текущим и предыдущим показателями, деленную на темп роста предыдущего период
     * @param $current
     * @param $base
     * @return false|float
     */
    public function growthRates($current, $base)
    {
        $base =  $base == 0 ? $current: $base;
        return round(($current - $base) / $base * 100, 2);
    }

    /**
     * Для определения среднего темпа роста расчетные показатели по периодам складывают и делят на количество периодов.
     * @param array $percentPeriods
     * @return false|float
     */
    public function averageGrowthRate(array $volumePeriods)
    {
        $percentPeriods = [];
        for ($i = 1; count($volumePeriods) > $i; $i++){
            $percentPeriods[] = $this->growthRates($volumePeriods[$i], $volumePeriods[$i-1]);
        }
//        dump($percentPeriods);
        return round(array_sum($percentPeriods) / count($percentPeriods), 2);
    }

}
