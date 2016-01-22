<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\Feed;
use App\Tag;
use App\Team;
use App\Network;

class TagController extends Controller
{
    /**
     * Return feeds view
     *
     * @return \Illuminate\View\View
     */
    public function index($slug, $feedid)
    {
        $team = Team::where('slug', '=', $slug)->first();
        $feed = Feed::with('tags.network')->where('id','=',$feedid)->first();
        return view('admin.tags.index', ['feed' => $feed, 'team' => $team]);
    }


    /**
     * Return create team view
     *
     * @return \Illuminate\View\View
     */
    public function create($slug, $feedid) {
        $team = Team::where('slug', '=', $slug)->with('feeds')->first();
        $feed = Feed::with('tags.network')->where('id','=',$feedid)->first();
        $networks = Network::all();
        return view('admin.tags.create', ['feed' => $feed, 'team' => $team, 'networks' => $networks]);
    }

    /**
     * Return redirect - creates new team
     *
     * @return \Illuminate\View\View
     */
    public function store($slug, $feedid, Request $request) {
        $name = $request->input('name');
        $network = $request->input('network');

        $tag = new Tag();
        $tag->title = $name;
        $tag->feed_id = $feedid;
        $tag->network_id = $network;
        $tag->save();

        return redirect('/team/' . $slug . '/feed/' . $feedid);
    }

    /**
     * Return redirect - deletes feed
     *
     * @return \Illuminate\View\View
     */
    public function delete($slug, $feedid, $tagId) {
        Tag::destroy($tagId);
        return redirect('/team/' . $slug . '/feed/' . $feedid);
    }


}
