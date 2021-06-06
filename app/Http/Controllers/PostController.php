<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected function _validation_rules($request, $id)
    {
        return [
            'user_name' => ['required'],
            'title'     =>  ["required"],
            'description' => ['required'],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['posts'] = Post::all();
        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['posts']  = Post::all();
        $data['method']  = 'POST';
        $data['route']  = route('posts.store');
        return view('posts.partials.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), 
        $this->_validation_rules($request, Null));
        if ($validation->fails())
        {
            return redirect('posts/create')
                        ->withErrors($validation)
                        ->withInput();
        }
        $model = new Post();
        $this->_save($model, $id);
        return redirect()->route('posts.index')
        ->with('success','Post created successfully');

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
    public function edit($id)
    {
        $data = [];
        $data['model']  = Post::find($id);
        $data['posts']  = Post::all();
        $data['method']  = 'PATCH';
        $data['route']  = route('posts.update',$id);
        $data['id']     = $id;
        return view('posts.partials.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), 
        $this->_validation_rules($request, $id));

        if ($validation->fails())
        {
            return redirect('posts/'.$id.'/edit')
                        ->withErrors($validation)
                        ->withInput();
        }
        $model = Post::find($id);
        $this->_save($model, $id);
        return redirect()->route('posts.index')
        ->with('success','Post Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Post::find($id);
        $model->delete();

        return redirect()->route('posts.index')
        ->with('success','Post Deleted successfully');
    }

    protected function _save($model,&$id){
        $data = request()->except('_token');
        $model->fill($data);
        $model->save();
    }
}
