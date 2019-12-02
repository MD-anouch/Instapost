@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img class="rounded-circle" style="width:160px;height:150px" src="https://photos7.motorcar.com/used-2017-lamborghini-aventador_sv--8431-18603473-3-1024.jpg" alt="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                @can('update', $user->profile)
                <a href="../p/create">Add new post</a>
                @endcan
            </div>
            @can('update', $user->profile)
            <a href="{{ route('profile.edit',$user->id)}}">Edit profile</a>
            @endcan

            <section class="d-flex">
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-4"><strong>30k</strong> followers</div>
                <div class="pr-4"><strong>256</strong> following</div>
            </section>
            <div class="pt-3 font-weight-bold">{{$user->profile->title }}</div>
            <div>{{$user->profile->description }}</div>
            <div><a href="{{$user->profile->url ?? '#'}}"><strong>{{$user->profile->url ?? 'N/A'}}</strong></a></div>

        </div>

    </div>
    <div class="row">
        @foreach ($user->posts as $post)
        {{-- <div>{{$post->caption}}</div> --}}
            <div class="col-4 pt-5">
                <a href="/p/{{$post->id}}">
                <img class="w-100" src="/storage/{{$post->image}}" alt="">
                </a>
            </div>

        @endforeach


    </div>

</div>
@endsection
