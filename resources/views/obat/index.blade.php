@extends('dashboard.helper')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Obat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Obat</a></li>
              
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
              @if(Auth::user()->role == "apoteker")
              <div class="card-header"  >
                
                <button class="btn btn-primary"  data-toggle="modal" data-target="#modal-default" >
                  <i class="fas fa-edit btn-xs" ></i> Tambah Data
                </button>
              </div>
              @endif
            
                
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>PLU</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Satuan</th>
                      <th>Stock</th>
                      <th>Price (Rp)</th>
                      <th>Status</th>
                      @if(Auth::user()->role == "apoteker")
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                   
                      <?php $no = 1?>
                    @foreach ($obat as $item)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->plu}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->satuan}}</td>
                        <td class="text-right">{{$item->stock}}</td>
                        <td class="text-right">{{rupiah($item->price)}}</td>
                        
                        <td>
                          @if($item->status == "active")
                              <span class="badge badge-pill badge-primary">
                                Active
                              </span>
                            @else
                            <span class="badge badge-pill badge-danger">
                              Non Active
                            </span>
                            @endif
                        </td>
                        @if(Auth::user()->role == "apoteker")
                        <td>
                            <div class="btn-group">
                                <form action="{{route('dashboard-obat.destroy', $item->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default{{$item->id}}" style="margin: 2px; border-radius: 0;" >Edit</button>
                                  {{-- <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus data?')" class="btn btn-danger" style="margin: 2px; border-radius: 0;">Delete</button> --}}
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <?php $no++?>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Obat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('dashboard-obat.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">PLU</label>
                    <input type="number" class="form-control" placeholder="Plu" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" name="plu" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Name" name="name" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" style="width: 100%;" name="category" required >
                      <option value="">Select Category</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                            
                            >
                            {{$category->name}}
                        </option>
                     @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                  <label>Satuan</label>
                  <select class="form-control" style="width: 100%;" name="satuan" required >
                    <option value="">Select Satuan</option>
                    <option value="Box">Box</option>
                    <option value="Strip">Strip</option>
                    <option value="Tube">Tube</option>
                    <option value="Botol">Botol</option>
                  </select>
              </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input type="number" class="form-control" placeholder="Stock" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required  name="stock" >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price </label>
                    <input type="number" class="form-control" placeholder="Price" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required name="price" >
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" style="width: 100%;" name="status" required >
                    <option value="active">Active</option>
                    <option value="nonactive">Non Active</option>
                  </select>
              </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>  
      </div>
      <!-- /.modal-content -->
    </div>
  
{{--  modal  --}}
@foreach ($obat as $item)
<div class="modal fade" id="modal-default{{$item->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Obat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('dashboard-obat.update',$item->id )}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">PLU</label>
                    <input type="number" class="form-control" placeholder="Plu" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" value="{{$item->plu}}" name="plu" required >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Name" value="{{$item->name}}" name="name" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" style="width: 100%;" name="category" required>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                            @if ($category->id == $item->category_id)
                                selected
                            @endif
                            >
                            {{$category->name}}
                        </option>
                     @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label>Satuan</label>
                  <select class="form-control" style="width: 100%;" name="satuan" required>
                    <option value="">Select Satuan</option>
                    <option value="Box" @if("Box" == $item->satuan) selected @endif>Box</option>
                    <option value="Strip" @if("Strip" == $item->satuan) selected @endif>Strip</option>
                    <option value="Tube" @if("Tube" == $item->satuan) selected @endif>Tube</option>
                    <option value="Botol" @if("Botol" == $item->satuan) selected @endif>Botol</option>
                  </select>
              </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input type="number" class="form-control" placeholder="Stock" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" value="{{$item->stock}}" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price </label>
                    <input type="number" class="form-control" placeholder="Price" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" value="{{$item->price}}" name="price" required>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" style="width: 100%;" name="status" required >
                    <option value="active"  @if("active" == $item->status) selected @endif>Active</option>
                    <option value="nonactive"  @if("nonactive" == $item->status) selected @endif>Non Active</option>
                  </select>
              </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>  
      </div>
      <!-- /.modal-content -->
    </div>
  <!-- /.modal -->  
@endforeach

<script>
  $(document).ready(function(){
       @if(session()->has('success'))
            toastr.success("{{session('success')}}")
      
            
       @endif

       @if(session()->has('error'))
       $.alert("{{session('error')}}")
       @endif
    })
</script>
@endsection