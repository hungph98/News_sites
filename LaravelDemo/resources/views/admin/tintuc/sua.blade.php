@extends('admin.Layout.index') 
@section('content')      
<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">News
                            <small>{{ $tintuc->TieuDe }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if (count($errors) > 0)
                            <div class="arlert arlert-danger" >
                                @foreach($errors->all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('thongbao'))
                            <div class="arlert arlert-success">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        <form action="admin/tintuc/sua/{{'$tintuc->id '}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach ($theloai as $tl)
                                        <option 
                                        @if ($tintuc->loaitin->theloai->id == $tl->id)
                                            {{"selected"}}
                                        @endif
                                        value="{{ $tl->id }}">{{ $tl->Ten }}</option>}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                    @foreach ($loaitin as $lt)
                                        <option
                                        @if ($tintuc->loaitin->id == $lt->id)
                                            {{"selected"}}
                                        @endif 
                                        value="{{ $lt->id }}">{{ $lt->Ten }}</option>}
                                        option
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="Tieude" value="{{ $tintuc->TieuDe }}" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <input class="form-control" name="TomTat" value="{{ $tintuc->TomTat }}" value="{{ $tintuc->NoiDung }}" placeholder="Nhập tóm tắt" />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor" placeholder="Nhập nội dung" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p>
                                    <img width="500px" src="hinhanh/tintuc/{{ $tintuc->Hinh }}" alt="">
                                </p>
                                <input type="file" name="Hinh" class=" form-control" />
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                    @if ($tintuc->NoiBat == 1)
                                        {{"checked"}}
                                    @endif
                                     type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" 
                                    @if ($tintuc->NoiBat == 0)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình luận
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày đăng</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $cm->id }}</td>
                                    <td>{{ $cm->user->name }}</td>
                                    <td>{{ $cm->NoiDung }}</td>
                                    <td>{{ $cm->created_at }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#theloai").change(function(){
                var idtheloai = $(this).val();
                $.get("admin/ajax/loaitin/"+idtheloai,function(data){
                    //arlert('ok');
                    $('#loaitin').html(data);
                });
            });
        });
    </script>
@endsection