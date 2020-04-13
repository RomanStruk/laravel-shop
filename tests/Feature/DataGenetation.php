<?php

namespace Tests\Feature;

use App\Services\Analytics\DateGeneration;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataGenetation extends TestCase
{
    public function test_generation_data()
    {

        $date = Carbon::now();
        $from = $date->copy()->subDays(2); // 2дня тому
        $to = $date->copy();    // зараз

        $dataGeneration = new DateGeneration();
        $result = $dataGeneration->generateDaysRange($from, $to);
//        foreach ($result as $date){
//            dump($date->format('Y-m-d H:i:s'));
//        }
        $this->assertTrue(count($result) == 3);
    }

    public function test_generate_dates_for_month()
    {
        $date = Carbon::create(2020, 5, 10); // цей місяць
        $dataGeneration = new DateGeneration();
        $result = $dataGeneration->daysForMonth($date); //результат за місяць
        foreach ($result as $date){
            $this->assertTrue($date->month == 5);
        }
        $this->assertTrue(count($result) == 10, 'Count Month');
    }

    public function test_generate_start_end_day()
    {
        $date = Carbon::create(2020, 5, 10); // дата
        $dataGeneration = new DateGeneration();
        $result = $dataGeneration->generateStartEndDay($date); //результат за день

        $this->assertTrue($result[0]->format('Y-m-d H:i:s') == '2020-05-10 00:00:00');
        $this->assertTrue($result[1]->format('Y-m-d H:i:s') == '2020-05-10 23:59:59');
    }

    public function test_start_end_hour_generate()
    {
        $date = Carbon::create(2020, 5, 10, 20); // дата
        $dataGeneration = new DateGeneration();
        $result = $dataGeneration->generateStartEndHour($date); //результат за годину
        $this->assertTrue($result[0]->format('Y-m-d H:i:s') == '2020-05-10 20:00:00');
        $this->assertTrue($result[1]->format('Y-m-d H:i:s') == '2020-05-10 20:59:59');
//        dd($result);
    }

    public function test_generate_hours_range()
    {
        $date = Carbon::create(2020, 5, 10, 20); // дата
        $dataGeneration = new DateGeneration();
        $day = $dataGeneration->generateStartEndDay($date);
        $result = $dataGeneration->generateHoursRange($day[0], $day[1]);
        $this->assertTrue(count($result) == 24, 'Count Hours');
//        dd($result);
    }
}
