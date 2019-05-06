<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guestusers;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeGuest;

class GuestController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mandant_to_guestuser($email, $mandat, $role)
    {
        $tmp = str_random(4);
        $pwd = str_random(8);
        $password = bcrypt($pwd);
        switch($role){
            case "mandant":
                $login = "VND".time().strtoupper($tmp).$mandat;
                break;
            case "acquereur":
                $login = "ACH".time().strtoupper($tmp).$mandat;
                break;
            case "chercheur":
                $login = "CHR".time().strtoupper($tmp).$mandat;
                break;
        }
        $newbie = Guestusers::create([
            'email'=> $login,
            'role'=>$role,
            'email_original'=> $email,
            'mandat_id'=> $mandat,
            'password'=> $password,
        ]);
        $ok = new WelcomeGuest($newbie, $pwd);
        Mail::to($newbie->email_original)->send($ok);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
