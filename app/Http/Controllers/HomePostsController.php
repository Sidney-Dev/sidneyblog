<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
class HomePostsController extends Controller
{
    public function posts(){
        $posts = Post::with('user', 'category')->orderBy('id', 'desc')->paginate(5);
        $response = [
            'pagination' => [
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'from' => $posts->firstItem(),
                'to' => $posts->lastItem()
            ],
            'data' => $posts
        ];
        return response()->json($response);
    }
}
