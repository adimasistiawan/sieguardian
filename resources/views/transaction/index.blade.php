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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
                  <a class="btn btn-primary" href="{{route('dashboard-transaction.create')}}">
                    <i class="fas fa-edit btn-xs" ></i> Tambah Transaksi
                </a>
                  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no =1?>
                    @foreach ($transactions as $transaction)
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{date('d-m-Y', strtotime($transaction->created_at))}}</td>
                          <td>{{$transaction->obat_name}}</td>
                          <td>{{$transaction->qty}}</td>
                          <td>{{rupiah($transaction->price)}}</td>
                          <td>{{rupiah($transaction->total)}}</td>
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
         @if(session()->has('success'))
              toastr.success("{{session('success')}}")
              
         @endif
         
      })
  </script>

  
  @endsection