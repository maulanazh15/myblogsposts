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
        $from = date('01-11-2022');
        $to = date('20-12-2022');
        $posts = Post::whereMonth('created_at','11')->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get(array(
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as "total"')
        ));
        // $created_at = Post::select('created_at')->distinct()->get()->toArray()->created_at;
        $sum_post = array();
        for ($i=0; $i < count($posts); $i++) { 
            $sum_post[$i] = $posts[$i]->total;
        }
        $axis = array();
        for ($i=0; $i < count($posts); $i++) { 
            $axis[$i] = $posts[$i]->date;
        }
        // dd($sum_post);
        return $this->chart->lineChart()
            ->setTitle('Jumlah posts di bulan November.')
            ->setSubtitle('Per Hari.')
            ->addData('Tanggal', $sum_post)
            ->setXAxis($axis);
    }
}
