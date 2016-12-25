@extends('Layout.master')
@section('title')
    Dummy wep
@endsection

@section('content')

    <div class="box-header with-border">
        <i class="fa fa-warning"></i>
        <h3 class="box-title">Alerts</h3>
    </div>
    <div class="box-body">
        @if($notifications)
            @foreach($notifications as $notification)
                <div class="alert alert-{!! $notification->type !!} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>
                        <i class="icon fa @if($notification->type == 'danger') fa-ban @elseif($notification->type == 'info') fa-info @elseif($notification->type == 'warning') fa-warning @elseif($notification->type == 'success') fa-check @endif"></i>
                        Alert!</h4> {!! $notification->notification !!}
                    <a href="{{$notification->url}}">{{$notification->message}}</a>
                </div>
            @endforeach
        @endif
    </div>
@endsection

