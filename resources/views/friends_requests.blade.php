@extends('Layout.master')
@section('title')
    Dummy wep
@endsection

@section('content')
    @if(count($userRequests)>0)
        @foreach($userRequests as $userRequest)
            <div class="row">
                <div class="col-md-4">
                    <a href="{{route("profile",$userRequest->userRequested->id)}}"> {{$userRequest->userRequested->first_name}}</a>
                </div>
                <div class="col-md-4">
                    <a href="{{route('friends.requests.accept',$userRequest->id)}}" class="btn btn-success"> Accept</a>
                    <a href="{{route('friends.requests.delete',$userRequest->id)}}" class="btn btn-danger"> Reject</a>
                </div>
            </div>
        @endforeach
    @else
      <h1>No New Requests</h1>
    @endif
@endsection
