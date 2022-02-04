<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $request->validate($this->generateErrorMessages()['field'],$this->generateErrorMessages()['messages']);
    $data = $request->all();

    
    $new_post = new Post();
    $new_post->fill($data);
    $new_post->slug = Post::generateSlug($new_post->title);
    $new_post->save();
    return redirect()->route('admin.posts.index',compact('new_post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)

    {
        
       return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)

    {
       
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $request->validate($this->generateErrorMessages()['field'],$this->generateErrorMessages()['messages']);
        $data = $request->all();
    
        
        $post->update($data);
       
       
        return redirect()->route('admin.posts.index',compact('post'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted',"il post $post->title è stato eliminato");;
    }

    public function generateErrorMessages(){
        return [
            "field"=>[
                "title"=>"required|max:100|min:2",
                "content"=>"required"
                ],
            "messages"=>[
                "title.required"=>"Il titolo è obbligatorio",
                "title.min"=>"Il titolo deve contenere minimo :min caratteri",
                "title.max"=>"Il titolo deve contenere massimo :max caratteri",
                "content.required"=>"Il post è obbligatorio"
                ]
        ];
    }
}
