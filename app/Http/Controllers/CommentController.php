<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected function _validation_rules($request, $id)
    {
        return [
            'user_name' => ['required'],
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
        //
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
        $validation = Validator::make($request->all(), 
        $this->_validation_rules($request, Null));
        if ($validation->fails())
        {
            return redirect('posts')
                        ->withErrors($validation)
                        ->withInput();
        }
        $model = new Comment();
        $this->_save($model, $id);
        return redirect()->route('posts.index')
        ->with('success','Comment created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment =  Comment::find($id);
        $method  = 'PATCH';
        $route  = route('comments.update',$id);
        return response()->json([
	      'data' => $comment,
          'route' => $route,
          'method' => $method
	    ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Comment::find($id);

        $validation = Validator::make($request->all(), 
        $this->_validation_rules($request, $id));

        if ($validation->fails())
        {
            return redirect('posts')
                        ->withErrors($validation)
                        ->withInput();
        }
        $model = Comment::find($id);
        $this->_save($model, $id);
        return redirect()->route('posts.index')
        ->with('success','Comment Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Comment::find($id);
        $model->delete();

        return redirect()->route('posts.index')
        ->with('success','Comment Deleted successfully');
    }

    protected function _save($model,&$id){

        $data = request()->except('_token');
        $model->fill($data);
        $model->save();
    }
}
