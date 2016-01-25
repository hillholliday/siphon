<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TwitterPhirehose as TwitterPhirehose;

class TwitterStreamCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:stream';

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
        echo "yay!";

        // $trackStream = new TwitterPhirehose(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);

        // $track = (array) $this->option('track');
        // $trackStream->setTrack($track);
        // $trackStream->setContainerID($this->argument('container_id'));
        // $trackStream->consume();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
             array('api_key', InputArgument::REQUIRED, 'Twitter API Key'),
             array('api_secret', InputArgument::REQUIRED, 'Twitter API Secret'),
             array('oauth_key', InputArgument::REQUIRED, 'Twitter Oauth Key'),
             array('oauth_secret', InputArgument::REQUIRED, 'Twitter Oauth Secret')
        );
    }
}
