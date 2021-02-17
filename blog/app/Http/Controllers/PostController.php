<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
//use Cassandra\Session;
use App\Tag;
use Illuminate\Http\Request;
use Session;
class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->approved()->published()->paginate(6);
        return view('posts',compact('posts'));
    }

    public function details($slug){
        $post = Post::where('slug',$slug)->approved()->published()->first();
        $randomposts = Post::approved()->published()->take(3)->inRandomOrder()->get();

        $blogkey = 'blog_'.$post->id;

        if (!Session::has($blogkey)){
            $post->increment('view_count');
            Session::put($blogkey,1);
        }

        return view('post',compact('post','randomposts'));
    }

    public function postByCategory($slug){
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->approved()->published()->get();
        return view('category',compact('category','posts'));

    }

    public function postByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->approved()->published()->get();
        return view('tag',compact('tag','posts'));

    }
}
