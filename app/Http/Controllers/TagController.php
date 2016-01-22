<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use App\Feed;
use App\Tag;
use App\Team;
use App\Network;

class TagController extends Controller
{
    /**
     * Return tags view
     *
     * @return \Illuminate\View\View
     */
    public function index($team, $feed_id)
    {
        $team = Team::where('slug', '=', $team)->first();
        $feed = Feed::with('tags.network')->where('id','=',$feed_id)->first();
        return view('admin.tags.index', ['feed' => $feed, 'team' => $team]);
    }


    /**
     * Return create tag view
     *
     * @return \Illuminate\View\View
     */
    public function create($team, $feed_id) {
        $team = Team::where('slug', '=', $team)->with('feeds')->first();
        $feed = Feed::with('tags.network')->where('id','=',$feed_id)->first();
        $networks = Network::all();
        return view('admin.tags.create', ['feed' => $feed, 'team' => $team, 'networks' => $networks]);
    }

    /**
     * Return redirect - creates new tag
     *
     * @return \Illuminate\View\View
     */
    public function store($team, $feed_id, Request $request) {
        $name = $request->input('name');
        $network = $request->input('network');

        $tag = new Tag();
        $tag->title = $name;
        $tag->feed_id = $feed_id;
        $tag->network_id = $network;
        $tag->save();

        return redirect('/team/' . $team . '/feed/' . $feed_id);
    }

    /**
     * Return redirect - deletes tag
     *
     * @return \Illuminate\View\View
     */
    public function delete($team, $feed_id, $tagId) {
        Tag::destroy($tagId);
        return redirect('/team/' . $team . '/feed/' . $feed_id);
    }


}
