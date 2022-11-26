<?php

namespace App\Charts;

use App\Models\Category;
use App\Models\Post;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class CategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $month = now()->monthName;
        $category = Post::groupBy('category_id')->select('category_id', DB::raw('COUNT(*) AS total'))->orderBy('category_id','asc')->get()->toArray();
        $sum_category = [];
        for ($i=0; $i < count($category); $i++) { 
            $sum_category[$i] = $category[$i]['total'];
        }
        $category_name = Category::all('name')->sortBy('id')->toArray();
        $name = [];
        for ($i=0; $i  < count($category_name) ; $i++) { 
            $name[$i] = $category_name[$i]['name'];
        }
        // dd($category_name);
        return $this->chart->pieChart()
            ->setTitle('Jumlah Post per Kategori.')
            ->setSubtitle('Bulan '.$month)
            ->addData($sum_category)
            ->setLabels($name);
    }
}
