<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->with('category')->orderBy('id', 'desc')->get();
        return response()->json([
            'posts' => $posts
        ], 200);
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

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
    }
}
