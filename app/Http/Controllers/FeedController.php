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

    /**
     * Return create feed view
     *
     * @return \Illuminate\View\View
     */
    public function create($slug) {
        $team = Team::where('slug', '=', $slug)->with('feeds')->first();
        return view('admin.feeds.create', ['team' => $team]);
    }

    /**
     * Return redirect - creates new feed
     *
     * @return \Illuminate\View\View
     */
    public function store($slug, Request $request) {
        $name = $request->input('name');

        $team = Team::where('slug', '=', $slug)->first();
        $feed = new Feed();
        $feed->title = $name;
        $feed->team_id = $team->id;
        $feed->save();

        return redirect('/team/' . $slug . '/feed');
    }

    /**
     * Return edit feed view
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug, $feed_id) {
        $team = Team::where('slug', '=', $slug)->first();
        $feed = Feed::find($feed_id);

        return view('admin.feeds.edit', ['team'=>$team, 'feed' => $feed]);
    }

    /**
     * Return redirect - updates feed
     *
     * @return \Illuminate\View\View
     */
    public function update($slug, $feed_id, Request $request) {
        $name = $request->input('name');

        $feed = Feed::find($feed_id);
        $feed->title = $name;
        $feed->save();

        return redirect('/team/' . $slug . '/feed');
    }

    /**
     * Return redirect - deletes feed
     *
     * @return \Illuminate\View\View
     */
    public function delete($slug, $feed_id) {
        Feed::destroy($feed_id);
        return redirect('/team/' . $slug . '/feed');
    }

}
