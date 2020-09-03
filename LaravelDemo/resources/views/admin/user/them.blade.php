@extends('admin.Layout.index') 
@section('content')      
<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors -> all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        <form action="admin/user/them" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="Name" placeholder="Nhập tên đăng nhập " />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" placeholder="Nhập mât khẩu" />
                            </div>
                            <div class="form-group">
                                <label>PasswordAgain</label>
                                <input class="form-control" name="passwordagain" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Phân quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" checked="" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio">User
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection