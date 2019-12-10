@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 p-0" style="margin:auto">
            <img src="/storage/{{$post->image}}" class="rounded mx-auto d-block w-100" alt="">
        </div>
        <div class="col-4 badge-dark p-4" >
        <div class="d-flex align-items-center">
           <div class="pr-3"><img class="rounded-circle" style="width:42px;height:42px" src="/storage/{{$post->user->profile->profileImage()}}" alt=""></div>
            <div class=" d-flex align-items-center">
                <h5 class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-white">{{ $post->user->username }}</span></a> |</h5>
                @if ( (Auth::user()->id) === ($post->user->id))
                <div>
                <form action="{{ route('p.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ml-1" style="color:white" type="submit">Delete</button>
                </form>
                </div>
                @else
                <follow-button class="ml-1" user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>
                @endif
            </div>
        </div>
        <hr>

<section class=" d-flex justify-content-between">
    <p><span class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class=" text-blue">{{ $post->user->username }}</span></a></span> {{ $post->caption }}</p>
    <!-- Button trigger modal -->
    <a href="#modal-example" uk-toggle>Comment</a>
</section>


<!-- This is the modal -->
<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <form method="post" action="{{ route('comment.store') }}" enctype="multipart/form-data">
        <h2 class="uk-modal-title">Comment</h2>
    {{-- modal form start --}}
    <style>
            .uper {
              margin-top: 40px;
            }
          </style>
          <div class="card uper">
            {{-- <div class="card-header">
              Add Share
            </div> --}}
            <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div><br />
              @endif
                    @csrf
                    <div class="uk-margin">
                        {{-- <label for="name">Comment</label> --}}
                        <input class="uk-input uk-form-width-large" type="text" name="comment"/>
                        <input type="hidden" name="postid" value="{{$post->id}}">

                    </div>

                    <div>
                    {{-- <button type="submit" class=" uk-button-primary">Comment</button> --}}
                    </div>
            </div>
          </div>
          {{-- modal form end --}}
                  <p class="uk-text-right mt-2">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="submit">Comment</button>
        </p>
        </form>


    </div>
</div>
{{-- Modal end --}}



  {{-- comment section --}}


        <div>
            @foreach ($comment as $c)
            {{-- <h5>{{ $c->user->username }}</h5>
            <i class="fa fa-comment-o" aria-hidden="true"><p>{{ $c->comment }}</p></i><br> --}}
            <div class="media pt-4">
                <div class=" pr-2">
                <img src="/storage/{{$c->user->profile->profileImage()}}" class=" rounded-circle" style="width:30px" alt="...">
                 </div>
                <div class="media-body">
                        <a href="/profile/{{$post->user->id}}"><h5 class="mt-0 text-white">{{ $c->user->username }}</h5></a>
                  <div class=" d-flex justify-content-between">
                  {{ $c->comment }}
                  @if (auth()->user()->id == $c->user_id )
                  <form action="{{ route('comment.destroy', $c->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="uk-button uk-button-link" style="color:red" type="submit">Delete</button>
                  </form>
                  @else
                  {{-- none --}}
                  @endif
                </div>
                </div>
              </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center mt-4" style="margin:auto;">
                    {{ $comment->links() }}
            </div>

        </div>

  {{-- end of comment --}}
        </div>
    </div>
</div>
@endsection
