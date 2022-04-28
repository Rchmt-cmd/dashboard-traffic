<?php

namespace App\Charts\Mmn;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PerbandinganGerbang
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
                ->select(DB::raw('gate as gate, sum(traffic) as traffic'))
                ->groupBy('gate')
                ->get()
                ->toArray();
        } elseif ($time == 'prev') {
            $data = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', self::getPrevTime('year'))
                ->whereMonth('date', self::getPrevTime('monthnumber'))
                ->select(DB::raw('gate as gate, sum(traffic) as traffic'))
                ->groupBy('gate')
                ->get()
                ->toArray();
        }

        if ($switch == 'traffic') {
            $traffic = array();
            foreach ($data as $d) {
                array_push($traffic, $d->traffic);
            }
            return $traffic;
        } elseif ($switch == 'gate') {
            $gate = array();
            foreach ($data as $d) {
                array_push($gate, $d->gate);
            }
            return $gate;
        }
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        return $this->chart->horizontalBarChart()
            ->setFontFamily('poppins')
            ->setColors(['#FFC469', '#25507D'])
            ->setHeight(300)
            ->setGrid()
            ->addData($this->getPrevTime('year'), $this->getGraphData('traffic', 'prev'))
            ->addData($this->getCurrentTime('year'), $this->getGraphData('traffic'))
            ->setXAxis($this->getGraphData('gate'));
    }
}
