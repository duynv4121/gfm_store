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

<!-- S???p x???p danh m???c -->
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
<!-- K???t th??c s???p x???p danh m???c -->

<!-- X??? l?? ????n h??ng -->
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
            'Th??nh c??ng!',
            'C???p nh???t t??nh tr???ng d??n h??ng th??nh c??ng!',
            'success'
        );
        location.reload();
      }
    });
  });
</script>
<!--K???t th??c x??? l?? ????n h??ng -->

<!-- Bi???u ????? th???ng k?? doanh s??? -->
<script type="text/javascript">
  $(document).ready(function(){
    //Hi???n th??? bi???u ????? m???c d???nh
    defaultChart();
    //K???t th??c bi???u ????? m???c d???nh

    //Bi???u ????? th???ng k??
    var chart =  new Morris.Bar({
      element: 'chart',
      barColors:['#17a2b8', '#7fad39'],
      hideHover:'auto',
      parseTime:false,
      xkey: 'period',
      ykeys: ['order','sales','profit','quanlity'],
      labels: ['????n h??ng','doanh s???','l???i nhu???n','s??? l?????ng']
    });
    //K???t th??c bi???u ????? th???ng k?? 

    //Datepicker
    $( function() {
      $("#datepicker").datepicker({
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
        duration: "slow"
      });
      $("#datepicker2").datepicker({
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
        duration: "slow"
      });
    });
    //K???t th??c Datepicker 

    //Bi???u ????? th???ng k?? m???c ?????nh 30 ng??y
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
    //K???t th??c bi???u ????? th???ng k?? m???c ?????nh 30 ng??y

    //L???c bi???u ????? th???ng k?? theo select
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
    //K???t th??c l???c bi???u ????? th???ng k?? theo select

    //L???c bi???u ????? th???ng k?? t??? ng??y => ?????n ng??y
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
    //K???t th??c l???c bi???u ????? th???ng k?? t??? ng??y => ?????n ng??y
  });
</script>
<!--K???t th??c bi???u ????? th???ng k?? doanh s??? -->

<!-- Bi???u ????? th???ng k?? s???n ph???m, b??i vi???t.... -->
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
        {label:"S???n ph???m", value:{{$total_product}}, color:colorDanger},
        {label:"B??i vi???t", value:{{$total_blog}}},
        {label:"????n h??ng", value:{{$total_order}}},
        {label:"Nh??n vi??n", value:{{$total_member}}},
        {label:"Kh??ch h??ng", value:{{$total_customer}}}
      ]
    });

    //k??o th??? c??c th??nh ph???n ??? dashboard
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
<!--K???t th??c bi???u ????? th???ng k?? s???n ph???m, b??i vi???t.... -->

{{-- -- Duy???t v?? tr??? l???i b??nh lu???n s???n ph???m -- --}}
<script type="text/javascript">
  //Duy???t b??nh lu???n s???n ph???m
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
  //K???t th??c duy???t b??nh lu???n s???n ph???m

  //Tr??? l???i b??nh lu???n s???n ph???m
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
  //K???t th??c tr??? l???i b??nh lu???n s???n ph???m
</script>
{{-- -- Duy???t v?? tr??? l???i b??nh lu???n s???n ph???mt -- --}}

{{-- -- Duy???t v?? tr??? l???i b??nh lu???n b??i vi???t -- --}}
<script type="text/javascript">
  //Duy???t b??nh lu???n b??i vi???t
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
  //K???t th??c duy???t b??nh lu???n b??i vi???t

  //Tr??? l???i b??nh lu???n b??i vi???t
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
  //K???t th??c tr??? l???i b??nh lu???n b??i vi???t
</script>
{{-- --K???t th??c duy???t v?? tr??? l???i b??nh lu???n b??i vi???t -- --}}

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

  //ch???n ???nh li??n quan\
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
    //N???u nh?? t???n thu???c t??nh file, ?????ng ngh??a ng?????i d??ng ???? ch???n file m???i
    if(input.files && input.files[0]){
        var reader = new FileReader();
        //S??? ki???n file ???? ???????c load v??o website
        reader.onload = function(e){
            //Thay ?????i ???????ng d???n ???nh
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