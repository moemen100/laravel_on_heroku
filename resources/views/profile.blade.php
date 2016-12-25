@extends('Layout.master')

@section('title')
    Profile
@endsection

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>{{$user->first_name}} Profile</h3></header>
            <label for="first_name">First Name:</label>
            {{$user->first_name}}
        </div>
        <div class="col-md-3">
            @if($isFriend)
                @if($isFriend->status=="pending")
                    @if($isFriend->userRequested->id==Auth::User()->id)
                        <a href="{{route('friends.requests.delete',$isFriend->id)}}" type="submit"
                           class="btn btn-primary">Remove Request</a>
                    @else
                        <a href="{{route('friends.requests.accept',$isFriend->id)}}" type="submit"
                           class="btn btn-primary">Confirm Friend</a>
                    @endif
                @else
                    <a href="{{route('friends.requests.delete',$isFriend->id)}}" type="submit"
                       class="btn btn-primary">Un Friend</a>
                @endif
            @else
                <a href="{{route('friends.requests.new',$user->id)}}" type="submit"
                   class="btn btn-primary">Friend Request</a>
            @endif
        </div>
    </section>
    @if (Storage::has($user->first_name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}"
                     alt="" class="img-responsive">
            </div>
        </section>
    @endif
@endsection