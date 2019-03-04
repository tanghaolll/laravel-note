<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    //
   public function index(){
       $user = \Auth::user();
       $notices = $user->notices;

       return view("notice/index",compact("notices"));
   }
}
