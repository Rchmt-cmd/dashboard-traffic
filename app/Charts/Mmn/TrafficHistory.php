<?php

namespace App\Charts\Mmn;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class TrafficHistory
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setFontFamily('poppins')
            ->setColors(['#25507D'])
            ->setGrid()
            ->addData('Traffic History', [14588, 18147, 21138, 22508, 24474, 26562, 27919, 28096, 26401, 26201, 25096, 34789, 38980, 43972, 48412, 54035, 55604, 57232, 58501, 62732, 62479, 56382, 39665, 44629, 47344])
            ->setXAxis(['1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022']);
    }
}
