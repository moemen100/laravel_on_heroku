@extends('Layout.master')
@section('title')
Dummy wep
@endsection

@section('content')


<div class="col-md-6 col-md-offset-0">
<h1> <span class="label label-primary"><Smal>Share With Your Comment </Smal></span></h1>
    </div>
      <section class="row new-post">
        <div class="col-md-6 col-md-offset-1">
            <form action="{{route('post.create')}}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your comment" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">comment</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-0">
            <h1> <span class="label label-info"><Smal>Comments Section</Smal></span></h1>
            </div>
        <div class="col-md-6 col-md-offset-1">
            @foreach($posts as $post )
            <article class="post"  data-postid="{{$post->id}}">

               <h4 > {{ $post->body }}</h4>

                    <div class="info">

                    <span class="label label-primary"><Smal>Posted by {{ $post->user->first_name }} on {{ $post->created_at }}</Smal></span>
                  </div>
                <div>
                    <span class="label label-success"><Smal> {{ count($post->likes->where('like',true)->pluck('like') ) }} User Like this   </Smal> </span>
                    <span class="label label-danger"><Smal>{{ count($post->likes->where('like',false)->pluck('like') ) }} User Don't Like this</Smal> </span>
                </div>
                <div class="interaction">
                    <ul class="pager">
                        <li>  <a  href="#" class="glyphicon glyphicon-star" >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Remove Like':'Like': 'Like'}}</a>  |

                            <a href="#" class="glyphicon glyphicon-fire" >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'Remove dislike'  : 'Dislike' : 'Dislike'  }} </a>
                     </li>

                        @if(Auth::user() == $post->user)
                            |
                        <li>  <a href="#" class="glyphicon glyphicon-edit"> Edit</span> </a></li>
                      | <li> <a class="glyphicon glyphicon-erase"  href="{{route('post.delete',['post_id'=>$post->id])}}"> Delete</a></li>

                    @endif
                    </ul>
                </div>
            </article>
                    @endforeach
                </div>



    </section>


<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
