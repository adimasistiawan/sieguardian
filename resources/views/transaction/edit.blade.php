@extends('dashboard.helper')

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
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
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
              <div class="card-body col-md-6">
                <form method="post" action="{{route('dashboard-transaction.update',$trans->id)}}">
                    @csrf
                    @method('PUT')
                  <div class="form-group">
                    <label  >Dibuat Oleh</label>
                    <h6>{{$trans->users->name}}</h6>
                  </div>
                    <div class="form-group">
                    <label>Obat</label>
                    <select class="form-control select2" onchange="obat_get()" id="obat_id" name="obat" required>
                        
                    @foreach ($obat as $item)

                        <option value="{{$item->id}}" @if($item->id == $trans->obat_id) selected @endif>{{$item->name}} ({{$item->plu}})</option>
                    @endforeach
                    </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                  <input type="text" class="form-control"  id="price" placeholder="Price" value="{{$trans->price}}" required readonly name="price" min="0" > 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Stock</label>
                    <input type="text" class="form-control"  id="stock" placeholder="Stock" value="{{$trans->stock}}" required readonly name="stock" min="0" >
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" >Quantity</label>
                    <input type="number" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" id="qty"  placeholder="Quantity" required value="{{$trans->qty}}"  name="qty" min="1" >
                    <span class="text-red wrong" hidden>Quantity tidak boleh melebihi Stock</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Total Price</label>
                    <input type="text" class="form-control" id="total" placeholder="Total Price" required readonly name="total" min="0" >
                  </div>  
            </div>
            
              <div class="card-footer">
                <button type="submit" class="btn btn-primary simpan" name="submit" value="approved">Simpan</button>
                <button type="submit" class="btn btn-warning draft" name="submit" value="draft">Simpan Sebagai Draft</button>
                <span class="text-red notif" hidden>Stock telah habis</span>
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

    <script type="text/javascript">

        $(document).ready(function(){
          $('form').on('focus', 'input[type=number]', function (e) {
              $(this).on('wheel.disableScroll', function (e) {
                e.preventDefault()
              })
            })
            $('form').on('blur', 'input[type=number]', function (e) {
              $(this).off('wheel.disableScroll')
            })
            $('#total').val(parseInt($('#price').val()) *parseInt($('#qty').val()))
            if(parseInt($('#stock').val()) == 0){
                console.log($('#stock').val())
                $('#obat_id').append($('<option>', {
                    value: 1,
                    text: '{{$trans->obat_name}}',
                    selected:true
                }));
              $('#obat_id').prop('disabled', true);
              $('#qty').prop('disabled', true);
              $('.notif').removeAttr('hidden');
              $('.simpan').prop('disabled', true);
              $('.draft').prop('disabled', true);
            }

            if($('#qty').val() > parseInt($('#stock').val()) && parseInt($('#stock').val()) != 0){
                $('.wrong').removeAttr('hidden');
              $('.simpan').prop('disabled', true);
              $('.draft').prop('disabled', true);
            }
          $('.simpan, .draft').click(function(){
            toastr.success("Success");
          })
          {{--  total harga barang yang akan dibeli  --}}
          {{--  bind digunakan ketika ingin mengubah data pada qty  --}}
          $('#qty').keyup('input', function(){
            if($(this).val() > parseInt($('#stock').val())){
              
              $('.wrong').removeAttr('hidden');
              $('.simpan').prop('disabled', true);
              $('.draft').prop('disabled', true);
            }
            else{
              $('.wrong').attr('hidden',true);
              $('.simpan').prop('disabled', false);
              $('.draft').prop('disabled', false);
            }
            total = $('#price').val() * $('#qty').val();
            $('#total').val(total);
          });
        });
        function obat_get(){
            var obat_id = $('#obat_id').val();
            var url = "{{url('dashboard-obat-get')}}/"+ obat_id;
            if(obat_id){
                jQuery.ajax({
                    url: url,
                    type :"GET",
                    dataType : "json",
                    success:function(data){
                      {{--  $('select[name = "country_destination"]').empty();  --}}
                     $('#price').val(data.price);
                     $('#stock').val(data.stock);
                     $('#qty').prop('disabled',false);
                     total = $('#price').val() * $('#qty').val();
                     $('#total').val(total);
                    }
                  });
             }
        }
      </script>
@endsection

