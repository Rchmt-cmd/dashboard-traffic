<?php

namespace App\Charts\Mmn;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KomposisiGolongan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public static function getCurrentTime($scope)
    {
        $queryDate = DB::table('info_traffic')
            ->select(DB::raw('date(date) as date'))
            ->groupBy('date')
            ->get('date')
            ->last();
        if ($scope == 'year') {
            return date('Y', strtotime($queryDate->date));
        } elseif ($scope == 'month') {
            return date('M', strtotime($queryDate->date));
        } elseif ($scope == 'monthfullname') {
            return date('F', strtotime($queryDate->date));
        } elseif ($scope == 'monthnumber') {
            return date('m', strtotime($queryDate->date));
        }
    }

    public function getPrevTime($scope)
    {
        $queryDate = DB::table('info_traffic')
            ->select(DB::raw('date(date) as date'))
            ->groupBy('date')
            ->get('date')
            ->last();
        if ($scope == 'year') {
            return date('Y', strtotime($queryDate->date . ' -1 year'));
        } elseif ($scope == 'month') {
            return date('M', strtotime($queryDate->date . 'first day of last month'));
        } elseif ($scope == 'monthfullname') {
            return date('F', strtotime($queryDate->date . 'first day of last month'));
        } elseif ($scope == 'monthnumber') {
            return date('m', strtotime($queryDate->date . 'first day of last month'));
        }
    }

    public function getGraphData($switch, $time = 'curr')
    {
        if ($time == 'curr') {

            $data = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', self::getCurrentTime('year'))
                ->whereMonth('date', self::getCurrentTime('monthnumber'))
                ->select(DB::raw('class as class, sum(traffic) as traffic'))
                ->groupBy('class')
                ->get()
                ->toArray();

            $total = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', self::getCurrentTime('year'))
                ->whereMonth('date', self::getCurrentTime('monthnumber'))
                ->sum('traffic');
        } elseif ($time == 'prev') {
            $data = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', self::getPrevTime('year'))
                ->whereMonth('date', self::getPrevTime('monthnumber'))
                ->select(DB::raw('class as class, sum(traffic) as traffic'))
                ->groupBy('class')
                ->get()
                ->toArray();

            $total = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', self::getPrevTime('year'))
                ->whereMonth('date', self::getPrevTime('monthnumber'))
                ->sum('traffic');
        }

        for ($i = 0; $i < sizeof($data); $i++) {
            $data[$i]->percentage = round(($data[$i]->traffic / $total) * 100, 1);
        }

        if ($switch == 'percentage') {
            $percentage = array();
            foreach ($data as $d) {
                array_push($percentage, $d->percentage);
            }
            return $percentage;
        } elseif ($switch == 'class') {
            $class = array();
            foreach ($data as $d) {
                array_push($class, 'Gol. ' . $d->class);
            }
            return $class;
        }
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        return $this->chart->donutChart()
            ->setFontFamily('poppins')
            ->setColors(['#25507D', '#5A5CE6', '#54D352', '#A8E96F', '#FF9D05'])
            ->setHeight(320)
            ->addData($this->getGraphData('percentage'))
            ->setLabels($this->getGraphData('class'));
    }
}
