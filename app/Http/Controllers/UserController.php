<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Return login view
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|max:255',
                'password' => 'required',
            ]);
        } catch (HttpResponseException $e) {
            return response()->json(
                [
                    'error' =>
                        [
                            'message'     => 'Invalid auth',
                            'status_code' => IlluminateResponse::HTTP_BAD_REQUEST
                        ]
                ],
                IlluminateResponse::HTTP_BAD_REQUEST,
                $headers = []
            );
        }

        $credentials = $this->getCredentials($request);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return redirect('/dashboard');
    }

    /**
     * Return signup view
     *
     * @return \Illuminate\View\View
     */
    public function signup()
    {
        return view('signup');
    }

    /**
     * Store a new user
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|same:confirm|required_with:confirm',
            'confirm' => 'required|required_with:password|same:password'
        ]);

        $fields = $request->except('password', 'confirm');

        $user = new User($fields);
        if ($request->has('password') && $request->has('confirm')) {
            $user->password = \Hash::make($request->input('password'));
        }

        $user->save();
        Auth::login($user);

        return redirect('dashboard');
    }

    /**
     * Log a user out
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}
