<?php
namespace App\Http\Controllers\GuestsAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:guestusers')->except(['logout']);
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('visiteurs.auth.login');
    }
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:3'
        ]);
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // Attempt to log the user in
        if (Auth::guard('guestusers')->attempt($credential, $request->member)){
            // If login succesful, then redirect to their intended location
            return redirect()->intended(route('guestusers.home'));
        }
        // If Unsuccessful, then redirect back to the login with the form data and error message
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'informations incorrectes !');
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('guestusers')->logout();
        return redirect('guestusers/guest/login');
    }
}