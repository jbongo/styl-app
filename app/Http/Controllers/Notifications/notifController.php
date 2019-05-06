<?php

namespace App\Http\Controllers\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Notification;
use App\Models\User;
class notifController extends Controller
{
    
    public function index(){
        
        return view('notifications.listeNotifs');
    }

    public function show($id){

        $user = User::where('id',$id);
        return view('notifications.details', compact('user'));

    }

    public function delete ($notif){
         auth()->user()->Notifications()->where('id',$notif)->delete() ;
    }
}
