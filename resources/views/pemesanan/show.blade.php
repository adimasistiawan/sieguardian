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
            <h1>Lihat Pemesanan</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pemesanan</a></li>
              <li class="breadcrumb-item active">Lihat Pemesanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    {{-- form --}}
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Pemesanan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body col-md-12 form_content">
                <div class="col-md-4">
                  @csrf
                  <table>
                    <tr>
                        <td>Dibuat Oleh</td>
                        <td>:</td>
                        <td>{{$pemesanan->users->name}}</td>
                    </tr>
                      <tr>
                          <td>No Invoice</td>
                          <td>:</td>
                          <td>{{$pemesanan->no_invoice}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Pemesanan</td>
                        <td>:</td>
                        <td>{{date('d-m-Y', strtotime($pemesanan->created_at))}}</td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if($pemesanan->status == "Approved")
                              <span class="badge badge-pill badge-primary">
                                Approved
                              </span>
                            @elseif($pemesanan->status == "Rejected")
                            <span class="badge badge-pill badge-danger">
                              Rejected
                            </span>
                            @else
                            <span class="badge badge-pill badge-warning">
                              Pending
                            </span>
                            @endif
                        </td>
                      </tr>
                  </table>
                <a href="{{route('pemesanan.pdf',$pemesanan->id)}}" target="blank" class="btn btn-success"><i class="fas fa-download"></i> PDF</a>
                </div>
              <div class="col-md-12" style="margin-top:50px;">
               
                <table class="table table-bordered" style="width: 100%">
                  <thead>
                    <th width="">No</th>
                    <th width="300px">Obat</th>
                    <th width="200px">Satuan</th>
                    <th width="200px">Jumlah</th>
                    <th>Keterangan</th>
                  </thead>
                  <tbody id="tbody">
                    <?php $no = 1?>
                    @foreach($pemesanan_detail as $value)
                        <tr class="tr">
                            <td>
                                {{$no}}
                            </td>
                            <td>
                                {{$value->name}}
                            </td>
                            <td>
                                {{$value->satuan}}
                            </td>
                            <td class="text-right">
                                {{$value->qty}}
                            </td>
                            <td>
                                {{$value->keterangan}}
                            </td>
                        </tr>
                        <?php $no++?>
                    @endforeach
                      
                    
                    
                  </tbody>
                 
                </table>
              </div>
            
            
                </div>
                
                @if(Auth::user()->role == "kepalatoko" && $pemesanan->status == "Pending")
                <div class="card-footer">
                  <button class="btn btn-primary btn-approve" >Approve</button>
                  <button class="btn btn-danger btn-reject" >Reject</button>
                  
                </div>
                @endif
            </div>
            <!-- /.card -->
          </div>
          {{-- batas form --}}

          
            <!-- /.card -->
            <!-- general form elements disabled -->
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    </section>

    <script type="text/javascript">

        $(document).ready(function(){
          $('.btn-approve').click(function(){
            $.confirm({
              theme: 'material',
              title: 'Warning!',
              content: 'Apakah anda yakin ingin menerima pemesanan ini ?',
              buttons: {
                Yes: function(){
                  urlsnya = '{{route('pemesanan.update',$pemesanan->id)}}';
                  _token = $('input[name=_token]').val();
                  $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    data: {_token:_token, status:'Approved'},
                    url: urlsnya,
                  })
                  .done(function(response) {
                    if(response == 1){
                      toastr.success("Success")
                      url = "{{ route('pemesanan.index')}}";
                      window.location.replace(url);
                    }
                    
                  })
                  .fail(function(){
                    $.alert("error");
                    return;
                  })
                  .always(function() {
                      console.log("complete");
                  });
                },
                No: function () {
                  return;
                }
              }
            })
            
          })

          $('.btn-reject').click(function(){
            $.confirm({
              theme: 'material',
              title: 'Warning!',
              content: 'Apakah anda yakin ingin menolak pemesanan ini ?',
              buttons: {
                Yes: function(){
                  urlsnya = '{{route('pemesanan.update',$pemesanan->id)}}';
                  _token = $('input[name=_token]').val();
                  $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    data: {_token:_token, status:'Rejected'},
                    url: urlsnya,
                  })
                  .done(function(response) {
                    if(response == 1){
                      toastr.success("Success")
                      url = "{{ route('pemesanan.index')}}";
                      window.location.replace(url);
                    }
                    
                  })
                  .fail(function(){
                    $.alert("error");
                    return;
                  })
                  .always(function() {
                      console.log("complete");
                  });
                },
                No: function () {
                  return;
                }
              }
            })
            
          })
        });
      </script>
@endsection

