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
            <h1>Pemesanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pemesanan</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
                
              <div class="card-header"  >
                  <div class="row">
                    <div class="col-md-5">
                      <a class="btn btn-primary" href="{{route('pemesanan.create')}}">
                        <i class="fas fa-edit btn-xs" ></i> Buat Pemesanan
                      </a>
                    </div>
                    <div class="col-md-7">
                      Periode
                      <form action="{{route('pemesanan.index')}}" method="GET">
                        <div class="input-group">
                        
                            @csrf
                            <input type="date" class=""  value="" name="from" required>
                            <div class="input-group-addon">to</div>
                            <input type="date" class=""  name="to" required>
                            <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </form>
                    </div>

                  </div>
                  
                
                  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
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
                          <td>{{date('d-m-Y', strtotime($pemesanan->created_at))}}</td>
                          <td>{{$pemesanan->no_invoice}}</td>
                          <td>
                            @if($pemesanan->status == "Received")
                              <span class="badge badge-pill badge-primary">
                                Received
                              </span>

                            @else
                            <span class="badge badge-pill badge-warning">
                              Pending
                            </span>
                            @endif
                          </td>
                          <td>
                            <div class="btn-group">
                              @if($pemesanan->status == "Pending")
                                <form action="{{route('pemesanan.destroy', $pemesanan->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                  <a class="btn btn-warning" href="{{route('pemesanan.edit', $pemesanan->id)}}" style="margin: 2px; border-radius: 0;" >Edit</a>
                                  <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus data?')" class="btn btn-danger" style="margin: 2px; border-radius: 0;">Delete</button>
                                </form>

                              @else
                              <a class="btn btn-primary" href="{{route('pemesanan.show', $pemesanan->id)}}" style="margin: 2px; border-radius: 0;" >Show</a>
                              @endif

                          </div>
                          </td>
                        </tr>
                        <?php $no++ ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  
  <!-- /.modal -->

  <script>
    $(document).ready(function(){
         @if(session()->has('berhasil'))
              toastr.success("{{session('berhasil')}}")
              
         @endif
         $('input').val(new Date().toDateInputValue());
         
      })
      
  </script>

  
  @endsection