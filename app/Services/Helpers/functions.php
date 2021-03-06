<?php

function selected($selected, $current)
{
    return $selected == $current ? 'selected' : '';
}

function orthodox_easter_sunday($year)
{
    $a = $year % 4;
    $b = $year % 7;
    $c = $year % 19;
    $d = (19 * $c + 15) % 30;
    $e = (2 * $a + 4 * $b - $d + 34) % 7;
    $month = floor(($d + $e + 114) / 31);
    $day = (($d + $e + 114) % 31) + 1;

    return \Carbon\Carbon::create($year, $month, ($day+13), 0);
}

function orthodox_good_friday($year)
{
    $a = $year % 4;
    $b = $year % 7;
    $c = $year % 19;
    $d = (19 * $c + 15) % 30;
    $e = (2 * $a + 4 * $b - $d + 34) % 7;
    $month = floor(($d + $e + 114) / 31);
    $day = (($d + $e + 114) % 31) + 1;

    return \Carbon\Carbon::create($year, $month, ($day+13), 0)->subDay(2);
}

function orthodox_easter_monday($year)
{
    $a = $year % 4;
    $b = $year % 7;
    $c = $year % 19;
    $d = (19 * $c + 15) % 30;
    $e = (2 * $a + 4 * $b - $d + 34) % 7;
    $month = floor(($d + $e + 114) / 31);
    $day = (($d + $e + 114) % 31) + 1;

    return \Carbon\Carbon::create($year, $month, ($day+13), 0)->addDay(2);
}

function maxDate()
{
    $currMonth = \Carbon\Carbon::now()->month;
    $currYear = \Carbon\Carbon::now()->year;
    $nextYear = \Carbon\Carbon::now()->addYear()->year;

    $year = $currMonth >=9 && $currMonth <=12 ? $nextYear : $currYear;
    $month = 8;
    $day = 31;

    $date = \Carbon\Carbon::createFromDate($year, $month, $day)->toDateString();

    return $date;
}