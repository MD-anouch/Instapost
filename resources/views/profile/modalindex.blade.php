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
                <a href="../p/create">Add new post</a>
            </div>

            <section class="d-flex">
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-4"><strong>30k</strong> followers</div>
                <div class="pr-4"><strong>256</strong> following</div>
            </section>
            <div class="pt-3 font-weight-bold">{{$user->profile->title }}</div>
            <div>{{$user->profile->description }}</div>
            <div><a href="#"><strong>{{$user->profile->url ?? 'N/A'}}</strong></a></div>

        </div>

    </div>
    <div class="row">
        @foreach ($user->posts as $post)
        {{-- <div>{{$post->caption}}</div> --}}
            <div class="col-4 pt-5">


            <!-- Button trigger modal -->
<button type="button" style="border:none;padding:0;" data-toggle="modal" data-target="#exampleModalCenter{{$post->id}}">
        {{-- <a href="/p/{{$post->id}}"> --}}
            <img class="w-100" src="/storage/{{$post->image}}" alt="">
            {{-- </a> --}}
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                            <div class="col-8" style="margin:auto">
                                <img src="/storage/{{$post->image}}" class="rounded mx-auto d-block w-100" alt="">
                            </div>
                            <div class="col-4"><h4>{{ $post->user->username }}</h4></div>
                        </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
        @endforeach


    </div>

</div>
@endsection
