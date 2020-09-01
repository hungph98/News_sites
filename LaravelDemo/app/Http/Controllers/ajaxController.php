<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaitin;
use App\theloai;
use App\tintuc;

class ajaxController extends Controller
{
    //
    public function getloaitin($idtheloai)
    {
    	$loaitin = loaitin::where('idtheloai',$idtheloai)->get();
        foreach ($loaitin as $lt) {
            echo "<option value='{{$lt->id}}''> $lt->Ten    </option>";
        }
    }
    

}
 