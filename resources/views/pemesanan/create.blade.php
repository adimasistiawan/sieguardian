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
            <h1>Buat Pemesanan</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pemesanan</a></li>
              <li class="breadcrumb-item active">Buat Pemesanan</li>
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
              <div class="card-body col-md-12 form_content">
                <div class="col-md-4">
                  @csrf
                  <div class="form-group">
                    <label  >No Invoice</label>
                    <input type="text" class="form-control input" id="no_invoice"  placeholder="No Invoice" maxlength="10" required  name="no_invoice" >
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pemesanan</label>
                    <input type="date" class="input"  name="date" required>
                  </div> 
                  {{-- <div class="form-group">
                    <label>Status</label>
                    <select class="form-control input" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Received">Received</option>
                    </select>
                  </div> --}}
                   
              </div>
              <div class="col-md-12" style="margin-top:50px;">
                
                <table class="table table-bordered" style="width: 100%">
                  <thead>
                    <th width="80px"></th>
                    <th width="300px">Obat</th>
                    <th width="200px">Jumlah</th>
                    <th>Keterangan</th>
                  </thead>
                  <tbody id="tbody">
                    
                      <tr class="tr">
                        <td>
                          {{-- <button class="btn btn-danger"><i class="fas fa-trash delete"></i></button> --}}
                        </td>
                        <td>
                          <select class="form-control select2 input-table"  required>
                            <br>
                            <option value=""></option>
                            @foreach ($obat as $item)
                                <option value="{{$item->id}}" >{{$item->name}} ({{$item->plu}})</option>
                            @endforeach
                        </select>
                        
                        </td>
                        <td>
                          <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0" class="form-control input-table" required>
                        </td>
                        <td>
                          <input type="text" class="form-control input-table">
                        </td>
                      </tr>
                      
                    
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <td>
                        <button class="btn btn-success tambah-item"><i class="fas fa-plus"></i></button>
                      </td>
                      
                    </tr>
                  </tfoot>
                 
                </table>
              </div>
            
              <div class="card-footer">
                <button type="submit" class="btn btn-primary simpan" name="submit" value="approved">Simpan</button>
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

    <script type="text/javascript">

        $(document).ready(function(){
          $('.tambah-item').click(function(){
            $('#tbody').append(`
            <tr class="tr">
                      <td>
                        <button class="btn btn-danger hapus"><i class="fas fa-trash delete"></i></button>
                      </td>
                      <td>
                        <select  class="form-control input-table select2"   required>
                          <option value=""></option>
                          @foreach ($obat as $item)
                              <option value="{{$item->id}}" >{{$item->name}} ({{$item->plu}})</option>
                          @endforeach
                      </select>
                        
                      </td>
                      <td>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0" class="form-control input-table" required>
                      </td>
                      <td>
                        <input type="text" class="form-control input-table">
                      </td>
                    </tr>
            `)
            $('.select2').select2({
              placeholder: "Select"
            })
          })

          $(document).on('click', '.hapus', function() {
            $(this).closest('.tr').remove();
          })

          $('.simpan').click(function(){
            var checkrequired = $('input,textarea,select').filter('[required]:visible')
            var isValid = true;
            $(checkrequired).each( function() {
                    if ($(this).parsley().validate() !== true) isValid = false;
            });
            if(!isValid){
                return;
            }

            urlsnya = '{{route('pemesanan.store')}}';
            _token = $('.form_content').find('input[name=_token]').val();
            form = $('.form_content').find('.input');
            subform_row = $('#tbody').find('.tr');
            var arr= {};
            var item= [];
            $.each(form,function(k,value){
                arr[value.name] = value.value;
            });
            $.each(subform_row,function(k,value){
            subform_value = $(this).find('.input-table');
            console.log(subform_value)
                item.push({
                    'obat': subform_value[0].value,
                    'qty': subform_value[1].value,
                    'keterangan':subform_value[2].value,
                });
            });
            $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {_token:_token, arr:arr, item:item},
            url: urlsnya,
            })
            .done(function(response) {
              if(response == 1){
                toastr.success("Success")
                url = "{{ route('pemesanan.index')}}";
                window.location.replace(url);
              }
              else if(response == 2){
                $.alert("No Invoice sudah pernah digunakan");
              }
              else{
                return;
              }
              
            })
            .fail(function(){
              $.alert("error");
              return;
            })
            .always(function() {
                
                console.log("complete");
            });
            
          })
        });
      </script>
@endsection

