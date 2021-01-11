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
            <h1>Lihat Transaksi Penjualan</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi Penjualan</a></li>
              <li class="breadcrumb-item active">Lihat Transaksi Penjualan</li>
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
                <h3 class="card-title">Detail Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body col-md-12 form_content">
                <div class="col-md-6">
                  @csrf
                  <table>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td>:</td>
                        <td>{{$transaction->users->name}}</td>
                    </tr>
                      <tr>
                          <th>No Transaksi</th>
                          <td>:</td>
                          <td>{{$transaction->no_transaction}}</td>
                      </tr>
                      <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td>{{date('d-m-Y', strtotime($transaction->created_at))}}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>
                            @if($transaction->status == "Approved")
                              <span class="badge badge-pill badge-primary">
                                Approved
                              </span>
                            @endif
                        </td>
                      </tr>
                  </table>
                
                </div>
              <div class="col-md-12" style="margin-top:50px;">
               
                <table class="table table-bordered" style="width: 100%">
                  <thead>
                    <th width="">No</th>
                    <th width="300px">Obat</th>
                    <th width="200px">Harga (Rp)</th>
                    <th width="200px">Jumlah</th>
                    <th width="200px">Sub Total (Rp)</th>
                  </thead>
                  <tbody id="tbody">
                    <?php $no = 1?>
                    @foreach($transaction_detail as $value)
                        <tr class="tr">
                            <td>
                                {{$no}}
                            </td>
                            <td>
                                {{$value->name}}
                            </td>
                            <td align="right">
                                {{rupiah($value->price)}}
                            </td>
                            <td class="text-right">
                                {{$value->qty}}
                            </td>
                            <td align="right">
                                {{rupiah($value->sub_total)}}
                            </td>
                        </tr>
                        <?php $no++?>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      
                      <td colspan="3">

                      </td>
                      <td>
                        <b>Total</b>
                      </td>
                      <td align="right">
                        <b>Rp. </b><b class="grandtotal">{{rupiah($transaction->total)}}</b>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
                </div>
                
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

    
@endsection

