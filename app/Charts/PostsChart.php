<?php

namespace App\Charts;

use App\Models\Post;
use App\Models\Comment;
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
        $n_day = now()->daysInMonth;
        $posts = Post::whereMonth('created_at',$month)->groupBy('day')
        ->orderBy('day', 'ASC')
        ->get(array(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as "total"')
        ));

        

        // dd($comments);
        $sum_post = array();
        $sum_comment = array();
        for ($i=0; $i < count($posts); $i++) {
            $sum_post[$i] = $posts[$i]->total;
        }
        
        $day_date = array();
        for ($i=0; $i < count($posts); $i++) { 
            $day_date[$i] = $posts[$i]->day;
        }
        $comments = Comment::whereMonth('created_at',$month)->whereIn(DB::raw("DAY(created_at)"),$day_date)->groupBy('day')
        ->orderBy('day', 'ASC')
        ->get(array(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as "total"')
        ));
        for ($i=0; $i < count($comments); $i++) {
            $sum_comment[$i] = $comments[$i]->total;
        }
        // for ($i=1; $i <= $n_day ; $i++) { 
        //     $day_date[$i] = (int) $i;
        // }
        // dd($sum_post);
        return $this->chart->lineChart()
            ->setTitle('Jumlah Post dan Komen di bulan '.now()->monthName)
            ->setSubtitle('Post & Komen (Per Tanggal)')
            ->addData('Jumlah Post', $sum_post)
            ->addData('Jumlah Komen',$sum_comment)
            ->setGrid()
            ->setXAxis($day_date);
    }
}
