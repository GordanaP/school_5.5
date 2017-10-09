<?php

use Illuminate\Database\Seeder;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year = date("Y");

        $January1 = \Carbon\Carbon::create($year, 1, 1, 0);
        $January2 = \Carbon\Carbon::create($year, 1, 1, 0)->addDay(2);
        $January7 = \Carbon\Carbon::create($year, 1, 7, 0);
        $January8 = \Carbon\Carbon::create($year, 1, 7, 0)->addDay();
        $February15 = \Carbon\Carbon::create($year, 2, 15, 0);
        $February16 = \Carbon\Carbon::create($year, 2, 15, 0)->addDay(2);
        $May1 = \Carbon\Carbon::create($year, 5, 1, 0);
        $May2 = \Carbon\Carbon::create($year, 5, 1, 0)->addDay(2);
        $November11 = \Carbon\Carbon::create($year, 11, 11, 0);
        $November12 = \Carbon\Carbon::create($year, 11, 11, 0)->addDay();
        $GoodFriday = orthodox_good_friday($year);
        $EasterMonday = orthodox_easter_monday($year);

        $holidays = [
            0 => [
                'title' => 'New Year',
                'start' => $January1,
                'end' => $January2,
            ],
            1 => [
                'title' => 'Christmas',
                'start' => $January7,
                'end' => $January8,
            ],
            2 => [
                'title' => 'Sovereignty Day of Serbia',
                'start' => $February15,
                'end' => $February16,
            ],
            3 => [
                'title' => 'Labor Day',
                'start' => $May1,
                'end' => $May2,
            ],
            4 => [
                'title' => 'Armistice Day',
                'start' => $November11,
                'end' => $November12,
            ],
            5 => [
                'title' => 'Easter Holidays',
                'start' => $GoodFriday,
                'end' => $EasterMonday,
            ],
        ];

        foreach ($holidays as $holiday)
        {
            factory(App\Holiday::class)->create([
                'title' => $holiday['title'],
                'start' => $holiday['start'],
                'end' => $holiday['end'],
                'allDay' => true,
                'holiday' => true,
            ]);
        }
    }
}
