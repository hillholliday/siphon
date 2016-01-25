<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\User;
use App\Team;
use App\Network;
use Input;
use Supervisor\Supervisor;
use Supervisor\Connector\XmlRpc;
use fXmlRpc\Client;
use fXmlRpc\Transport\HttpAdapterTransport;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;

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

    /**
     * registers new tokens for social networks
     *
     * @return \Illuminate\View\View
     */
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

    public function publish()
    {
        //Create GuzzleHttp client
        $guzzleClient = new \GuzzleHttp\Client();

        // Pass the url and the guzzle client to the XmlRpc Client
        $client = new Client(
            'http://127.0.0.1:9001/RPC2',
            new HttpAdapterTransport(new Guzzle6HttpAdapter($guzzleClient))
        );

        // Pass the client to the connector
        // See the full list of connectors bellow
        $connector = new XmlRpc($client);

        $supervisor = new Supervisor($connector);

        // returns Process object
        $process = $supervisor->getProcess('test_process');

        // returns array of process info
        $supervisor->getProcessInfo('test_process');

        // same as $supervisor->stopProcess($process);
        $supervisor->stopProcess('test_process');

        // Don't wait for process start, return immediately
        $supervisor->startProcess($process, false);

        // returns true if running
        // same as $process->checkState(Process::RUNNING);
        $process->isRunning();

        // returns process name
        echo $process;

        // returns process information
        $process->getPayload();
    }

    public function test()
    {
        $user = Auth::check();
        return response()->json($user);
    }
}
