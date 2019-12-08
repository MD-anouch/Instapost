@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('profile.update', $user->id) }}" enctype= "multipart/form-data" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                      <label for="name">Title</label>
                      <input type="text" class="form-control" name="title" value='{{ $user->profile->title }}' />
                    </div>
                    <div class="form-group">
                      <label for="price">Description</label>
                      <input type="text" class="form-control" name="description" value='{{ $user->profile->description }}' />
                    </div>
                    <div class="form-group">
                      <label for="quantity">url</label>
                      <input type="text" class="form-control" name="url" value='{{ $user->profile->url }}' />
                    </div>
                    <div class="form-group">
                      <label for="quantity">image</label>
                      <div class="input-group mb-3">
                            <div class="custom-file">
                            <input type="file" name="image" id="image" value='{{$user->profile->image}}'>
                                @error('image')
                                 <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                    </div>
                 </div>
                    <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
