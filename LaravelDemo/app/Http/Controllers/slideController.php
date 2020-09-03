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
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }	
    public function getthem()
    {
    	return view('admin.slide.them');
    }
    public function postthem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required',
    			'NoiDung'=>'required',
    		],
    		[
    			'Ten.required'=>"Bạn chưa nhập tên",
    			'NoiDung.required'=>"Bạn chưa có nội dung"
    		]);
    	$slide=new slide;
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link'))
    	{
    		$slide ->link = $request->link;
    	}
    	if ($request->hasFile('Hinh')) {
	        $file = $request->file('Hinh');
	        $duoi = $file->getClientOriginalExtension();
	        if($duoi!= 'jpg' && $duoi!='png')
	        {
	        	return redirect('admin/slide/them')->with('thongbao','File không chính xác');
	        }
	        $name = $file->getClientOriginalName();
	        $Hinh = $name;
	        while(file_exists("hinhanh/slide".$Hinh))
	        {
	        	$Hinh = $name;
	        }
	        $file->move("hinhanh/slide",$Hinh);
	        $slide->Hinh = $Hinh;
	    }else
	   	{
	        $slide->Hinh = "";
	    }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }
    public function getsua($id)
    {
    	$slide = slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postsua(Request $request,$id)
    {
    	$slide = slide::find($id);
    	$this->validate($request,
    		[
    			'Ten'=>'required',
    			'NoiDung'=>'required',
    		],
    		[
    			'Ten.required'=>"Bạn chưa nhập tên",
    			'NoiDung.required'=>"Bạn chưa có nội dung"
    		]);
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link'))
    	{
    		$slide ->link = $request->link;
    	}
    	if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi!= 'jpg' && $duoi!='png')
            {
              return redirect('admin/slide/them')->with('thongbao','File không chính xác');
            }
            $name = $file->getClientOriginalName();
            $Hinh = $name;
            while(file_exists("hinhanh/slide".$Hinh))
            {
            	$Hinh = $name;
            }
            unlink("hinhanh/slide/".$slide->Hinh);
            $file->move("hinhanh/slide",$Hinh);
            $slide->Hinh = $Hinh;
	    }else
	    {
	        $slide->Hinh = "";
	    }
        $slide->save();
        return redirect('admin/slide/sua/{{ $slide->id }}')->with('thongbao','Thêm thành công');
    }



    public function getxoa($id)
    {
        $slide = slide::find($id);
        $comment->delete();
        return redirect('admin/slide/danhsach/')->with('thongbao','Xóa thành công');
    }
}