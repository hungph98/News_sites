<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaitin;
use App\theloai;
use App\tintuc;
use App\comment;

class tintucController extends Controller
{
    //
    public function getDanhsach()
    {
    	$tintuc = tintuc::all();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getthem()
    {
        $theloai = theloai::all();
        $loaitin = loaitin::all();

    	return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }
    public function postthem(Request $request)
    {
        //echo $request->Ten;
        $this->validate($request,
            [
                'loaitin'=>'required',
                'TieuDe'=>'required|unique:tintuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ],
            [
                'loaitin.required'=>'Bạn chưa có loại tin',
                'TieuDe.required'=>'Bạn chưa có tiêu đề',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại',
                'TomTat.required'=>'Bạn chưa có tóm tắt',
                'NoiDung.required'=>'Bạn chưa có nội dung'

            ]);
        $tintuc = new tintuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idloaitin =$request->loaitin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('Hinh')) {
              $file = $request->file('Hinh');
              $duoi = $file->getClientOriginalExtension();
              if($duoi!= 'jpg' && $duoi!='png')
              {
                return redirect('admin/tintuc/them')->with('thongbao','File không chính xác');
              }
              $name = $file->getClientOriginalName();
              $Hinh = str_random(4)."_".$name;
              while(file_exists("hinhanh/tintuc".$Hinh))
              {
                $Hinh = str_random(4)."_".$name;
              }
              $file->move("hinhanh/tintuc",$Hinh);
              $tintuc->Hinh = $Hinh;
        }else
        {
            $tintuc->Hinh = "";
        }

        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
        
    }
    public function getsua($id)
    {
      $theloai = theloai::all();
      $loaitin = loaitin::all();
    	$tintuc = tintuc::find($id);
      return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postsua(Request $request,$id)
    {
      $tintuc = tintuc::find($id);
      $this->validate($request,
        [
          'loaitin'=>'required',
          'TieuDe'=>'required|unique:tintuc,TieuDe',
          'TomTat'=>'required',
          'NoiDung'=>'required'
        ],
        [
          'loaitin.required'=>'Bạn chưa có loại tin',
          'TieuDe.required'=>'Bạn chưa có tiêu đề',
          'TieuDe.unique'=>'Tiêu đề đã tồn tại',
          'TomTat.required'=>'Bạn chưa có tóm tắt',
          'NoiDung.required'=>'Bạn chưa có nội dung'
        ]);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idloaitin =$request->loaitin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        //$tintuc->SoLuotXem = 0;
        if ($request->hasFile('Hinh')) {
          $file = $request->file('Hinh');
          $duoi = $file->getClientOriginalExtension();
          if($duoi!= 'jpg' && $duoi!='png')
          {
            return redirect('admin/tintuc/them')->with('thongbao','File không chính xác');
          }
          $name = $file->getClientOriginalName();
          $Hinh = str_random(4)."_".$name;
          while(file_exists("hinhanh/tintuc".$Hinh))
          {
            $Hinh = str_random(4)."_".$name;
          }
          $file->move("hinhanh/tintuc",$Hinh);
          unlink("hinhanh/tintuc".$tintuc->$Hinh);
          $tintuc->Hinh = $Hinh;
        }else
        {
            $tintuc->Hinh = "";
        }

        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Sửa thành công');

    }
    public function getxoa($id)
    {
        $tintuc = tintuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Đã xóa thành công');
    }

}
 