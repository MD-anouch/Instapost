<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{


    public function search(Request $request){

        $s = $request->get('search');
        $user = User::where('username','like', '%' . $s . '%')->get();
        $count = User::where('username','like', '%' . $s . '%')->count();
        return view('profile.search',compact('user', 'count'));


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        // $profile=Profile::findOrFail($id);
        $follows= (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $following = $user->following()->get();
        $followers = $user->profile->followers()->get();


        $postcount = Cache::remember('posts.count'. $user->id, now()->addSeconds(3), function () use ($user) {
            return $user->posts->count();
        });;

        $followerscount = Cache::remember('followers.count'. $user->id, now()->addSeconds(3), function () use ($user) {
            return $user->profile->followers()->count();
        });;

        $followingcount = Cache::remember('following.count'. $user->id, now()->addSeconds(3), function () use ($user) {
            return $user->following()->count();
        });;

        // dd($follows);
        return view('profile.index',compact('user', 'following', 'followers','follows', 'postcount', 'followerscount', 'followingcount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user=User::findOrFail($id);
        $this->authorize('update', $user->profile);
        return view('profile.edit',compact('user'));
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

        $request->validate([
            'title'=>'required',
            'description'=> 'required',
            'url' => 'required',
            'image' => '',
          ]);

// dd($request);



        //   $user = User::find($id);
          $user = auth()->user();
          $user->profile->title = $request->get('title');
          $user->profile->description = $request->get('description');
          $user->profile->url = $request->get('url');

          if ($request->hasFile('image')) {
            $image      = $request->file('image')->store('profile','public');
            $imageF = Image::make(public_path("storage/{$image}"))->fit(1000, 1000);
            $imageF->save();
            // $fileName   = time() . '.' . $image->getClientOriginalExtension();
            // $imageF->save();
            $user->profile->image = $image;
        }

         $user->profile->save();
        //   dd($user->save());
        //   $user->push();
          $this->authorize('update', $user->profile);


        // $this->authorize('update', $user->profile);

          return redirect('/profile/'.auth()->user()->id)->with('success', 'Stock has been updated');
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
