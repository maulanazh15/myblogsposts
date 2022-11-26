<?php

namespace App\Http\Controllers;

use App\Charts\CategoryChart;
use App\Charts\PostsChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;

class DashboardIndexController extends Controller
{
    public function index(PostsChart $chart, CategoryChart $categoryChart){
        return view('dashboard.index',[
            'title' => 'Dashboard',
            'postsChart' => $chart->build(),
            'categoryChart' => $categoryChart->build()
        ]);
    }
}
