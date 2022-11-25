<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in '.$category->name;
        }
        if(request('user')){
            $username = User::firstWhere('username', request('user'));
            $title = ' by '.$username->name;
        }

        return view('posts', [
            "title" => "All Posts".$title,
            'posts' => Post::latest()->filter(request(['search','category','user']))->paginate(7)
            ->withQueryString()
        ]);
    }

    public function show(Post $post){
        return view('post',[
            "title" => "Single Post",
            "post" => $post,
            "comments" => Comment::where('post_id', $post->id)->get()
        ]);
    }
}
