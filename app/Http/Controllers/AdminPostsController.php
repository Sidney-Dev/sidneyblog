<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    public function index(){     

        //            <!--<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>-->
        $posts = Post::orderBy('id', 'DESC')->get();
        return view('admin.posts.index', compact('posts'));

    }

    public function create(){
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        if($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();
        
            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'photo' => $name
            ]);
            $file->move('images', $name);
        }
        else{
            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id
            ]);
        }
        return redirect('/admin/posts');
    }

    /***********   UPDATE FORM     ************/
    /******************************************/
    public function edit($id){
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /***********   UPDATE METHOD     ************/
    /******************************************/
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();
            $input1 = [
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'photo' => $name
            ];
            $file->move('images', $name);
            Auth::user()->posts()->whereId($id)->first()->update($input1);
        }
        else{
            $input2 = [
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id
            ];
            Auth::user()->posts()->whereId($id)->first()->update($input2);
        }
        return redirect('/admin/posts');
    }

    /***********   DELETE     ************/
    /******************************************/
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect('/admin/posts');
    }

    public function show(){
        return view('admin.posts.show');
    }


    /***********   SINGLE POST API     ************/
    /******************************************/
    public function single($slug){
        $post = Post::with('category', 'user')->where('slug', $slug)->first();
        return  response()->json([
            'post' => $post
        ], 200);
    }

}
