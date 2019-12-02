@extends('layouts.app')

@section('content')

    <div class="container">
            <div class="uper">
                    @if(session()->get('success'))
                      <div class="alert alert-success">
                        {{ session()->get('success') }}
                      </div><br />
                    @endif
                    @if(session()->get('error'))
                      <div class="alert alert-success">
                        {{ session()->get('error') }}
                      </div><br />
                    @endif
            </div>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/p" enctype= "multipart/form-data" method="POST">
                @csrf
                    <h1>Add new post</h1>
                    <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label">Post caption</label>

                            <div class="col-md-12">
                                <input id="caption" placeholder="caption" type="caption" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption">

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div><label for="image">Insert image</label></div>
                    <div class="input-group mb-3">
                            <div class="custom-file">
                             <input type="file" name="image" id="image">
                                @error('image')
                                 <strong>{{ $message }}</strong>
                                @enderror
                            </div>

                          </div>

                        </div>
                        <button class="btn btn-primary" type="submit">Post</button>
                  </form>
        </div>
    </div>
    </div>




@endsection
