<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
       $user = Auth::user();
       if($user === 'kaprodi'){
        return redirect('/kaprodi');
       }else{
        return redirect('/login');
       }
    }
}
