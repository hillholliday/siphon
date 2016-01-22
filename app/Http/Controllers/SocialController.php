<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use App\User;

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
        return view('admin.feeds.registration');
    }

}
