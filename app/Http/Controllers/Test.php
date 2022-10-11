<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function test(){
        $a= [1,2,3,'a','213'];
        dd($a);
        die();

    }
}
