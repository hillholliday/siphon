<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\Feed;
use App\Team;

class FeedController extends Controller
{
    /**
     * Return feeds view
     *
     * @return \Illuminate\View\View
     */
    public function index($data)
    {
        $team = Team::where('slug', '=', $data)->with('feeds')->first();
        return view('admin.feeds.index', ['team' => $team]);
    }
}
