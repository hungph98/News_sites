<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;

class loaitinController extends Controller
{
    //
    public function getdanhsach()
    {
    	$loaitin = loaitin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getthem()
    {
        $theloai = theloai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);

    }
    public function postthem(Request $request)
    {
        $this->validate($request,
            [
                'Ten'=>'required|unique:loaitin,Ten|min:3|max:100',
                'theloai'=>'required',
            ],
            [
                'Ten.required'=>"Bạn chưa nhập tên loại tin",
                'Ten.unique'=>"Tên thể loại đã tồn tại",
                'Ten.min'=>"Tên thể loại phải dài từ 3 - 100",
                'Ten.max'=>"Tên thể loại phải dài từ 3 - 100",
                'theloai.required'=>'Bạn chưa chọn thể loại',
            ]);
        $loaitin = new loaitin;
        $loaitin->Ten=$request->Ten;
        $loaitin->TenKhongDau=changeTitle($request->Ten);
        $loaitin->idtheloai=$request->theloai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao', 'Bạn đã thêm thành công');
    }
    public function getsua($id)
    {
    	
    }
    public function postsua(Request $request,$id)
    {
        
    }
    public function getxoa($id)
    {
        
    }

}
 