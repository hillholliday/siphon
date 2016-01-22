<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Input;
use App\Feed;
use App\Team;
use App\Network;

class FeedController extends Controller
{
    /**
     * Return feeds view
     *
     * @return \Illuminate\View\View
     */
    public function index($team)
    {
        $team = Team::where('slug', '=', $team)->with('feeds')->first();
        $networks = Network::all();
        return view('admin.feeds.index', ['team' => $team, 'networks' => $networks]);
    }

    /**
     * Return create feed view
     *
     * @return \Illuminate\View\View
     */
    public function create($team) {
        $team = Team::where('slug', '=', $team)->with('feeds')->first();
        return view('admin.feeds.create', ['team' => $team]);
    }

    /**
     * Return redirect - creates new feed
     *
     * @return \Illuminate\View\View
     */
    public function store($team) {
        $name = Input::get('name');
        $team = Team::where('slug', '=', $team)->first();
        $feed = new Feed();
        $feed->title = $name;
        $feed->team_id = $team->id;
        $feed->save();

        return redirect('/team/' . $team->slug . '/feed');
    }

    /**
     * Return edit feed view
     *
     * @return \Illuminate\View\View
     */
    public function edit($team, $feed_id) {
        $team = Team::where('slug', '=', $team)->first();
        $feed = Feed::find($feed_id);

        return view('admin.feeds.edit', ['team'=>$team, 'feed' => $feed]);
    }

    /**
     * Return redirect - updates feed
     *
     * @return \Illuminate\View\View
     */
    public function update($team, $feed_id) {
        $name = Input::get('name');
        $feed = Feed::find($feed_id);
        $feed->title = $name;
        $feed->save();

        return redirect('/team/' . $team . '/feed');
    }

    /**
     * Return redirect - deletes feed
     *
     * @return \Illuminate\View\View
     */
    public function delete($team, $feed_id) {
        Feed::destroy($feed_id);
        return redirect('/team/' . $team . '/feed');
    }

}
