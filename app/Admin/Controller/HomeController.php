<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19 0019
 * Time: 15:21
 */

namespace App\Admin\Controller;


class HomeController extends Controller
{
        public function index(){
            return view('admin.home.index');
        }
}