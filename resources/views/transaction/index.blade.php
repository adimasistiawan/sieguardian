@extends('dashboard.helper')
@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              
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
                    @if(Auth::user()->role == "apoteker")
                    <a class="btn btn-primary" href="{{route('dashboard-transaction.create')}}">
                      <i class="fas fa-edit btn-xs" ></i> Tambah Transaksi
                    </a>
                    @endif
                  </div>
                  <div class="col-md-7">
                      
                        <form action="{{route('dashboard-transaction.index')}}" method="GET">
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
                      <th>Tanggal</th>
                      <th>Dibuat Oleh</th>
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Price (Rp)</th>
                      <th>Total (Rp)</th>
                      <th>Status</th>
                      @if(Auth::user()->role == "apoteker")
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1?>
                    @foreach ($transactions as $transaction)
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{date('d-m-Y', strtotime($transaction->date))}}</td>
                          <td>{{$transaction->user}}</td>
                          <td>{{$transaction->obat_name}}</td>
                          <td class="text-right">{{$transaction->qty}}</td>
                          <td class="text-right">{{rupiah($transaction->price)}}</td>
                          <td class="text-right">{{rupiah($transaction->total)}}</td>
                          <td>
                            @if($transaction->status == "Approved")
                              <span class="badge badge-pill badge-primary">
                                Approved
                              </span>

                            @else
                            <span class="badge badge-pill badge-warning">
                              Draft
                            </span>
                            @endif
                          </td>
                          @if(Auth::user()->role == "apoteker")
                          <td>
                            <div class="btn-group">
                              @if($transaction->status == "Draft")
                                <form action="{{route('dashboard-transaction.destroy', $transaction->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                  <a class="btn btn-warning" href="{{route('dashboard-transaction.edit', $transaction->id)}}" style="margin: 2px; border-radius: 0;" >Edit</a>
                                  <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus data?')" class="btn btn-danger" style="margin: 2px; border-radius: 0;">Delete</button>
                                </form>
                              @endif
                          </div>
                          </td>
                          @endif
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
        
         
      })
  </script>

  
  @endsection