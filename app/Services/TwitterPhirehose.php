<?php
namespace App\Services;

class TwitterPhirehose extends \OauthPhirehose
{
    public function setContainerID()
    {

    }

    /**
    * Enqueue each status
    *
    * @param string $status
    */
    public function enqueueStatus()
    {
    }
}
