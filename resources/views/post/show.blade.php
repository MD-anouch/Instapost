@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8" style="margin:auto">
            <img src="/storage/{{$post->image}}" class="rounded mx-auto d-block w-100" alt="">
        </div>
        <div class="col-4">
            <h4>{{ $post->user->username }}</h4>
            <p>{{ $post->caption }}</p>
        </div>
    </div>
</div>
@endsection
