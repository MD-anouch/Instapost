<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

          ]);


        $post= new Post ([
            "caption"=>$request->get('caption'),
            // "image"=>$request->file('image'),
        ]);
        if ($request->hasFile('image')) {
            $image      = $request->file('image')->store('uploads','public');
            $imageF = Image::make(public_path("storage/{$image}"))->fit(1200, 1200);
            $imageF->save();
            // $fileName   = time() . '.' . $image->getClientOriginalExtension();
            // $imageF->save();
            $post->image = $image;
        }
        // dd(request('image'));
        // Post::create($request);
        // auth()->user()->id;
        $post->user_id = auth()->user()->id;
        $post->save();

        // dd($request->all());
          return redirect('/profile/'.auth()->user()->id)->with('success', 'Post has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
        return view('post.show',compact('post'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
