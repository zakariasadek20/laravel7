<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->only(['create','update','store','destroy']);
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ////////////////////////////
        // DB::connection()->enableQueryLog();
        // //Lasy Mode
        // $posts=Post::all();
        // foreach($posts as $post){
        //     foreach($post->comments as $comment){
        //         dd($comment);
        //     }
        // }
        // //Mode Earger
        // $posts=Post::with('comments')->get();
        // foreach($posts as $post){
        //     foreach($post->comments as $comment){
        //         dd($comment);
        //     }
        // }
        // ///////
        // //shows Queryies
        // dd(DB::getQueryLog());
        // ////////////////////////////

        $posts=Post::withCount('comments')->get();
            

        // dd(\App\Post::all());
        return view('posts.index',[
            'posts'=>$posts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(\App\Post::find($id));
        return view('posts.show',[
            'post'=>Post::find($id)
        ]);
    }

    public function create(){

        return view('posts.create');
    }
    public function edit($id){
        $post=Post::findOrFail($id);
        return view('posts.edit',[
            'post'=>$post
        ]);
    }
    public function update(StorePost $request,$id){
        $post=Post::findOrFail($id);
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->slug=Str::slug($post->title,'-');
        $active=$request->input('active');
        if($active==='true'){
            $active=1;
        }else{
            $active=0;
        }
        $post->save();
        $request->session()->flash('status','Post was updated');
        return redirect()->route('posts.index');
        
    }
    public function store(StorePost $request){

        $data=$request->only(['title','content']);
        $data['slug']=Str::slug($data['title'],'-');
        $active=$request->input('active');
        if($active==='true'){
            $data['active']=1;
        }else{
            $data['active']=0;
        }
        $post=Post::create($data);

        // $validatedData=$request->validate([
        //     'title'=>'bail|min:4|required|max:100',
        //     'content'=>'required'
        //     ,'active'=>'required'
        // ]);
        
        //Persistance
        // $title=$request->input('title');
        // $content=$request->input('content');
        // $active=$request->input('active');
        // $post=new Post();
        // $post->title=$title;
        // $post->content=$content;
        // $post->slug= Str::slug($title,'-');
        // if($active==='true'){
        // $post->active=1;
        // }else{
        //     $post->active=0;
        // }
        $request->session()->flash('status','post was created');
        //$post->save();
        return redirect()->route('posts.index');
    }

    public function destroy(Request $request, $id){
        // $post=Post::findOrFail($id);
        // $post->delete();
        $post=Post::destroy([$id]);
        $request->session()->flash('status','Post was Deleted');
        return redirect()->route('posts.index');
    }




}
