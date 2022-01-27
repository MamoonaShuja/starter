<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Auth;
use File;

class PostController extends Controller
{
    /**
     * isplay a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $input = $request->all();
        $imageName = time().'.'.$request->img->extension();  
        $request->img->move(public_path('images'), $imageName);
        $input['img'] = $imageName;
        $input['user_id'] = Auth::user()->id;
        $post = new Post();
        $post->fill($input);
        $post->save();
        return redirect(route('index.post.index'))->withSuccess('msg' , "Updated Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $input = $request->all();
        if($request->hasFile('img')){
            $imageName = time().'.'.$request->img->extension();  
            $request->img->move(public_path('images'), $imageName);
            $input['img'] = $imageName;
            $file_path = public_path('images').'/'.$post->img; // if your file is in some folder in public directory.
            if(File::exists($file_path)){
                File::delete($file_path); //for deleting only file try this
            }
        }
        $post->fill($input);
        $post->update();
        return redirect(route('index.post.index'))->withSuccess('msg' , "Updated Successfully");
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

    }
}
