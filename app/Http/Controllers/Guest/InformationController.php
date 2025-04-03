<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
  public function showEntertaiment(){
    return view('guest.information.entertaiment');
  }
  public function showAbout(){
    return view('guest.information.introduct');
  }
  public function showEventOrganization(){
    return view('guest.information.eventorganization');
  }
  public function showPromotion(){
    return view('guest.information.promotions');
  }
    
}