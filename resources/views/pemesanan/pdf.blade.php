<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
  
  <!-- Select2 -->
  {{-- <script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script> --}}
    <style>
    *{
      font-size:13px;
    }
    .select2-container--default .select2-selection--single {
            width: 244.167px;
        }

        .tr-lokasi{
            background-color: #3c8dbc;
            color:white;
            font-size: 15px;
            text-align: center;
        }
        .tr-kategori{
            background-color: #fdcb6e;
            color:black;
            font-size: 15px;
            text-align: center;
        }

        .thead-dark{
            background-color: #b2bec3;
            color: black;
        }
        .table {
        border-collapse: collapse;
        }

        .table, .th, .td {
        border: 1px solid black;
        }
        .tr{
          border:1px solid #000000;
        }
    </style>
</head>
<body>
    
      <div style="text-align: center;">
        
        <span style="color: #3c8dbc; font-weight:600">APOTEK GUARDIAN BALI SOYA SANUR</span><br>
        <span style="color: #3c8dbc;">Jl. Danau Tamblingan no.47</span><br>
        <span style="color: #3c8dbc;">Telp : 0361-8497838</span><br>
        <span style="color: #3c8dbc;">Email : bssanur@hero.co.id</span><br>
        <hr style="border: 2px solid #0778b9;"><br>

        <u><span style="font-weight:600; font-size:19px;">SURAT PESANAN OBAT</span></u><br>
        <span >No SP : 051/VII/2019/BSS/6510</span><br>
      </div>
      <br>
      <br>
      <p>Yang bertanda tangan di bawah ini:</p>
      <table>
        
        <tr>
          <td>Nama</td>
          <td>: Johanna Cindy Hartono, S.Farm., Apt.</td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td>: Apoteker Pengelola Apotek.</td>
        </tr>
        <tr>
          <td>Nomor SIPA</td>
          <td>: 284/SIPA.030.12.20/2018</td>
        </tr>
        <tr>
          <td>Nomor SIA</td>
          <td>: 44/28/1983/DS/DPMPTSP/2018</td>
        </tr>
        <tr>
          
          <td colspan="2">
            <br>
            Mengajukan pesanan obat mengandung Prekursor kepada:
            
          </td>
        </tr>
        <tr>
          <td><br>Nama PBF</td>
          <td><br>: PT. Hero Supermarket, Tbk.</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>: Kawasan Pergudangan dan Industri Safe N Lock AP6516-AP6518</td>
        </tr>
        <tr>
          <td></td>
          <td>Jl. Lingkar Timur KM 5,5 Sidoarjo-Jawa Timur</td>
        </tr>
        <tr>
          <td>Telp</td>
          <td>: : 031-99711877</td>
        </tr>
        <tr>
          <td></td>
          <td> P2T/18/03.19/01/IV/2019.</td>
        </tr>
        
      </table>
      <table  class="table"style="width: 80%; border:1px solid #000000;">
        <tr class="tr">
          <th class="th" width="50px" style="text-align: center;">No</th>
          <th class="th" width="200px" style="text-align: center;">Obat</th>
          <th class="th" width="100px" style="text-align: center;">Satuan</th>
          <th class="th" width="50px" style="text-align: center;">Jumlah</th>
          <th class="th" style="text-align: center;" width="50px">Keterangan</th>
        </tr>
          <?php $no = 1?>
          
          @foreach($pemesanan_detail as $value)
              <tr class="tr" style=border:1px solid #000000;">
                  <td class="td" style="text-align: center;">
                      {{$no}}
                  </td>
                  <td class="td">
                      {{$value->name}}
                  </td>
                  <td class="td" style="text-align: center;">
                      {{$value->satuan}}
                  </td>
                  <td class="td" style="text-align: right;">
                      {{$value->qty}}
                  </td>
                  <td class="td">
                      {{$value->keterangan}}
                  </td>
              </tr>
              <?php $no++?>
          @endforeach
          
        
       
      </table>
      <br>
      <br>
      <br>
      <br>
      <br>
      
      <table width="100%" >
        <tr>
          <td width="200px">
            &nbsp;
          </td>
          <td width="200px">
            &nbsp;
          </td>
          <td width="300px" style="text-align: center;">
            <p>Sanur, {{date('d/m/Y',strtotime($pemesanan->date))}}</p>
            <br>
            <br>
            <br>
            <br>
            <p>(Johanna Cindy Hartono, S. Farm., Apt)</p>
            <p>284/SIPA.030.12.20/2018</p>
          </td>
        </tr>
      </table>  
      
        
      


{{-- <script src="{{asset('dashboard/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('dashboard/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('dashboard/plugins/chart.js/Chart.min.js')}}"></script>

<!-- FLOT CHARTS -->
<script src="{{asset('dashboard/plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('dashboard/plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('dashboard/plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    

    var donutData = [
      {
        label: 'Series2',
        data : 30,
        color: '#3c8dbc'
      },
      
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */
     function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + series.percent + '</div>'
  }
});
    
</script> --}}
</body>
</html>