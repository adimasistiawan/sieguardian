@extends('dashboard.helper')
@section('css')
  <style>
    input[type="date"]{
      display: block;
      height: calc(2.25rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      box-shadow: inset 0 0 0 transparent;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    
  </style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kartu Stock</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Kartu Stock</a></li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                @csrf
                                <div class="form-group">
                                    <label for="">Dari</label>
                                    <input type="date" class="form-control input-stok" id="from" name="from">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Sampai</label>
                                    <input type="date" class="form-control input-stok" id="to" name="to">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Barang</label>
                                    <select class="form-control select2 input-stok" id="Obat" name="obat" required>
                                        <option value=""></option>
                                    @foreach ($obat as $item)
                                        <option value="{{$item->id}}" >{{$item->name}} ({{$item->plu}})</option>
                                    @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                               
                                <label for="">&nbsp;</label>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary search">Search</button>
                                </div>
                            </div>
                        </div>
                    <div class="report container" hidden>
                      <div class="container">
                        <br>
                        <br>
                        <br>
                        <div class="pdf">
                          
                        </div>
                        <h3 class="text-center">Kartu Stock</h3>
                        <br>
                        <br>
                        <b>Tanggal : <span class="from"></span> - <span class="to"></span></b><br>
                        <b>Nama : <span class="obat"></span></b><br>
                        <b>PLU : <span class="plu"></span></b><br>
                        <b>Satuan : <span class="satuan"></span></b><br>
                        <b>Kategori : <span class="kategori"></span></b><br>
                        
                        <table class="table table-bordered" style="width: 100%; margin:auto;">
                            <thead>
                                <tr>
                                  <th class="text-center" style="width:180px">Tanggal</th>
                                  <th class="text-center" style="width:120px">Stock Awal</th>
                                  <th class="text-center" style="width:120px">Masuk</th>
                                  <th class="text-center" style="width:120px">Keluar</th>
                                  <th class="text-center" style="width:120px">Sisa</th>
                                </tr>
                              </thead>
                              <tbody class="tbody">
                               
                              </tbody>
                        </table>
                      </div>
                        
                    </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<script>
  $(document).ready(function(){
      $('.search').click(function(){
        $('.pdf').empty();
        
        from = $('#from').val()
        to = $('#to').val()
        obat = $('#Obat').val()

        if(from=="" || to=="" || obat==""){
            $.alert('Mohon lengkapi parameter !');
            return;
        }
        if(from>to){
            $.alert('Tanggal "Dari" harus lebih kecil dari tanggal "Sampai" !');
            return;
        }
        $('.loading').removeAttr('hidden')
        var a=$.datepicker.formatDate( "dd/mm/yy", new Date(from));
        var b=$.datepicker.formatDate( "dd/mm/yy", new Date(to));
        $('.from').text(a)
        $('.to').text(b)
        var url = "{{route('kartu.pdf',['id' => ':id','from' => ':from','to' => ':to'])}}";
        url = url.replace(':from', from);
        url = url.replace(':to', to);
        url = url.replace(':id', obat);
        $('.pdf').append(
            `<a href="`+url+`" target="blank" class="btn btn-success"><i class="fas fa-download"></i> PDF</a>`
          )

        $('.tbody').empty();
        $('.report').removeAttr('hidden')
        var urlsnya='{{route('kartu.search')}}';
        _token = $('input[name=_token]').val();
        form = $('.input-stok');
        var arr= {};
        $.each(form,function(k,value){
            arr[value.name] = value.value;
        });

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {_token:_token, arr:arr},
            url: urlsnya,
        })
        .done(function(response) {
          if(response['report'].length != 0){
            $('.obat').text(response['obat']['name'])
            $('.plu').text(response['obat']['plu'])
            $('.satuan').text(response['obat']['satuan'])
            $('.kategori').text(response['obat']['category']['name'])
            $.each(response['report'],function(k,value){
              
              
              $('.tbody').append(`
              <tr>
                  <td class="text-center">`+$.datepicker.formatDate( "dd/mm/yy", new Date(value['date']))+`</td>
                  <td class="text-right">`+value['stock_awal']+`</td>
                  <td class="text-right">`+value['masuk']+`</td>
                  <td  class="text-right">`+value['keluar']+`</td>
                  <td  class="text-right">`+value['sisa']+`</td>
              </tr>
              `)

              $('.loading').attr('hidden',true)
            });
          }
          else{
            $('.obat').text(response['obat']['name'])
            $('.plu').text(response['obat']['plu'])
            $('.satuan').text(response['obat']['satuan'])
            $('.kategori').text(response['obat']['category']['name'])
            $('.tbody').append(`
              <tr>
                  <td colspan="4" class="text-center">Data Tidak Ada</td>
                  
              </tr>
              `)
              
          }
          $('.loading').attr('hidden',true)
        })
        
      })
    })
</script>

@endsection