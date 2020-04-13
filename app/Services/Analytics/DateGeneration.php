<?php


namespace App\Services\Analytics;



use Carbon\Carbon;

class DateGeneration
{

    public function generateDaysRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->copy();
        }
        return $dates;
    }

    public function generateHoursRange(Carbon $start_date, Carbon $end_date)
    {
        $hours = [];
        for ($date = $start_date; $date->lte($end_date); $date->addHour()) {
            $hours[] = $date->copy();
        }
        return $hours;
    }

    /**
     * Всі тижні в періоді дати
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return array
     */
    public function generateWeeksRange(Carbon $startDate, Carbon $endDate)
    {
        $weeks = [];
        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $weeks[] = $date->copy();
        }
        return $weeks;
    }
    /**
     * Всі дні в місяці
     * @param Carbon $date
     * @param bool $current обмеження на кінцеву дату, не виходити за діапазон сьогоднішньої дати
     * @return array
     */
    public function daysForMonth(Carbon $date, $current = false)
    {
        return $this->generateDaysRange($date->copy()->startOfMonth(), $current ? $date :  $date->copy()->endOfMonth());
    }

    /**
     * Всі години в дні
     * @param Carbon $date
     * @param bool $current обмеження на кінцеву дату, не виходити за діапазон сьогоднішньої дати
     * @return array
     */
    public function hoursForDay(Carbon $date, $current = false)
    {
        return $this->generateHoursRange($date->copy()->startOfDay(), $current ? $date :  $date->copy()->endOfHour());
    }

    /**
     * Всі дні в тиждні
     * @param Carbon $date
     * @param bool $current обмеження на кінцеву дату, не виходити за діапазон сьогоднішньої дати
     * @return array масив днів за тиждень
     */
    public function daysForWeek(Carbon $date, $current = false)
    {
        return $this->generateDaysRange($date->copy()->startOfWeek(), $current ? $date :  $date->copy()->endOfWeek());
    }

    public function generateStartEndHour(Carbon $date)
    {
        return [$date->copy()->startOfHour(), $date->copy()->endOfHour()];
    }

    public function generateStartEndDay(Carbon $date)
    {
        return [$date->copy()->startOfDay(), $date->copy()->endOfDay()];
    }

    public function generateStartEndWeek(Carbon $date)
    {
        return [$date->copy()->startOfWeek(), $date->copy()->endOfWeek()];
    }

    public function generateStartEndMonth(Carbon $date)
    {
        return [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()];
    }

}
