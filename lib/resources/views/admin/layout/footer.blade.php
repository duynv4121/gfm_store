<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">adminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
</footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3.6.0 -->
<script src="{{asset('public/admin/js/jquery-3.6.0.js')}}"></script>
<!-- jQuery UI 1.13.0 -->
<script src="{{asset('public/admin/js/jquery-ui.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/admin/js/adminlte.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Sweet-alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Morris Chart -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- Sweet Alert -->

{!! Toastr::message() !!}

<!-- Sắp xếp danh mục -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#category_order').sortable({
      placeholder: 'ui-state-highlight',
      update: function (event, ui){
        var page_id_array = new Array();
        var _token = $('input[name="_token"]').val();
        $('#category_order tr').each(function(){
          page_id_array.push($(this).attr("id"));
        });
        $.ajax({
          url:"{{url('admin/arrange-category')}}",
          method:"POST",
          data:{page_id_array:page_id_array,_token:_token},
          success:function(data){
            alert(data);
          }
        });
      }
    }); 
  }); 
</script>
<!-- Kết thúc sắp xếp danh mục -->

<!-- Xử lý đơn hàng -->
<script type="text/javascript">
  $('.order_detail').change(function(){
    var status = $(this).val();
    var order_id = $(this).children(":selected").attr("id");
    var _token = $('input[name="_token"]').val();
    
    $.ajax({
      url:"{{url('admin/update-order')}}",
      method:"POST",
      data:{status:status,order_id:order_id,_token:_token},
      success:function(data){
        Swal.fire(
            'Thành công!',
            'Cập nhật tình trạng dơn hàng thành công!',
            'success'
        );
        location.reload();
      }
    });
  });
</script>
<!--Kết thúc xử lý đơn hàng -->

<!-- Biểu đồ thống kê doanh số -->
<script type="text/javascript">
  $(document).ready(function(){
    //Hiển thị biểu đồ mặc dịnh
    defaultChart();
    //Kết thúc biểu đồ mặc dịnh

    //Biểu đồ thống kê
    var chart =  new Morris.Bar({
      element: 'chart',
      barColors:['#17a2b8', '#7fad39'],
      hideHover:'auto',
      parseTime:false,
      xkey: 'period',
      ykeys: ['order','sales','profit','quanlity'],
      labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
    });
    //Kết thúc biểu đồ thống kê 

    //Datepicker
    $( function() {
      $("#datepicker").datepicker({
        prevText: "Tháng trước",
        nextText: "Thàng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
        duration: "slow"
      });
      $("#datepicker2").datepicker({
        prevText: "Tháng trước",
        nextText: "Thàng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
        duration: "slow"
      });
    });
    //Kết thúc Datepicker 

    //Biểu đồ thống kê mặc định 30 ngày
    function defaultChart(){
      var _token =$('input[name="_token"]').val();
      $.ajax({
        url :"{{url('admin/default_chart')}}",
        method: "POST",
        dataType:"JSON",
        data:{_token:_token},
        success:function(data){
          chart.setData(data);
        }
      });
    }
    //Kết thúc biểu đồ thống kê mặc định 30 ngày

    //Lọc biểu đồ thống kê theo select
    $('.dashboard-filter').change(function(){
      var select_value = $(this).val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url :"{{url('admin/filter_by_select')}}",
        method: "POST",
        dataType:"JSON",
        data:{select_value:select_value,_token:_token},
        success:function(data){
          chart.setData(data);
        }
      });
    });
    //Kết thúc lọc biểu đồ thống kê theo select

    //Lọc biểu đồ thống kê từ ngày => đến ngày
    $('#btn_dashboard_filter').click(function(){
      var _token = $('input[name="_token"]').val();
      var from_date = $('#datepicker').val();
      var to_date = $('#datepicker2').val();
      $.ajax({
        url :"{{url('admin/filter_by_date')}}",
        method: "POST",
        dataType:"JSON",
        data:{from_date:from_date,to_date:to_date,_token:_token},
        success:function(data){
          chart.setData(data);
        }
      });
    });
    //Kết thúc lọc biểu đồ thống kê từ ngày => đến ngày
  });
</script>
<!--Kết thúc biểu đồ thống kê doanh số -->

<!-- Biểu đồ thống kê sản phẩm, bài viết.... -->
<script type="text/javascript">
  $(document).ready(function(){
    var colorDanger = "#FF1744";
    Morris.Donut({
      element: 'donut',
      resize: true,
      colors: [
        '#E0F7FA',
        '#B2EBF2',
        '#80DEEA',
        '#4DD0E1',
        '#26C6DA'
      ],
      data: [
        {label:"Sản phảm", value:{{$total_product}}, color:colorDanger},
        {label:"Bài viết", value:{{$total_blog}}},
        {label:"Đơn hàng", value:{{$total_order}}},
        {label:"Nhân viên", value:{{$total_member}}},
        {label:"Khách hàng", value:{{$total_customer}}}
      ]
    });

    //kéo thả các thành phần ở dashboard
     $('.connectedSortable').sortable({
      placeholder: 'sort-highlight',
      connectWith: '.connectedSortable',
      handle: '.card-header, .nav-tabs',
      forcePlaceholderSize: true,
      zIndex: 999999
  })
    $('.connectedSortable .card-header').css('cursor', 'move')
  });
</script>
<!--Kết thúc biểu đồ thống kê sản phẩm, bài viết.... -->

{{-- -- Duyệt và trả lời bình luận sản phẩm -- --}}
<script type="text/javascript">
  //Duyệt bình luận sản phẩm
  $('.comment_product_allow').click(function(){
      var comment_status = $(this).data('comment_status');
      var comment_id = $(this).data('comment_id');
      var product_id = $(this).attr('id');
      $.ajax({
        url:"{{url('admin/allow-comment-product')}}",
        method:"POST",
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }, 
        data: {comment_status:comment_status, comment_id:comment_id, product_id:product_id},
        success:function(data){
          location.reload();
        }
    });
  });
  //Kết thúc duyệt bình luận sản phẩm

  //Trả lời bình luận sản phẩm
  $('.send_reply_comment_product').click(function(){
    var comment_id = $(this).data('comment_id');
    var reply_comment_product = $('.reply_comment_product_'+comment_id).val();
    var product_id = $(this).data('product_id');
    $.ajax({
      url:"{{url('admin/reply-comment-product')}}",
      method:"POST",
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }, 
      data: {reply_comment_product:reply_comment_product, comment_id:comment_id, product_id:product_id},
      success:function(data){
        $('.reply_comment_product').val('');
        location.reload();
      }
    });
  });
  //Kết thúc trả lời bình luận sản phẩm
</script>
{{-- -- Duyệt và trả lời bình luận sản phẩmt -- --}}

{{-- -- Duyệt và trả lời bình luận bài viết -- --}}
<script type="text/javascript">
  //Duyệt bình luận bài viết
  $('.comment_allow').click(function(){
      var comment_status = $(this).data('comment_status');
      var comment_id = $(this).data('comment_id');
      var blog_id = $(this).attr('id');
      $.ajax({
        url:"{{url('admin/allow-comment-blog')}}",
        method:"POST",
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }, 
        data: {comment_status:comment_status, comment_id:comment_id, blog_id:blog_id},
        success:function(data){
          location.reload();
        }
    });
  });
  //Kết thúc duyệt bình luận bài viết

  //Trả lời bình luận bài viết
  $('.send_reply_comment').click(function(){
    var comment_id = $(this).data('comment_id');
    var reply_comment = $('.reply_comment_'+comment_id).val();
    var blog_id = $(this).data('blog_id');
    $.ajax({
      url:"{{url('admin/reply-comment-blog')}}",
      method:"POST",
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }, 
      data: {reply_comment:reply_comment, comment_id:comment_id, blog_id:blog_id},
      success:function(data){
        $('.reply_comment').val('');
        location.reload();
      }
    });
  });
  //Kết thúc trả lời bình luận bài viết
</script>
{{-- --Kết thúc duyệt và trả lời bình luận bài viết -- --}}

<script type="text/javascript">
  $(document).ready(function(){
    $('.choose').on('change',function(){
        var action = $(this).attr('id');
        var ma_id =  $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';

        if(action=='city'){
            result = 'district';
        }else{
            result = 'village';
        }
        // console.log("ma_id", ma_id);
        $.ajax({
            url: '{{url('select-delivery-home')}}',
            method: 'POST',
            data: {action:action, ma_id:ma_id, _token:_token},
            success:function(data){
                $('#'+result).html(data);
            }
        });
    });

  $(document).on('blur', '.feeship_edit', function(){
    var _token = $('input[name="_token"]').val();
    var feeship_id = $(this).data('feeship_id');
    var fee_ship = $(this).text();
    $.ajax({
        url: '{{url('admin/feeship/update-fee')}}',
        method: 'POST',
        data: {feeship_id:feeship_id, fee_ship:fee_ship, _token:_token},
        success:function(){
          location.reload();
        }
      })
    })
  });
</script>

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $('.img_preview').click(function(){
    $('.img').click();
  })

  //select cate
  $('#select_cate').change(function(){
    var _token = $('input[name="_token"]').val();
    var id_cate = $('#select_cate').val();

    $.ajax({
      url: "{{url('admin/select-category')}}",
      method: 'POST',
      data: {
        id_cate:id_cate, _token:_token,
      },
      success:function(data){
        $('#chid_cate').html(data);
      }
    });
  })

  //chọn ảnh liên quan\
  $('.img_preview_gallery').click(function(){
    var id = $(this).data('id');
    $('.input_file_'+id).click();

    $('.input_file_'+id).change(function(){
      previewURL(this)
    })

    function previewURL(input){
      if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
              $('.img_preview_gallery_'+id).attr('src',e.target.result)
          }
          reader.readAsDataURL(input.files[0]);
      }
    }
  })

  function changeImg(input){
    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
    if(input.files && input.files[0]){
        var reader = new FileReader();
        //Sự kiện file đã được load vào website
        reader.onload = function(e){
            //Thay đổi đường dẫn ảnh
            $('#avatar').attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }

  $(document).ready(function() {
      $('#avatar').click(function(){
          $('#img').click();
      });
  });
</script>

</body>
</html>