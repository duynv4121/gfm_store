@extends('admin.layout.index')
@section('title','Trang chủ')
@section('content')
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$total_order}}</h3>
                  <p>Tổng số đơn hàng</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$total_product}}</h3>
                  <p>Tông số sản phẩm</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$total_member}}</h3>
                  <p>Tổng số nhân viên</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$total_customer}}</h3>
                  <p>Tổng số khách hàng</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>

          <div class="row">
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title jutify-content-center"><i class="fas fa-chart-pie mr-1"></i>Biểu đồ thống kê doanh số</h3> <br>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <form autocomplete="off">
                    <div class="row">
                      <div class="col-sm-2">
                        <p>Từ ngày:</p>
                        <input type="text" id="datepicker" class="form=control">
                        <input type="button" id="btn_dashboard_filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                      </div>
                      <div class="col-sm-2">
                        <p>Đến ngày:</p>
                        <input type="text" id="datepicker2" class="form=control">
                      </div>
                      <div class="col-sm-2">
                        <p>Lọc theo:</p>
                        <select class="dashboard-filter form-control">
                          <option>--Chọn--</option>
                          <option value="7ngay">7 ngày qua</option>
                          <option value="thangtruoc">Tháng trước</option>
                          <option value="thangnay">Tháng này</option>
                          <option value="motnam">Một năm</option>
                        </select>
                      </div>
                    </div>
                    @csrf
                  </form> 
                  <div id="chart" style="height: 250px;"></div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
          </div>
          <!-- /.row -->
          <!-- Main row -->

          <div class="row">
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card sidebar-dark-primary">
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">TOTAL COST</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL PROFIT</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">GOAL COMPLETIONS</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.card -->
            </section>
          </div>

          <div class="row">
            <section class="col-lg-4 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Biểu đồ thống kê số lượng</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div id="donut"></div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-4 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card bg-gradient-success">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-eye mr-1"></i>Sản phẩm xem nhiều</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <ol>
                    @foreach ($product_views as $val)
                    <li class="views">
                      <a href="{{url('chi-tiet-san-pham')}}/{{$val->id}}/{{$val->slug}}">{{$val->name}}
                        <span style="float: right">{{$val->views}}<i class="fa fa-eye justify-content-end"></i></span></a>
                    </li>
                    @endforeach
                  </ol>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-4 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card bg-gradient-success">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-eye mr-1"></i>Bài viết xem nhiều</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <ol>
                    @foreach ($blog_views as $val)
                    <li class="views">
                      <a href="{{url('chi-tiet-bai-viet')}}/{{$val->id}}/{{$val->slug}}">{{$val->name}}
                        <span style="float: right">{{$val->views}}<i class="fa fa-eye justify-content-end"></i></a></span>
                    </li>
                    @endforeach
                  </ol>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
          </div>

          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- TO DO List -->
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Danh sách đơn hàng gần đây</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                        <tr>
                          <th>Mã đơn hàng</th>
                          <th>Chủ đơn hàng</th>
                          <th>Tình trạng</th>
                          <th>Thời gian đặt hàng</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($list_orders as $value)
                        <tr>
                          <td><a href="pages/examples/invoice.html">{{$value->order_code}}</a></td>
                          <td>{{$value->name}}</td>
                          <td>
                            @if($value->status == 0)
                              <span class="badge badge-secondary">Đang chờ xử lý</span>
                            @else
                              <span class="badge badge-success">Đã xử lý - Đã giao hàng</span></td>
                            @endif
                          <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">{{date('H:i d/m/Y',strtotime($value->created_at))}}</div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <a href="{{url('admin/manage-order')}}" class="btn btn-sm btn-secondary float-right">Tất cả dơn hàng</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <!-- solid sales graph -->
              <div class="card bg-gradient-info">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Sales Graph
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                            data-fgColor="#39CCCC">

                      <div class="text-white">Mail-Orders</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                            data-fgColor="#39CCCC">

                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                            data-fgColor="#39CCCC">

                      <div class="text-white">In-Store</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div> 
@endsection