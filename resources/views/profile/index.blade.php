@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img class="rounded-circle" style="width:160px;height:150px" src="/storage/{{$user->profile->profileImage()}}" alt="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline pb-3">
                <div class="d-flex align-items-center">
                        <section><h2 >{{ $user->username }}</h2></section>
                @guest
                   <a href="/login"><button type="button" class="btn btn-primary ml-4" >Follow</button></a>
                @else

                    @if ( (Auth::user()->id) === ($user->id))
                    {{-- <p>none</p> --}}
                    @else
                    <follow-button class="ml-4" user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                    @endif

                @endguest
                        {{-- <button type="button" class="btn btn-primary ml-3">Follow</button> --}}
                </div>

                @can('update', $user->profile)
                {{-- <a href="../p/create">Add new post</a> --}}
                <!-- This is an anchor toggling the modal -->
                <a href="#modal-example" uk-toggle>Add new post</a>

                <!-- This is the modal -->
                <div id="modal-example" uk-modal>

                    <div class="uk-modal-dialog uk-modal-body">
                        <form action="/p" enctype= "multipart/form-data" method="POST">
                        <h2 class="uk-modal-title">Add a new post</h2>
                        {{-- form start --}}
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
                            {{-- form --}}
                                @csrf
                                    {{-- <h1>Add new post</h1> --}}
                                    <div  class="uk-form-horizontal uk-margin-large">
                                            {{-- <label for="caption" class="col-md-4 col-form-label">Post caption</label> --}}
                                            <label for="">Caption</label>
                                            <div class="row">
                                                <input id="caption" placeholder="caption" type="caption" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption">

                                                @error('caption')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="row  mt-2">
                                                    <div><label for="image">Insert image</label></div>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                         {{-- <input type="file" name="image" id="image"> --}}

                                                         <div class="uk-margin" uk-margin>
                                                                <div uk-form-custom="target: true">
                                                                    <input type="file" name="image" id="image">
                                                                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
                                                                </div>
                                                                {{-- <button class="uk-button uk-button-default">Submit</button> --}}
                                                        </div>

                                                            @error('image')
                                                             <strong>{{ $message }}</strong>
                                                            @enderror
                                                    </div>

                                                 </div>
                                            </div>
                                            <div class="row d-flex justify-content-end">
                                            {{-- <button class="btn btn-primary" type="submit">Post</button> --}}
                                            </div>
                                    </div>


                                  {{-- form --}}
                        </div>
                    </div>
                    </div>
                        {{-- form end --}}
                        <p class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                            <button class="uk-button uk-button-primary" type="submit">Post</button>
                        </p>
                    </form>
                    </div>


                </div>

                {{-- modal end --}}

                @endcan
            </div>
            @can('update', $user->profile)
            <a href="{{ route('profile.edit',$user->id)}}">Edit profile</a>
            @endcan



            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
              Launch
            </button> --}}

            <!-- Modal followers -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                               @foreach ($followers as $followers)
                                <p>{{ $followers->username }}</p>
                               @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#exampleModal').on('show.bs.modal', event => {
                    var button = $(event.relatedTarget);
                    var modal = $(this);
                    // Use above variables to manipulate the DOM

                });
            </script>
            {{-- end modal --}}

            <!-- Modal following -->
            <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                               @foreach ($following as $following)
                                <p>{{ $following->user->username }}</p>
                               @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#exampleModal').on('show.bs.modal', event => {
                    var button = $(event.relatedTarget);
                    var modal = $(this);
                    // Use above variables to manipulate the DOM

                });
            </script>
            {{-- end modal --}}


            <section class="d-flex">
                <div class="pr-4"><strong>{{ $postcount }}</strong> posts</div>
            {{-- modal button --}}

            <a  data-toggle="modal" data-target="#modelId">
            <div class="pr-4"><strong>{{$followerscount}}</strong> followers</div>
            </a>
           {{-- end --}}

            {{-- modal button --}}

            <a  data-toggle="modal" data-target="#modelId2">
             <div class="pr-4"><strong>{{$followingcount}}</strong> following</div>
            </a>
           {{-- end --}}

            </section>
            <div class="pt-3 font-weight-bold">{{$user->profile->title }}</div>
            <div>{{$user->profile->description }}</div>
            <div><a href="{{$user->profile->url ?? '#'}}"><strong>{{$user->profile->url ?? 'N/A'}}</strong></a></div>

        </div>

    </div>
    <div class="row">
        @foreach ($user->posts as $post)
        {{-- <div>{{$post->caption}}</div> --}}
            <div class="col-4 pt-5 uk-animation-toggle" tabindex="0">

                <a href="/p/{{$post->id}}">
                <img class="w-100 uk-animation-scale-down " src="/storage/{{$post->image}}" alt="">
                </a>

            </div>

        @endforeach


    </div>

</div>
@endsection
