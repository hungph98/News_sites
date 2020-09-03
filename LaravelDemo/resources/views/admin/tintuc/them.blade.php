@extends('admin.Layout.index') 
@section('content')      
<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" >
                                @foreach($errors->all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="Theloai" id="theloai">
                                    @foreach ($theloai as $tl)
                                        <option value="{{ $tl->id }}">{{ $tl->Ten }}</option>}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                    @foreach ($loaitin as $lt)
                                        <option value="{{ $lt->id }}">{{ $lt->Ten }}</option>}
                                        option
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="tieude" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <input class="form-control" name="Tomtat" placeholder="nhập tóm tắt" />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor" placeholder="Nhập nội dung" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh" />
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" checked="" type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" type="radio">Không
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