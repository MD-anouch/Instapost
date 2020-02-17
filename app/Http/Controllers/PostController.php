<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function likePost(Request $request){

        $post_id = $request->postId;
        // $post_id = 18;
        $is_like =  $request['islike'] === true;
        $update = false ;
        $post = Post::Find($post_id);
        if (!$post) {
            return null;
        }
        $user  = auth()->user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        }
        else {
            $like = new like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        // $like->post_id = $post;
        $like->post_id = $post_id;
        if ($update) {
            $like->update();
        }
        else {
            $like->save();
        }
        return null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all()->random()->limit(7)->get();
        $post = Post::all()->sortBy('created_at');
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        // $posts2 = Post::whereIn('user_id', $users)->with('user');
        // $follows= (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        // dd($posts);
        return view('post.index', compact('user', 'post', 'users', 'posts'));
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
            $imageF = Image::make(public_path("storage/{$image}"))->resize(1200, 1200);
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
        $comment = Comment::where('post_id', '=', $id)->latest()->paginate(6);
        $follows= (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        return view('post.show',compact('post', 'comment', 'follows'));
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
        $post = Post::find($id);
        $post->delete();
        return redirect('/profile/'.auth()->user()->id)->with('success', 'The post has been deleted');
    }
}
