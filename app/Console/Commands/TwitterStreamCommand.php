<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TwitterPhirehose;
// use fennb\phirehose\lib\Phirehose;
use \Phirehose;

class TwitterStreamCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:stream {--track=} {api_key} {api_secret} {oauth_key} {oauth_secret} {team_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stream \'track\' keywords from twitter.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        define("TWITTER_CONSUMER_KEY", $this->argument('api_key'));
        define("TWITTER_CONSUMER_SECRET", $this->argument('api_secret'));
        define("OAUTH_TOKEN", $this->argument('oauth_key'));
        define("OAUTH_SECRET", $this->argument('oauth_secret'));

        $trackStream = new TwitterPhirehose(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
        $track = (array) 'boston';
        $trackStream->setTrack($track);
        $trackStream->setTeamID($this->argument('team_id'));
        $trackStream->consume();
    }
}

