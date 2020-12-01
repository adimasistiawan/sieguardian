@extends('dashboard.helper')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Akun User</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Akun User</a></li>
              
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
                  <i class="fas fa-edit btn-xs" ></i> Tambah Akun
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1?>
                    @foreach ($user as $value)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->username}}</td>
                        <td>
                            @if($value->role == "kepalatoko")
                                Kepala Toko
                            @else
                                Apoteker
                            @endif
                        </td>
                        <td>
                          @if($value->status == "active")
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
                              <form action="{{route('akun-user.destroy', $value->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                <button type="button" class="btn btn-warning edit" data-toggle="modal" data-target="#modal-default{{$value->id}}" style="margin: 2px; border-radius: 0;" >Edit</button>
                                {{-- @if($value->role != "kepalatoko")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus data?')" style="margin: 2px; border-radius: 0;">Delete</button>
                                @endif --}}
                                
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
          <h4 class="modal-title">Tambah Akun</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('akun-user.store')}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                {{-- <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" style="width: 100%;" name="role" required >
                      <option value="">Select Role</option>
                      <option value="apoteker">Apoteker</option>
                      <option value="Strip">Strip</option>
                      <option value="Tube">Tube</option>
                      <option value="Botol">Botol</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
                  </div>
                  
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn_submit">Simpan</button>
              </div>
            </form>
        </div>  
      </div>
      <!-- /.modal-content -->
    </div>

{{--  modal  --}}
@foreach ($user as $value)
<div class="modal fade" id="modal-default{{$value->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Akun</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('akun-user.update',$value->id )}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" value="{{$value->name}}" name="name" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{$value->username}}" required>
                </div>
                @if($value->role != "kepalatoko")
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" style="width: 100%;" name="status" required >
                    <option value="active"  @if("active" == $value->status) selected @endif>Active</option>
                    <option value="nonactive"  @if("nonactive" == $value->status) selected @endif>Non Active</option>
                  </select>
                </div>
                @endif
                <a id="" href="#" class="text-blue change_password" style="width:100%">Ubah Password</a>
                <a id="" class="text-red batal" href="#" style="width:100%" hidden>Batal Ubah Password</a>
                <div class="formpassword">

                </div>
                
              </div>
              
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn_submit2">Simpan</button>
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
   
    
        $('.change_password').click(function(){
            $('.formpassword').append(`
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control Password2" id="" placeholder="Password" name="password" required>
                  </div>
                
            `)
            $('.batal').removeAttr('hidden');
            $(this).attr('hidden',true);
            
        })
        $('.batal').click(function(){
            $('.formpassword').empty();
            $('.change_password').removeAttr('hidden');
            $(this).attr('hidden',true);
        })

        
        $('.edit').click(function(){
            $('.formpassword').empty();
            $('.change_password').removeAttr('hidden');
            $('.batal').attr('hidden',true);
        })
    })
</script>

@endsection