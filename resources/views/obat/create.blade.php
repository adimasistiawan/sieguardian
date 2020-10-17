@extends('dashboard.helper')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Obat</h1>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session('success')}}</div>
            @elseif(count($errors) > 0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{$error}}</div>
                @endforeach
            @endif
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Obat</li>
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
                <h3 class="card-title">Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('dashboard-obat.store')}}">
                  @csrf
                <div class="card-body col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Plu</label>
                        <input type="number" class="form-control" placeholder="Enter Your Plu Obat" name="plu" required>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name Obat" name="name" required>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" style="width: 100%;" name="category" required>
                      <option value="">Select Category</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->name}}">{{$category->name}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" style="width: 100%;" name="satuan" required>
                      <option value="">Select Satuan</option>
                      @foreach ($satuan as $value)
                        <option value="{{$value->name}}">{{$value->name}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input type="number" class="form-control" placeholder="Stock Obat" name="stock" required>
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Expiry Date</label>
                    <input type="date" class="form-control" placeholder="ExpiryDate Obat" name="expirydate" required>
                  </div> --}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="number" class="form-control" placeholder="Price Obat" name="price" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
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

