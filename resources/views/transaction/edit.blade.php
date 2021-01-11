@extends('dashboard.helper')
@section('css')
<style>
  input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
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
            <h1>Edit Transaksi</h1>
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
              <li class="breadcrumb-item"><a href="#">Transaksi Penjualan</a></li>
              <li class="breadcrumb-item active">Edit Transaksi</li>
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
                
                    @csrf
                    
                  
                    {{-- <label>Obat</label>
                    <select class="form-control select2" id="obat_id" name="obat" required>
                        <option value=""></option>
                    @foreach ($obat as $item)
                        <option value="{{$item->id}}" >{{$item->name}} ({{$item->plu}})</option>
                    @endforeach
                    </select> --}}
                  <div class="col-md-4">
                      <div class="form-group">
                        <label  >No Transaksi</label>
                      <input type="number" class="form-control input" value="{{$trans->no_transaction}}" id="no_transaksi"  placeholder="No Transaksi" maxlength="10" required  name="no_transaksi" >
                      </div>
                  </div>
                  <div class="col-md-12" style="margin-top:50px;">
                    
                    <table class="table table-bordered" style="width: 100%">
                      <thead>
                        <th width="80px"></th>
                        <th width="300px">Obat</th>
                        <th width="200px">Stock</th>
                        <th width="200px">Harga</th>
                        <th width="200px">Jumlah</th>
                        <th width="200px">Sub Total</th>
                      </thead>
                      <tbody id="tbody">
                        <?php $no =1?>
                        @foreach($trans_detail as $value)
                            <tr class="tr">
                              <td>
                                @if($no > 1)
                                  <button class="btn btn-danger hapus"><i class="fas fa-trash delete"></i></button>
                                @endif
                              </td>
                              <td>
                                <select class="form-control select2 input-table obat" style="width: 100%"  required>
                                  <br>
                                  <option value=""></option>
                                  @foreach ($obat as $item)
                                      <option value="{{$item->id}}"  @if($item->id == $value->obat_id) selected @endif>{{$item->name}} ({{$item->plu}})</option>
                                  @endforeach
                              </select>
                              
                              </td>
                              <td>
                                <input type="text" class="form-control input-table stock" value="{{$value->stock}}" disabled>
                              </td>
                              <td>
                                <input type="text" class="form-control input-table harga" value="{{$value->price}}" disabled>
                              </td>
                              <td>
                                <input type="number" value="{{$value->qty}}" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" maxlength = "10" min="0" class="form-control input-table jumlah" required>
                                <span class="text-red wrong" hidden>Jumlah tidak boleh melebihi Stock</span>
                              </td>
                              <td>
                                <input type="text" class="form-control input-table total" value="{{$value->price * $value->qty}}" disabled>
                              </td>
                            </tr>
                          <?php $no++ ?>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>
                            <button class="btn btn-success tambah-item"><i class="fas fa-plus"></i></button>
                          </td>
                          <td colspan="3">

                          </td>
                          <td>
                            <b>Total</b>
                          </td>
                          <td align="right">
                            <b>Rp. </b><b class="grandtotal">{{$trans->total}}</b>
                          </td>
                        </tr>
                      </tfoot>
                     
                    </table>
                  </div>
                   
            </div>
            
              <div class="card-footer">
                <button type="submit" class="btn btn-primary simpan" name="submit" value="approved">Simpan</button>
                <button type="submit" class="btn btn-warning draft" name="submit" value="draft">Simpan Sebagai Draft</button>
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

        // $(document).ready(function(){
        //   $('form').on('focus', 'input[type=number]', function (e) {
        //     $(this).on('wheel.disableScroll', function (e) {
        //       e.preventDefault()
        //     })
        //   })
        //   $('form').on('blur', 'input[type=number]', function (e) {
        //     $(this).off('wheel.disableScroll')
        //   })
        //   {{--  total harga barang yang akan dibeli  --}}
        //   {{--  bind digunakan ketika ingin mengubah data pada qty  --}}
        //   $('#qty').keyup('input', function(){
        //     if($(this).val() > parseInt($('#stock').val())){
        //       console.log($('#stock').val())
        //       $('.wrong').removeAttr('hidden');
        //       $('.simpan').prop('disabled', true);
        //       $('.draft').prop('disabled', true);
        //     }
        //     else{
        //       $('.wrong').attr('hidden',true);
        //       $('.simpan').prop('disabled', false);
        //       $('.draft').prop('disabled', false);
        //     }
        //     total = $('#price').val() * $('#qty').val();
        //     $('#total').val(total);
        //   });
        //   $('.simpan, .draft').one('click', function (event) {
        //     console.log($('.form-control').val())
        //     if($('.form').val() != ""){
        //       toastr.success("Success");
        //     }
            
        //   })
        //   /// matiin scroll input
        //   $('.form').on('focus', 'input[type=number]', function (e) {
        //     $(this).on('wheel.disableScroll', function (e) {
        //       e.preventDefault()
        //     })
        //   })
        //   $('.form').on('blur', 'input[type=number]', function (e) {
        //     $(this).off('wheel.disableScroll')
        //   })
        //   ///
        // });
        $(document).ready(function(){
          jml = $('.jumlah');
          $.each(jml,function(k,value){
            var row = $(value).closest('.tr');
            stok = $(row).find('.stock');
            wrong = $(row).find('.wrong');
            if(parseInt($(value).val()) > parseInt($(stok).val())){
              $(wrong).removeAttr('hidden');
              $('.simpan').prop('disabled', true);
              $('.draft').prop('disabled', true);
            }
          })
          $('.tambah-item').click(function(){
            $('#tbody').append(`
                  <tr class="tr">
                      <td>
                        <button class="btn btn-danger hapus"><i class="fas fa-trash delete"></i></button>
                      </td>
                      <td>
                          <select class="form-control select2 input-table obat" style="width: 100%"  required>
                            <br>
                            <option value=""></option>
                            @foreach ($obat as $item)
                                <option value="{{$item->id}}" >{{$item->name}} ({{$item->plu}})</option>
                            @endforeach
                        </select>
                            
                      </td>
                      <td>
                        <input type="text" class="form-control input-table stock" disabled>
                      </td>
                      <td>
                        <input type="text" class="form-control input-table harga" disabled>
                      </td>
                      <td>
                        <input type="number" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" maxlength = "10" min="0" class="form-control input-table jumlah" disabled required>
                        <span class="text-red wrong" hidden>Jumlah tidak boleh melebihi Stock</span>
                      </td>
                      <td>
                        <input type="text" class="form-control input-table total" disabled>
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
          $(document).on('change', '.obat', function() {
            
            var row = $(this).closest('.tr');
            stok = $(row).find('.stock');
            harga = $(row).find('.harga');
            jumlah = $(row).find('.jumlah');
            total = $(row).find('.total');
            wrong = $(row).find('.wrong');
            $(wrong).attr('hidden',true);
            $('.simpan').prop('disabled', false);
            $('.draft').prop('disabled', false);
            var obat_id = $(this).val();
            var url = "{{url('dashboard-obat-get')}}/"+ obat_id;
            if(obat_id){
                jQuery.ajax({
                    url: url,
                    type :"GET",
                    dataType : "json",
                    success:function(data){
                     $(harga).val(data.price);
                     $(stok).val(data.stock);
                     $(jumlah).prop('disabled',false);
                     $(jumlah).val('');
                     $(total).val(0);
                     var gt = 0;
                      alltotal = $('.total');
                      $.each(alltotal,function(k,value){
                        gt += parseInt(value.value);
                      });
                      $('.grandtotal').text(gt);
                    }
                  });

             }
          })

          $(document).on('keyup', '.jumlah', function() {
            var row = $(this).closest('.tr');
            stok = $(row).find('.stock');
            total = $(row).find('.total');
            harga = $(row).find('.harga');
            wrong = $(row).find('.wrong');
            if($(this).val() > parseInt($(stok).val())){
              $(wrong).removeAttr('hidden');
              $('.simpan').prop('disabled', true);
              $('.draft').prop('disabled', true);
            }
            else{
              $(wrong).attr('hidden',true);
              $('.simpan').prop('disabled', false);
              $('.draft').prop('disabled', false);
            }
            a = $(harga).val() * $(this).val();
            $(total).val(a);

            var gt = 0;
            alltotal = $('.total');
            $.each(alltotal,function(k,value){
              gt += parseInt(value.value);
            });
            $('.grandtotal').text(gt);
          })
         
        })
        

        $('.simpan').click(function(){
           save(1);
        })

        $('.draft').click(function(){
           save(0);
        })

        function save(save){
          var checkrequired = $('input,textarea,select').filter('[required]:visible')
            var isValid = true;
            $(checkrequired).each( function() {
                    if ($(this).parsley().validate() !== true) isValid = false;
            });
            if(!isValid){
                return;
            }

            urlsnya = '{{route('dashboard-transaction.update',$trans->id)}}';
            _token = $('.form_content').find('input[name=_token]').val();
            form = $('.form_content').find('#no_transaksi');
            subform_row = $('#tbody').find('.tr');
            no_transaction = $(form).val();
            var item= [];
            $.each(subform_row,function(k,value){
            subform_value = $(this).find('.input-table');
            console.log(subform_value)
                item.push({
                    'obat': subform_value[0].value,
                    'price': subform_value[2].value,
                    'qty': subform_value[3].value,
                    'total': subform_value[4].value,
                });
            });
            $.ajax({
            type: 'PUT',
            dataType: 'json',
            data: {_token:_token, no_transaction:no_transaction, save:save, item:item},
            url: urlsnya,
            })
            .done(function(response) {
              if(response == 1){
                toastr.success("Success")
                url = "{{ route('dashboard-transaction.index')}}";
                window.location.replace(url);
              }
              else if(response == 2){
                $.alert("No Transaksi sudah pernah digunakan");
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
        }

        //   function obat_get(){
        //     console.log($(this));
        //     var obat_id = $('#obat_id').val();
        //     var url = "{{url('dashboard-obat-get')}}/"+ obat_id;
        //     if(obat_id){
        //         jQuery.ajax({
        //             url: url,
        //             type :"GET",
        //             dataType : "json",
        //             success:function(data){
        //              $('#price').val(data.price);
        //              $('#stock').val(data.stock);
        //              $('#qty').prop('disabled',false);
        //              total = $('#price').val() * $('#qty').val();
        //              $('#total').val(total);
        //             }
        //           });
        //      }
        // }
      </script>
@endsection

