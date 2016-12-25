<?php
namespace App\Http\Controllers;

use App\comment;
use App\like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\user;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search == '') {
            return redirect()->back();
        } else {
            $results = user::where('email', $request->search)->where('id','!=',Auth::User()->id)->get();

            if (count($results)<1) {
                $results = user::where('first_name', 'like', "%" . $request->search . "%")->where('id','!=',Auth::User()->id)->get();
            }

        }

        return view("search",compact('results'));
    }
}