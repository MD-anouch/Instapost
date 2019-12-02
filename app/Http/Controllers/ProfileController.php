<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{

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
        return view('profile.index',compact('user'));
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
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
          ]);

// dd($request);



        //   $user = User::find($id);
          $user = auth()->user();
          $user->profile->title = $request->get('title');
          $user->profile->description = $request->get('description');
          $user->profile->url = $request->get('url');

          if ($request->hasFile('image')) {
            $image      = $request->file('image')->store('profile-image','public');
            $imageF = Image::make(public_path("storage/{$image}"))->fit(1200, 1200);
            $imageF->save();
            // $fileName   = time() . '.' . $image->getClientOriginalExtension();
            // $imageF->save();
            $user->profile->image = $image;
        }

          $user->profile->save();
          $this->authorize('update', $user->profile);

        // or  $user->update();
        //   $user->push();
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
