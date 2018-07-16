<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function users(){
        return view('admin');
    }
    
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::create([
            'name' => request('name'),
            'password' => bcrypt(request('password')),
            'email' => request('email'),
            'role_id' =>request('role_id'),
            'is_active' => request('is_active'),
        ]);
        return response()->json([
            'user' => $user, 
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loggUser()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->role_id = request('role_id');
        $user->is_active = request('is_active');
        $user->save();
        return response()->json([
            'user' => $user, 
        ], 200);
    }


    public function updateUser(Request $request, $id)
    {
        if($request->file('photo') == ''){
            $user = User::findOrFail($id);
            $user->name = request('name');
            $user->email = request('email');
           // $user->role_id = request('role_id');
           // $user->is_active = request('is_active');
            $user->save();            
        }
        else{
            $exploded = explode(',', $request->file('photo'));
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';   

            $fileName = str_random().'.'.$extension;
            $path = public_path().'/'.$fileName;
            file_put_contents($path, $decoded);

            $user = User::findOrFail($id);
            $user->name = request('name');
            $user->email = request('email');
           // $user->role_id = request('role_id');
          //  $user->is_active = request('is_active');
            $user->photo = $fileName;
          //  $user->save();  
            $user->save();
        }
        return response()->json([
            'user' => $user, 
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        User::findOrFail($id)->delete();
    }
}
