@extends('dashboard.helper')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Kategori</a></li>
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
              <div class="card-header">
                <button class="btn btn-primary"  data-toggle="modal" data-target="#modal-default" >
                  <i class="fas fa-edit btn-xs" ></i> Tambah Data
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1?>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                          @if($category->status == "active")
                              <span class="badge badge-pill badge-primary">
                                Active
                              </span>
                            @else
                            <span class="badge badge-pill badge-danger">
                              Non Active
                            </span>
                            @endif
                        </td>
                        <td>
                          <div class="btn-group">
                              <form action="{{route('dashboard-category.destroy', $category->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default{{$category->id}}" style="margin: 2px; border-radius: 0;" >Edit</button>
                                
                              </form>
                          </div>
                        </td>
                      </tr>
                      <?php $no++?>
                    @endforeach
                  </tbody>
                </table>
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

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kategori</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('dashboard-category.store')}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Name" name="name" required>
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
@foreach ($categories as $category)
<div class="modal fade" id="modal-default{{$category->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Kategori</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('dashboard-category.update',$category->id )}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" value="{{$category->name}}" name="name" required>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" style="width: 100%;" name="status" required >
                    <option value="active"  @if("active" == $category->status) selected @endif>Active</option>
                    <option value="nonactive"  @if("nonactive" == $category->status) selected @endif>Non Active</option>
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
    <!-- /.modal-dialog -->
  <!-- /.modal -->  
@endforeach

<script>
  $(document).ready(function(){
       @if(session()->has('success'))
            toastr.success("{{session('success')}}")
            
       @endif
    })
</script>

@endsection