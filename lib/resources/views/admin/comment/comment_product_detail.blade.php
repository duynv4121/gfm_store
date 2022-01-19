@extends('admin.layout.index')
@section('title','Chi tiết bình luận')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/comment')}}">Bình luận sản phẩm</a></li>
                            <li class="breadcrumb-item active">Chi tiết bình luận</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Chi tiết bình luận</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{url('admin/comment/delete')}}" method="POST" >
                                    @csrf
                                    @can('xoa binh luan')
                                    <div class="delete_ch" style="width=120px;">
                                        <div>
                                            <label for="checkAll" class="btn btn-danger mb-2 float-left select" style=" font-weight:400;"> Chọn tất cả </label>
                                            <label for="checkAll" class="btn btn-danger mb-2 float-left unselect"style="display:none;font-weight:400;"> Bỏ chọn</label>
                                            <input type="checkbox" hidden id="checkAll">
                                        </div>
                                        <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#largeModal1" style="margin-left:5px">Xóa</button>
                                    </div>
                                    @endcan
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="30px">X</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Nội dung</th>
                                                <th>Đánh giá</th>
                                                <th>Thời gian bình luận</th>
                                                <th>Tình trạng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $row)
                                            <tr>
                                                <td><input type="checkbox" name="checkbox[]" class="checkbox" value="{{$row->id}}" id=""></td>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->email}}</td>
                                                <td>
                                                    {{$row->content}}
                                                    <ul class="list_reply">
                                                        @foreach ($data_rep as $reply_row)
                                                        @if ($reply_row->parent_comment == $row->id)
                                                            <li><i class="fa fa-comment"></i>{{$reply_row->content}}</li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                    @if($row->status == 1)
                                                    <textarea class="form-control reply_comment_product_{{$row->id}}" rows="3"></textarea> <br>
                                                    <button class="btn btn-xs btn-primary send_reply_comment_product" data-comment_id="{{$row->id}}" data-product_id="{{$row->product_id}}">Trả lời</button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">{{$row->rating}}<i class="fa fa-star" style="color: yellow;"></i></td>
                                                <td>{{date('d/m/Y H:i',strtotime($row->created_at))}}</td>
                                                <td>
                                                    @if($row->status == 1)
                                                        <input type="button" data-comment_status="0" data-comment_id="{{$row->id}}" id="{{$row->product_id}}" class="btn btn-danger btn-xs comment_product_allow" value="Bỏ duyệt">
                                                    @else
                                                        <input type="button" data-comment_status="1" data-comment_id="{{$row->id}}" id="{{$row->product_id}}" class="btn btn-success btn-xs comment_product_allow" value="Duyệt">
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        var checkAll = document.querySelector('#checkAll')
        var checkBoxs = document.querySelectorAll('.checkbox')
        var selected = document.querySelector('.select')
        var unselected = document.querySelector('.unselect')

        checkAll.onclick = () => {
            checkBoxs.forEach(checkBox => {
                if (checkAll.checked == true) {
                    checkBox.checked = true
                    selected.style.display = 'none'
                    unselected.style.display = 'block'
                } else {
                    checkBox.checked = false
                    selected.style.display = 'block'
                    unselected.style.display = 'none'
                }
            })
        }
    </script>
@endsection