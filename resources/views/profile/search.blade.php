@extends('layouts.app')
@section('content')


<div class="uk-container d-flex justify-content-center">

<div class="card" style="width: 18rem;">
        <div class="card-header">
          Featured
        </div>
        <ul class="list-group list-group-flush">

          <li class="list-group-item">
                @if ( $count > 0)
                @foreach ($user as $user)
                <div class=" d-flex align-items-center p-2">
                <img class=" rounded-circle" style="width:30px" src="storage/{{ $user->profile->profileImage()}}" alt="">
                <a href="profile/{{$user->profile->id}}"><p class=" ml-3 font-weight-bold">{{ $user->username}}</p></a>
            </div>
               @endforeach
            @else
                No user found
            @endif


            </li>

        </ul>
    </div>
</div>




@endsection
