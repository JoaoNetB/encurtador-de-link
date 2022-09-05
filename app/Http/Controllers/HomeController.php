<?php

namespace App\Http\Controllers;

use App\Models\Links;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PharIo\Manifest\InvalidUrlException;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function convert(Request $request)
    {
        $code_user = substr($request->code_url, 0, 4);
        $code_link = substr($request->code_url, 4, 6);

        $user = User::where('code_user', $code_user)->first('id');

        $link = Links::where([['user_id', '=' , $user['id']],['code_url', '=', $code_link]])->first();

        if(!empty($link['source_url'])) {

            Links::where([['user_id', '=' , $user['id']],['code_url', '=', $code_link]])
                ->update(['number_requests' => $link['number_requests'] + 1]);

            return redirect($link['source_url']);
        }

        return view('layouts/notFound');
    }
}
