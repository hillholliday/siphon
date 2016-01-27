<?php
namespace App\Services;

use App\SocialData;

class TwitterPhirehose extends \OauthPhirehose
{

    protected $teamID;

    public function setTeamID($teamID)
    {
        $this->teamID = $teamID;
    }

    /**
    * Enqueue each status
    *
    * @param string $status
    */
    public function enqueueStatus($status)
    {
        $tweet = json_decode($status, true);

        if (isset($tweet['delete'])) {
            \Log::error($data);
        }

        if (is_array($tweet) && isset($tweet['user']['screen_name'])) {
            $data = new SocialData;
            $data->team_id = $this->teamID;
            $data->message = isset($tweet['text']) ? $tweet['text'] : "";
            $data->image = isset($tweet['entities']['media']) ? $tweet['entities']['media'][0]['media_url'] : "";
            $data->save();
        }
    }
}
