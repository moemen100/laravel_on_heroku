@extends('Layout.master')
@section('title')
    Dummy wep
@endsection

@section('content')
    @if($results)
        <div class="row">
        @foreach($results as $result)
        <div class="col-md-12">
            <a href="{{route("profile",$result->id)}}"> {{$result->first_name}}</a>
        </div>
        @endforeach
        </div>
    @endif
@endsection
