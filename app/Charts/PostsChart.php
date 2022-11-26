<?php

namespace App\Charts;

use App\Models\Post;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class PostsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $month = now()->month;
        $posts = Post::whereMonth('created_at',$month)->groupBy('day')
        ->orderBy('day', 'ASC')
        ->get(array(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as "total"')
        ));
        $sum_post = array();
        for ($i=0; $i < count($posts); $i++) { 
            $sum_post[$i] = $posts[$i]->total;
        }
        $axis = array();
        for ($i=0; $i < count($posts); $i++) { 
            $axis[$i] = $posts[$i]->day;
        }
        // dd($sum_post);
        return $this->chart->lineChart()
            ->setTitle('Jumlah posts di bulan '.now()->monthName)
            ->setSubtitle('Per Tanggal.')
            ->addData('Jumlah Post', $sum_post)
            ->setGrid()
            ->setXAxis($axis);
    }
}
