<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category')->orderBy('id', 'desc')->paginate(10);
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

    public function store(Request $request)
    {
        $exploded = explode(',', request('photo'));
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';   

        $fileName = str_random().'.'.$extension;
        $path = public_path().'/'.$fileName;
        file_put_contents($path, $decoded);
        $post = Post::create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => Auth::id(),
            'category_id' => request('category_id'),
            'photo' => $fileName
        ]);

        return response()->json([
            'post' => $post,
        ], 200);
    }

    public function show($id)
    {
    
    }


    public function update(Request $request, $id)
    {
        $exploded = explode(',', request('photo'));
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';   

        $fileName = str_random().'.'.$extension;
        $path = public_path().'/'.$fileName;
        file_put_contents($path, $decoded);

        $post = Post::findOrFail($id);
        $post->title = request('title');
        $post->description = request('description');
        $post->category_id = request('category_id');
        $post->user_id = Auth::id();
        $post->photo = $fileName;
        $post->save();

        return response()->json([
            'post' => $post,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
    }
}
