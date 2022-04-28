<?php

namespace App\Charts\Mmn;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class LaluLintasHarianGerbang
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setFontFamily('poppins')
            ->setColors(['#FFC469', '#25507D'])
            ->setGrid()
            ->addData('2021', [12600, 13300, 10900, 13800, 13800, 12200, 11200, 11900, 7520, 12300, 11500, 7470, 4800, 4910, 20100, 18700, 20500, 17800, 23800, 18700, 13300, 10900, 13800, 16700, 12800, 11200, 11900, 7520, 13300, 10900, 18700])
            ->addData('2022', [13100, 14100, 10200, 14700, 14000, 12100])
            ->setXAxis(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31']);
    }
}
