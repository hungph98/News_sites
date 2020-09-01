<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;
use App\tintuc;
use App\comment;
use App\slide;

class slideController extends Controller
{
    //
    public function getDanhsach()
    {
    	$slide = slide::all();
    	return redirect('admin.slide.danhsach',['slide'=>$slide]);
    }




    public function getxoa($id,$idtintuc)
    {
        $comment = comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','Xóa thành công');
    }
}