@extends('dashboard.helper')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">
                
              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h3>Selamat Datang</h3>
              </div>
            </div>
          </div>
          @if(Auth::user()->role == "kepalatoko")
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" >
                
                  
                    <div class="row">
                      <div class="col-md-3">
                        @csrf
                        <div class="form-group">
                          <label for="">Periode</label>
                          <select name="filter" id="Filter" class="filter form-control" >
                            <option value=""></option>
                            <option value="1">Last 7 Days</option>
                            <option value="2">Last 30 Days</option>
                            <option value="3" selected>This Month</option>
                            <option value="4">Last Month</option>
                            <option value="5">Custom</option>
                          </select>
                        </div>
                  
                      </div>
                      
                        <div class="col-md-3 custom" hidden>
                          <div class="form-group">
                              <label for="">Dari</label>
                              <input type="date" class="form-control input-cari dari" id="from" name="from">
                          </div>
                        </div>
                        <div class="col-md-3 custom" hidden>
                          <div class="form-group">
                              <label for="">Sampai</label>
                              <input type="date" class="form-control input-cari sampai" id="to" name="to">
                          </div>
                        </div>
                        <div class="col-md-3 custom" hidden>
                          <br>
                          <button class="btn btn-primary btn-cari" style="margin-top:8px">Cari</button>
                        </div>
                        
                      
                    
                  </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <div class="card">
                      <div class="card-header"  style="background-color: #007bff; color:#fff;">
                        
                        <h5 class="card-title">Barang Terlaris</h5>
                      </div>
                      <div class="card-body">
                        <br>
                        <div class="donut">

                          <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        
                        </div>
                      </div>
                    </div>
                  </div>
        
                  <div class="col-6">
                    <div class="card">
                      <div class="card-header" style="background-color: #17a2b8; color:#fff;" >
                        
                        <h5 class="card-title">Transaksi Penjualan</h5>
                      </div>
                      <div class="card-body">
                        <span><i class="fas fa-shopping-cart"></i> Total Barang Terjual: <span class="total"></span></span>
                        <div class="bar">

                          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="card">
                      <div class="card-header" style="background-color: #28a745; color:#fff;" >
                        
                        <h5 class="card-title">Tren Penjualan</h5>
                      </div>
                      <div class="card-body">
                        <div class="line">
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="col-md-5">
            <div class="card">
              <div class="card-header" style="background-color: #dc3545; color:#fff;">
                <h5 class="card-title">Stok Barang Kosong(> 2 Minggu)</h5>
              </div>
              <div class="card-body">
                <table  class="example2 table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Dari Tanggal</th>
                      <th>Barang</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($stok as $value)
                    <tr>
                    <td>{{$no}}</td>
                    <td>{{date('d-m-Y', strtotime($value->empty_date))}}</td>
                    <td>{{$value->name}}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach
                    
                  </tbody>
                  
                </table>
              </div>
            </div>

            
          </div>
          <div class="col-md-7">
            <div class="card">
              <div class="card-header" style="background-color: #007bff; color:#fff;">
                <h5 class="card-title">Informasi Pemesanan</h5>
              </div>
              <div class="card-body">
                <table  class="example2 table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Pemesanan</th>
                      <th>No Invoice</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1?>
                    @foreach ($data as $pemesanan)
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{date('d-m-Y', strtotime($pemesanan->date))}}</td>
                          
                          <td class="text-right">{{$pemesanan->no_invoice}}</td>
                          <td>
                            @if($pemesanan->status == "Rejected")
                              <span class="badge badge-pill badge-danger">
                                Rejected
                              </span>
                            
                            @else
                            <span class="badge badge-pill badge-warning">
                              Pending
                            </span>
                            @endif
                          </td>
                          <td>
                            <div class="btn-group">
                              
                                @if($pemesanan->status == "Rejected")
                                  
                                    <a class="btn btn-warning" href="{{route('pemesanan.edit', $pemesanan->id)}}" style="margin: 2px; border-radius: 0;" ><i class="fas fa-search"></i></a>
                                @else
                                  <a class="btn btn-warning" href="{{route('pemesanan.show', $pemesanan->id)}}" style="margin: 2px; border-radius: 0;" ><i class="fas fa-search"></i></a>
                                @endif
                            </div>
                          </td>
                        </tr>
                        <?php $no++ ?>
                    @endforeach
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<div class="modal fade" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
      </div>  
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('dashboard/plugins/chart.js/Chart.min.js')}}"></script>

<script>
  $(document).ready(function(){
    // $('#donutChart').css('cursor', 'pointer');
    var val = $('#Filter').val()
    urlsnya = '{{route('dashboard.filter')}}';
    _token = $('input[name=_token]').val();
    var name = [];
    var qty = [];

    var date = [];
    var jml =[];
    $.ajax({
      type: 'POST',
      dataType: 'json',
      data: {_token:_token, val:val},
      url: urlsnya,
    })
    .done(function(response) {
      console.log(response['total'].qty)
      $('.total').text(response['total'].qty)
      $.each(response['donut'],function(k,value){
          name.push(value['name']);
          qty.push(value['qty']);
      });

      $.each(response['bar'],function(k,value){
          date.push($.datepicker.formatDate( "dd M", new Date(value['date'])));
          jml.push(value['qty']);
      });

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: name,
      datasets: [
        {
          data: qty,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

      var areaChartData = {
        labels  : date,
        datasets: [
          {
            label               : 'Barang Terjual',
          backgroundColor     : '#3c8dbc',
          borderColor         : '#3c8dbc',
          pointRadius         : false,
          pointColor          : '#3c8dbc',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : jml
          },
          
        ]
      }

      var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
     

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : true
      }

      var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })

      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChartOptions = $.extend(true, {}, areaChartOptions)
      var lineChartData = $.extend(true, {}, areaChartData)
      lineChartData.datasets[0].fill = false;
      lineChartOptions.datasetFill = false

      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })
      console.log(date)

    })

    $('.btn-cari').click(function(){
      from = $('.dari').val()
      to = $('.sampai').val()

      if(from=="" || to==""){
          $.alert('Mohon lengkapi parameter !');
          return;
      }
      if(from>to){
          $.alert('Tanggal "Dari" harus lebih kecil dari tanggal "Sampai" !');
          return;
      }
      
      
      $('.loading').removeAttr('hidden')
      $('.donut').empty();
      $('.bar').empty();
      $('.line').empty();
      $('.total').text("")
      $('.donut').append(`
        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      `)
      $('.bar').append(`
      <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      `)
      $('.line').append(`
      <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      `)
      urlsnya = '{{route('dashboard.filter')}}';
      _token = $('input[name=_token]').val();
      var name = [];
          var qty = [];

          var date = [];
          var jml =[];
      $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {_token:_token, dari:$('.dari').val(), sampai:$('.sampai').val()},
        url: urlsnya,
      })
      .done(function(response) {
        console.log(response)
            $('.total').text(response['total'].qty)
            $.each(response['donut'],function(k,value){
                name.push(value['name']);
                qty.push(value['qty']);
            });

            $.each(response['bar'],function(k,value){
                date.push($.datepicker.formatDate( "dd M", new Date(value['date'])));
                jml.push(value['qty']);
            });

          var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
          var donutData        = {
            labels: name,
            datasets: [
              {
                data: qty,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
              }
            ]
          }
          var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
          })

            var areaChartData = {
              labels  : date,
              datasets: [
                {
                  label               : 'Barang Terjual',
                backgroundColor     : '#3c8dbc',
                borderColor         : '#3c8dbc',
                pointRadius         : false,
                pointColor          : '#3c8dbc',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : jml
                },
                
              ]
            }

            var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : false,
                }
              }],
              yAxes: [{
                gridLines : {
                  display : false,
                }
              }]
            }
          }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
          

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : true
            }

            var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
              type: 'line',
              data: lineChartData,
              options: lineChartOptions
            })
            console.log(date)
            $('.loading').attr('hidden',true)
      })
    })

    $("#Filter").change(function(){
      if($(this).val() == "5"){
        $('.custom').removeAttr('hidden')
        $('.input-cari').val("")
      }
      else{
            $('.custom').attr('hidden',true)
            $('.loading').removeAttr('hidden')
            $('.donut').empty();
            $('.bar').empty();
            $('.line').empty();
            $('.total').text("")
            $('.donut').append(`
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            `)
            $('.bar').append(`
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            `)
            $('.line').append(`
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            `)

            var val = $('#Filter').val()
          urlsnya = '{{route('dashboard.filter')}}';
          _token = $('input[name=_token]').val();
          var name = [];
          var qty = [];

          var date = [];
          var jml =[];
          $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {_token:_token, val:val},
            url: urlsnya,
          })
          .done(function(response) {
            $('.total').text(response['total'].qty)
            $.each(response['donut'],function(k,value){
                name.push(value['name']);
                qty.push(value['qty']);
            });

            $.each(response['bar'],function(k,value){
                date.push($.datepicker.formatDate( "dd M", new Date(value['date'])));
                jml.push(value['qty']);
            });

          var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
          var donutData        = {
            labels: name,
            datasets: [
              {
                data: qty,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
              }
            ]
          }
          var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
          })

            var areaChartData = {
              labels  : date,
              datasets: [
                {
                  label               : 'Barang Terjual',
                backgroundColor     : '#3c8dbc',
                borderColor         : '#3c8dbc',
                pointRadius         : false,
                pointColor          : '#3c8dbc',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : jml
                },
                
              ]
            }

            var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : false,
                },
                
              }],
              yAxes: [{
                gridLines : {
                  display : false,
                },
                ticks: {
                    beginAtZero: true
                }
              }]
            }
          }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
          

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : true
            }

            var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })

            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
              type: 'line',
              data: lineChartData,
              options: lineChartOptions
            })
            console.log(date)
            $('.loading').attr('hidden',true)
          })
      }
      
    })

    // $('#donutChart').click(function(){
    //   $('.modal').modal('show')
    // })
    
  })
</script>
@endsection