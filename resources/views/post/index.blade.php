@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <div class="col-8 mt-4" style="margin:auto">

@foreach ($posts as $post)
        <div class=" pb-3 ">
                <section class="d-flex align-items-center p-3 bg-light" style="border-radius: 20px 20px 0 0">
                        <div class="pr-3"><img class="rounded-circle" style="width:42px;height:42px" src="/storage/{{$post->user->profile->profileImage()}}" alt=""></div>
                         <div>
                             <h5 class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a> | </h5>
                             {{-- <follow-button class="ml-4" user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button> --}}
                         </div>
                </section>
            <section >
            <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" class=" rounded mx-auto d-block w-100" alt=""></a>
            <div>
            <p class=" pt-2"><span class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></span> {{ $post->caption }}</p>
            </div>
            </section>

            {{-- like --}}
            {{-- <div class=" d-flex"> --}}
            {{-- <input type="hidden" name="post_id" value="{{$post->id}}"> --}}
            {{-- <a class="like" data-id="{{$post->id}}" href="#">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'you like this post' : 'like' : 'like'}} </a> |
                <a class="like" href="#">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'you dislike like this post' : 'dislike' :  'dislike'}} </a>
            </div> --}}

            {{-- les commentaire --}}
            {{-- @foreach ($post->comments as $comments)
            <article class="uk-comment">
                <header class="uk-comment-header">
                    <img class="uk-comment-avatar" src="" alt="">
                <h4 class="uk-comment-title"></h4>
                    <ul class="uk-comment-meta uk-subnav">{{$comments->comment}}</ul>
                </header>
                <div class="uk-comment-body"></div>
            </article>
            @endforeach --}}
            {{-- end --}}

        </div>
@endforeach

</div>

    <div class="col-4 mt-4">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
              <h4>Users</h4>
            </div>
            <ul class="list-group list-group-flush">
              @foreach ($user as $user)
              <div class=" d-flex align-items-center p-2">
              <img src="storage/{{$user->profile->profileImage()}}" class=" rounded-circle" style="width:30px" alt="">
              <a href="/profile/{{$user->id}}"><li class="list-group-item text-dark font-weight-bold">{{ $user->username }}</li></a>
            </div>
              @endforeach

            </ul>
          </div>
    </div>
    </div>
    <div class="row">
            <div class="col-12 d-flex justify-content-center" style="margin:auto;">
             {{ $posts->links() }}
            </div>
    </div>

</div>
<script type="module" src="{{asset('/js/like.js')}}"></script>

<script type="application/javascript" >
var token = '{{ Session::token() }}';
var urlike = '{{route('like')}}'
</script>





@endsection
