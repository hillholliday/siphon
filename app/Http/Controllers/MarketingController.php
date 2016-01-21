<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\User;

class MarketingController extends Controller
{
    /**
     * Return login view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('marketing');
    }

}
