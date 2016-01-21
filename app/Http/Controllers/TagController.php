<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\Feed;
use App\Team;

class TagController extends Controller
{
    /**
     * Return feeds view
     *
     * @return \Illuminate\View\View
     */
    public function index($team, $feedid)
    {
        $feed = Feed::with('tags.network')->where('id','=',$feedid)->first();
        return view('admin.tags.index', ['feed' => $feed]);
    }

}
