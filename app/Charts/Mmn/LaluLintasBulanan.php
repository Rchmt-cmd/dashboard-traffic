<?php

namespace App\Charts\Mmn;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LaluLintasBulanan
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

    public function getLhrData($year, $month, $company = 'MMN')
    {
        $date = DB::table('info_traffic')
            ->where('company', $company)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->select(DB::raw('date(date) as day'))
            ->groupBy('date')
            ->get()
            ->last();
        $countDay = date('d', strtotime($date->day));

        $traffic = DB::table('info_traffic')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('company', $company)
            ->sum('traffic');
        $mean = $traffic / ($countDay);

        return number_format(round($mean), 0, '.', '.');
    }

    protected function getGraphData($switch = 'curr')
    {
        if ($switch == 'curr') {
            $a = array();
            for ($month = 1; $month <= 12; $month++) {
                $graph = $this->getLhrData($this->getCurrentTime('year'), $month);
                array_push($a, $graph);
            }
            return $a;
        } elseif ($switch == 'prev') {
            $a = array();
            for ($month = 1; $month <= 12; $month++) {
                $graph = $this->getLhrData($this->getPrevTime('year'), $month);
                array_push($a, $graph);
            }
            return $a;
        }
    }

    public function getLhrYtd($switch = 'curr')
    {
        if ($switch == 'curr') {
            $data = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', $this->getCurrentTime('year'))
                ->sum('traffic');
            $countDay = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', $this->getCurrentTime('year'))
                ->select(DB::raw('date(date) as day'))
                ->groupBy('date')
                ->get('date')
                ->toArray();
            $countDay = count($countDay);
            $lhr = round($data / $countDay);
            return number_format(round($lhr), 0, '.', '.');
        } elseif ($switch == 'prev') {
            $data = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', $this->getPrevTime('year'))
                ->sum('traffic');
            $countDay = DB::table('info_traffic')
                ->where('company', 'MMN')
                ->whereYear('date', $this->getPrevTime('year'))
                ->select(DB::raw('date(date) as day'))
                ->groupBy('date')
                ->get('date')
                ->toArray();
            $countDay = count($countDay);
            $lhr = round($data / $countDay);
            return number_format(round($lhr), 0, '.', '.');
        }
    }

    public function getGrowth()
    {
        $currLhr = $this->getLhrYtd('curr');
        $prevLhr = $this->getLhrYtd('prev');
        $growth = ($currLhr - $prevLhr) / $prevLhr * 100;

        return number_format($growth, 1, '.', '.');
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setFontFamily('poppins')
            ->setColors(['#FFC469', '#25507D'])
            ->setGrid()
            ->addData($this->getPrevTime('year'), $this->getGraphData('prev'))
            ->addData($this->getCurrentTime('year'), $this->getGraphData())
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des']);
    }
}
