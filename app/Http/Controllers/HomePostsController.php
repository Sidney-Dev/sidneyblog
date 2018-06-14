<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
class HomePostsController extends Controller
{
    public function posts(){
    	$posts = Post::with('user', 'category')->limit(6)->orderBy('id', 'desc')->get();
    	return response()->json(['posts' => $posts], 200);
    }
}
