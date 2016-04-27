@extends('Layout.master')
@section('title')
    Welcome

@endsection
@section('content')
    @if (Storage::disk('local')->has($post->user->first_name . '-' . $post_id . '.image'))
        <div class="row">
            <div class="col-md-10">

                <img class="img-responsive" src="{{ route('upload.vedio', ['filename' => $post->user->first_name  . '-' . $post_id . '.image']) }}" id="uploaded">

            </div>
        </div>
    @endif
    @if (Storage::disk('local')->has($post->user->first_name . '-' . $post_id . '.video'))
        <div class="row">
            <div class="col-md-10">

                <video  src="{{ route('upload.vedio', ['filename' => $post->user->first_name . '-' . $post_id . '.video']) }}" id="uploaded" controls="controls">
                </video>
            </div>
        </div>
    @endif
    @if (Storage::disk('local')->has($post->user->first_name . '-' . $post_id . '.audio'))
        <div class="row">
            <div class="col-md-10">

                <audio  src="{{ route('upload.vedio', ['filename' => $post->user->first_name . '-' .$post_id . '.audio']) }}" id="uploaded" controls="controls">
                </audio>
            </div>
        </div>
    @endif
    <div class="interaction">
        <ul class="pager">
            <li>  <a  href="#" class="glyphicon glyphicon-star" id="del" >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Remove Like':'Like':'Like'}}</a>

                <a href="#" class="glyphicon glyphicon-fire" id="del">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'Remove dislike'  : 'Dislike' : 'Dislike'  }} </a>

            </li>
            @if(Auth::user() == $post->user)

                <li> <a href="#" class="glyphicon glyphicon-edit" id="del" >  Edit</span> </a></li>
                <li> <a class="glyphicon glyphicon-erase" id="del"  href="{{route('post.delete',['post_id'=>$post->id])}}"> Delete</a></li>

            @endif
            <div class="info">
                <div>
                    <span class="label label-success"><Smal> {{ count($post->likes->where('like',true)->pluck('like') ) }} Other User Like this   </Smal> </span>
                    <span class="label label-danger"><Smal>{{ count($post->likes->where('like',false)->pluck('like') ) }} Other User Don't Like this</Smal> </span>
                </div>
                <span class="label label-primary"><Smal>Posted by {{ $post->user->first_name }} on {{ $post->created_at }}</Smal></span>

            </div>

        </ul>

        <div class="col-md-12 col-md-offset-0">
            <h4> <span class="label label-info"><Smal>Comments Section</Smal></span></h4>
            <ul class="list-group-item ">
                @foreach($post->comments as $comment )


                    <li class="list-group-item list-group-item"> {{$comment->body}}</li>
                    <span class="label label-primary"><Smal>Posted by {{ $comment->user->first_name }} on {{ $comment->created_at }}</Smal></span>


                @endforeach
            </ul>
        </div>
        <form action="{{route('post.comment',['post_id'=>$post->id])}}" method="post">
            <div class="form-group">
                <textarea class="form-control" name="body" id="new-comment" rows="2" placeholder="Your comment" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">comment</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </form>
</div>

@endsection