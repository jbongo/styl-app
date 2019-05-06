<?php

namespace App\Http\Controllers\GuestsAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetGuestPasswords;
use Notification;
use App\Models\Guestusers;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:guestusers');
    }
    public function broker()
    {
        return Password::broker('guestusers');
    }
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('visiteurs.auth.password.email');
    }
    /**
     * Reset password and send another to the given guestuser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $tmp = Guestusers::where('email', '=', $request['email'])->get()->first();
        if (!$tmp || $tmp === NULL)
            return redirect()->back()->with('error', 'Nom d\'utilisateur introuvable !');
        $password = str_random(8);
        $tmp->password = bcrypt($password);
        $tmp->update();
        $ok = new ResetGuestPasswords($tmp, $password);
        Mail::to($tmp->email_original)->send($ok);
        return redirect()->back()->with('5/5', 'Un nouveau mot de passe vous a été envoyé par email !');
    }
}