<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;

class theloaiController extends Controller
{
    //
    public function getDanhsach()
    {
    	$theloai = theloai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getthem()
    {
    	return view('admin.theloai.them');

    }
    public function postthem(Request $request)
    {
        //echo $request->Ten;
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:theloai,Ten',
            ],
            [
                'Ten.required'=>"Bạn chưa nhập tên thể loại",
                'Ten.unique'=>"Tên thể loại đã tồn tại",
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3 - 100 kí tự',
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3 - 100 kí tự',
            ]);
        $theloai= new theloai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        // echo changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }
    public function getsua($id)
    {
    	$theloai = theloai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postsua(Request $request,$id)
    {
        $theloai = theloai::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:theloai,Ten',
            ],
            [
                'Ten.required'=>"Bạn chưa nhập tên thể loại",
                'Ten.unique'=>"Tên thể loại đã tồn tại",
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3 - 100 kí tự',
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3 - 100 kí tự',
            ]);
        $theloai ->Ten = $request-> Ten;
        $theloai ->TenKhongDau = changeTitle($request->Ten);
        $theloai -> save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');

    }
    public function getxoa($id)
    {
        $theloai = theloai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','xoa thành công');
    }

}
 