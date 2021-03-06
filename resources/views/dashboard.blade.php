@extends('Layout.master')
@section('title')
    Dummy wep
@endsection

@section('content')

    <div class="col-sm-6 col-sm-offset-0">
        <h1><span class="label label-primary"><bold>Share Your Post </bold></span></h1>
    </div>
    <section class="row new-post">
        <div class="col-sm-6 col-sm-offset-4">
            <form action="{{route('post.create')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your comment "
                              rows="5"></textarea>
                    <input type="file" name="multimedia" class="form-control" id="multimedia">
                    <button type="submit" class="btn btn-primary">Share Post</button>
                </div>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-sm-6 col-sm-offset-0">
            <h1><span class="label label-info"><bold>Posts Section</bold></span></h1>
        </div>
        <div class="col-sm-7 col-sm-offset-1">
            @foreach($posts as $post )
                <article class="post" data-postid="{{$post->id}}">
                    @if (Storage::has($post->user->first_name . '-' . $post->user->id . '.jpg'))
                        <div class="col-sm-10">
                            <a href="{{route("profile",$post->user->id)}}">{{$post->user->first_name }}</a>
                        </div>
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-circle"
                                     src="{{ route('account.image', ['filename' => $post->user->first_name . '-' . $post->user->id . '.jpg']) }}">
                            </div>
                        </div>

                    @endif

                    @if (!Storage::has($post->user->first_name . '-' . $post->user->id . '.jpg'))
                        <div class="col-sm-10">
                            <a href="{{route("profile",$post->user->id)}}">{{$post->user->first_name }}</a>
                        </div>
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive "
                                     src="{{ route('account.image', ['filename' => 'mo-4.jpg']) }}">
                            </div>
                        </div>

                    @endif
                    <h2> {!!$post->body !!}</h2>
                    @if (Storage::has($post->user->first_name . '-' . $post->id . '.image'))
                        <div class="row">
                            <div class="col-sm-5">

                                <img class="img-responsive"
                                     src="{{ route('upload.vedio', ['filename' => $post->user->first_name . '-' . $post->id . '.image']) }}"
                                     id="uploaded">

                            </div>
                        </div>

                    @endif
                    @if (Storage::has($post->user->first_name . '-' . $post->id . '.video'))
                        <div class="row">
                            <div class="col-sm-5">

                                <video src="{{ route('upload.vedio', ['filename' => $post->user->first_name . '-' . $post->id . '.video']) }}"
                                       id="uploaded" controls="controls">
                                </video>
                            </div>
                        </div>
                    @endif
                    @if (Storage::has($post->user->first_name . '-' . $post->id . '.audio'))
                        <div class="row">
                            <div class="col-sm-5">

                                <audio src="{{ route('upload.vedio', ['filename' => $post->user->first_name . '-' . $post->id . '.audio']) }}"
                                       id="uploaded" controls="controls">
                                </audio>
                            </div>
                        </div>
                    @endif


                    <div class="interaction">
                        <ul class="pager">
                            <li><a href="#" class="glyphicon glyphicon-star"
                                   id="del">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Remove Like':'Like':'Like'}}</a>

                                <a href="#" class="glyphicon glyphicon-fire"
                                   id="del">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'Remove dislike'  : 'Dislike' : 'Dislike'  }} </a>

                            </li>
                            @if(Auth::user() == $post->user)

                                <li><a href="#" class="glyphicon glyphicon-edit" id="del"> Edit</span> </a></li>
                                <li><a class="glyphicon glyphicon-erase" id="del"
                                       href="{{route('post.delete',['post_id'=>$post->id])}}"> Delete</a></li>

                            @endif
                            <div class="info">
                                <div>
                                    <span class="label label-success"><Small> {{ count($post->likes->where('like',1) ) }}
                                            Users Like this   </Small> </span>
                                    <span class="label label-danger"><Small>{{ count($post->likes->where('like',0) ) }}
                                            Users Don't Like this</Small> </span>
                                </div>
                                <span class="label label-primary"><Small>Posted by {{ $post->user->first_name }}
                                        on {{ $post->created_at }}</Small></span>

                            </div>

                        </ul>

                        <div class="col-sm-12 col-md-offset-0">
                            <h4><span class="label label-info"><bold>Comments Section</bold></span></h4>
                            <ul class="list-group-item ">
                                @foreach($post->comments as $comment )


                                    <li class="list-group-item list-group-item"> {{$comment->body}}</li>
                                    <span class="label label-primary"><Small>Posted by {{ $comment->user->first_name }}
                                            on {{ $comment->created_at }}</Small></span>


                                @endforeach
                            </ul>
                        </div>
                        <form action="{{route('post.comment',['post_id'=>$post->id])}}" method="post">
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="new-comment" rows="2"
                                          placeholder="Your comment" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">comment</button>
                            <input type="hidden" value="{{ Session::token() }}" name="_token">
                        </form>

                    </div>


                </article>
            @endforeach
        </div>


    </section>


    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection
