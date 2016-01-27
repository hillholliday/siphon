<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use Input;
use App\User;
use App\Team;
use App\Network;
use Supervisor\Supervisor;
use Supervisor\Connector\XmlRpc;
use fXmlRpc\Client;
use fXmlRpc\Transport\HttpAdapterTransport;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;
use Supervisor\Exception\Fault;
use Supervisor\Exception\Fault\BadName;
use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Writer\IniFileWriter as File;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Supervisor\Configuration\Section\Program;

class SocialController extends Controller
{

    /**
     * Name of the group in supervisor
     */
    const SUPERVISOR_GROUP = 'twitter';

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

    /**
     * publishs the tracking of terms with supervisor and phirehose
     *
     * @return \Illuminate\View\View
     */
    public function publish($team, $network_id)
    {
        $team = Team::where('slug', '=', $team)->first();
        $network = Network::find($network_id);
        $network = $network->title;
        $keys = json_decode($team->$network);

        //Create GuzzleHttp client
        $guzzleClient = new \GuzzleHttp\Client();

        // Pass the url and the guzzle client to the XmlRpc Client
        $client = new Client(
            'http://localhost:9001/RPC2',
            new HttpAdapterTransport(new Guzzle6HttpAdapter($guzzleClient))
        );

        // Generate XMLRpc and Supervisor Instances
        $connector = new XmlRpc($client);
        $supervisor = new Supervisor($connector);

        // setup flysystem
        $adapter = new Local('/etc/supervisor/conf.d/');
        $filesystem = new Filesystem($adapter);

        // create new supervisor files
        $writer = new File($filesystem, 'test.conf');
        $configuration = new Configuration;
        $section = $this->generateNewProcess($keys, $team->id);
        $configuration->addSection($section);
        $writer->write($configuration);

        // restart supervisor
        $supervisor->restart();
    }

    /**
     * generates a custom artisan command for supervisor to track
     *
     * @return \Illuminate\View\View
     */
    private function generateNewProcess($keys, $team_id) {
        return new Program('test', ['command' => 'php /Users/eric.callan/Sites/HHCC/siphonnew/artisan twitter:stream --track=boston ' . $keys->api_key . ' '  . $keys->api_secret . ' '  . $keys->access_token . ' '  . $keys->access_token_secret . ' ' . $team_id]);
    }

}
