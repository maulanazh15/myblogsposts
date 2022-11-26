<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Charts\PostsChart;
use App\Models\Comment;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function (){
//     return view('tailwind.home');
// });

// Route::get('/dashboard', function(){
//     return view('tailwind.dashboard.index');
// });

// Route::get('/about', function (){
//     return view('tailwind.about');
// });


Route::get('/', [PostController::class, 'index']);

Route::get('/welcome', [DocsController::class, 'show']);

Route::get('/about', function () {
    return view('about',[
        "title" => "About",
        "name" => "Sandhika Galih",
        "email" => "sandhikagalih@unpas.ac.id",
        "image" => "alas.jpg",
    ]);
});


Route::get('/posts', [PostController::class, 'index']);


Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth');
Route::post('posts/comment/{comment:id}/update', [CommentController::class, 'update'])->middleware('auth');
Route::post('posts/comment/{comment:id}/del', [CommentController::class, 'destroy'])->middleware('auth');

Route::get('/categories', function(){
    return view('categories',[
        'title' => 'Post Categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);



Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class, 'store']);



Route::get('/dashboard', function (PostsChart $chart){
    return view('dashboard.index',[
        'title' => 'Dashboard',
        'chart' => $chart->build()
    ]);
})->middleware('auth');

Route::post('/dashboard/profile/update', [UserController::class, 'update'])->middleware('auth');
Route::post('/dashboard/profile/img', [UserController::class, 'store'])->middleware('auth');
Route::get('/dashboard/profile', [UserController::class, 'index'])->middleware('auth');


Route::get('/dashboard/posts/createSlug', [DashboardPostController::class, 'createSlug'])->middleware('auth');
Route::get('/dashboard/categories/createSlug', [AdminCategoryController::class, 'createSlug'])->middleware('auth');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::resource('/dashboard/comments', CommentController::class)->middleware('auth');

Route::resource('/dashboard/categories',AdminCategoryController::class)->except('show')->middleware('admin');




