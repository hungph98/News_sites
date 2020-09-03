<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;


class userController extends Controller
{
    //
    public function getdanhsach()
    {
        $user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getthem()
    {   
        return view('admin.user.them');
    }
    public function postthem(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required|min:3',
                'email'=>'required|email|unique:user,email',
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password'
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
                'email.required'=>'Bạn chưa nhâp email',
                'email.email'=>'Bạn chưa nhập đúng định dạng email',
                'email.unique'=>'email này đã tồn tại',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu ít nhất 3 kí tự',
                'password.max'=>'Mật khẩu chỉ tối đa 32 kí tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Mật khẩu không đúng'
            ]);
        $user=new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;

        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');

    }
    public function getsua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postsua(Request $request,$id)
    {
        $this->validate($request,
            [
                'name'=>'required|min:3'
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự'    
            ]);
        $user= User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->changepassword == "one")
        {
            $this->validate($request,
            [
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password'
            ],
            [
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu ít nhất 3 kí tự',
                'password.max'=>'Mật khẩu chỉ tối đa 32 kí tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Mật khẩu không đúng' 
            ]);
            $user->password= bcrypt($request0->password);

        }
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();
        return redirect('admin.user/sua'.$id)->wiht('thongbao','Bạn đã sử thàng công');

    }

    public function getxoa($id)
    {
        $user= User::find($id);
        $user->delete();
        return redirect('admin/user/sansach')->wit('thongbao','Bạn đã cóa thành công');
    }

    //Hàm đăng nhập
    public function getdangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request)
    {
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],
            [
                'email.required'=>'Bạn chưa nhập email',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu tối thiểu 3 kí tự',
                'password.max'=>'Mật khẩu tối đa 32 kí tự'
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');

        }else
        {
            return redirect('admin/dangnhap')->with('thongbao','Sai thông tin đang nhập hoặc mật khẩu');
        }
    }


    //logout
    public function getlogout()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
 