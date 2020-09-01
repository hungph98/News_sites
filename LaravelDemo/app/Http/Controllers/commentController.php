<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;
use App\tintuc;
use App\comment;

class commentController extends Controller
{
    //
    public function getxoa($id,$idtintuc)
    {
        $comment = comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','Xóa thành công');
    }
}