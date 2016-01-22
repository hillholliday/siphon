<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use App\User;
use App\Team;
use App\Network;
use Input;

class SocialController extends Controller
{
    /**
     * Return marketing view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    }

     /**
     * Return registration view
     *
     * @return \Illuminate\View\View
     */
    public function register($team, $network_id)
    {
    	$team = Team::where('slug', '=', $team)->first();
    	$network = Network::find($network_id);

    	$network_name = $network->title;
    	if(!$keys = json_decode($team->$network_name)) {
    		$keys = new \stdClass();
    	}

        return view('admin.feeds.registration', ['team' => $team, 'network' => $network, 'keys' => $keys]);
    }

    public function processRegistration($team, $network_id)
    {
    	$keys = [];
    	$redirect = '/';
    	$team = Team::where('slug', '=', $team)->first();
    	$network = Network::find($network_id);

    	foreach(Input::except('_token') as $key => $item) {
    		$keys[$key] = $item;
    	}

    	$network = $network->title;
    	$team->$network = json_encode($keys);
    	$team->save();

    	return redirect('/team/' . $team->slug . '/feed/');
    }

}
