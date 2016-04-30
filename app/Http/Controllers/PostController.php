<?php
/**
 * Created by PhpStorm.
 * User: moemen
 * Date: 4/22/2016
 * Time: 2:41 AM
 */

namespace App\Http\Controllers;


use App\comment;
use App\like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class PostController extends Controller
{
    public function getdashboard()
    {$posts=Post::orderBy('created_at','desc')->get();
        
        return view('dashboard',['posts'=>$posts]);
    }
    public function getcommentsection($post_id)
    {$posts=Post::find($post_id);
        return view('commentsection',['post_id'=>$post_id,'post'=>$posts]);
    }
public function postCreatePost (Request $request)

{   if($request['multimedia']==null)
    $this->validate($request, [
        'body' => 'required|max:1000'
    ]);
    $post = new Post();
    $post->body = $request['body'];
    $message = 'There was an error';
    if ($request->user()->posts()->save($post)) {
        $message = 'Post successfully created!';
    }
    if($request['multimedia']) {

        $user = Auth::user();
        $file = $request->file('multimedia');
        $extension = $file->getExtension();
       //if($extension=='.mp3'||$extension==".mp3"||$extension=="mp3"||$extension=='mp3')
           $filename = $user->first_name . '-' . $post->id . '.' . 'audio';
      //  else {

         //   $mime = $request->file('multimedia')->getMimeType();
           // if (strstr($mime, "video/")) {
             //   $filename = $user->first_name . '-' . $post->id . '.' . 'video';
            //} else if (strstr($mime, "image/")) {
              //  $filename = $user->first_name . '-' . $post->id . '.' . 'image';
            //} else if (strstr($mime, "audio/")) {
              //  $filename = $user->first_name . '-' . $post->id . '.' . 'audio';
            //} else {
             //  return redirect()->route('dashboard')->with(['message' => $message]);
            //}
        //}
        if ($file) {
            Storage::disk('s3')->put($filename, File::get($file));
        }

        return redirect()->route('dashboard')->with(['message' => $message]);;

    }
    return redirect()->route('dashboard')->with(['message' => $message]);
}
    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        $comment=comment::where('post_id', $post_id);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        $comment->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }
    public function postcommentPost (Request $request,$post_id)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $user = Auth::user();
        $comment = new comment();
        $comment->body=$request['body'];
        $comment->post_id=$post_id;
        $comment->user_id=$user->id;
        $comment->save();


        return redirect()->route('commentsection',$post_id);
    }
    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }
    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);

        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }


}