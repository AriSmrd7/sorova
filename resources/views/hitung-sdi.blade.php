@extends('layouts.master')
@section('title', 'Sorova - Hitung Data SDI')
@section('content')
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Hitung Data SDI</strong>
                            </div>
                            <div class="card-body">
                            <form method="POST" id="formSta">
                            @csrf
                                <!--head content-->
                                <div class="form-group row col-md-12">
                                    <label for="stationing" class="col-xs-2 col-form-label">
                                        <strong class="text-muted">Stationing</strong>
                                    </label> 
                                    <div class="col-sm-4 mt-1">
                                        <select data-placeholder="Pilih ..." class="standardSelect" name="stationing" id="stationing" tabindex="1">
                                            @foreach ($dataSta as $rowSta)
                                            <option value="{{$rowSta->nama_sta}}" data-value="{{$rowSta->nama_sta}}">{{substr_replace($rowSta->nama_sta, '+', 1, 0)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="segmen" class="col-xs-2 offset-md-1 col-form-label">
                                        <strong class="text-muted">Segmen</strong>
                                    </label> 
                                    <div class="col-sm-2 mt-1 mb-2">
                                        <input id="segmen" min="1" name="segmen" placeholder="0" type="number" class="form-control form-control-sm" required="required">
                                    </div>
                                    <div class="col-sm-2 mt-1">
                                        <button id="addRow" type="button" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                                <!--end head content-->

                                <!--body content-->
                                        <div class="row col-md-12 mb-2 mt-5">

                                         <span id="result"></span>
                                            <table class="table" style="table-layout: auto;"  id="addedFields"> 
                                                <thead>
                                                    <tr>
                                                    <td colspan="2" class="text-muted">Luas Retak (m<sup>2</sup>)</td>
                                                    <td class="text-muted">Jumlah Lubang</td>
                                                    <td class="text-muted">Bekas Roda (cm)</td>
                                                    <td class="text-muted">Lebar Retak (mm)</td>
                                                    <td class="text-muted">#</td>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                                       </div>
                                <!--end body content-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
@endsection

@push('custom-scripts')
<script>
  var $ = jQuery.noConflict();
  $(document).ready(function() {

        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });

        var row_i = 0;
        function emptyRow(){
            row_i++;
            $("#addedFields").append('<tr><td><input type="hidden" value="120" id="id_sta" name="id_sta[' + row_i + ']"/><input class="form-control form-control-sm" id="panjang" placeholder="Panjang (m)" name="panjang[' + row_i + ']" required/></td><td><input class="form-control form-control-sm" id="lebar" placeholder="Lebar (m)" name="lebar[' + row_i + ']" required/></td> <td><input class="form-control form-control-sm" id="jumlah_lubang" placeholder="0" name="jumlah_lubang[' + row_i + ']" required/></td><td><input class="form-control form-control-sm" id="bekas_roda" value="0" name="bekas_roda[' + row_i + ']" required/></td><td><input class="form-control form-control-sm" id="lebar_retak" placeholder="0 mm" name="lebar_retak[' + row_i + ']" required/></td><td><button class="btn btn-sm btn-danger remove-field" href=""><i class="fa fa-times text-light"></i></button></td></tr>');
        }

        function refresh(new_count) {
        var old_count = parseInt($('tbody').children().length);
        var rows_difference = parseInt(new_count) - old_count;
            if (rows_difference > 0)
            {
                for(var i = 0; i < rows_difference; i++)
                    $('tbody').append((new emptyRow()).obj);
            }
            else if (rows_difference < 0)//we need to remove rows ..
            {
                var index_start = old_count + rows_difference + 1;          
                $('tr:gt('+index_start+')').remove();
                row_i += rows_difference;
            }
        }

        $('#addRow').on('click', function() {
            var seg = $('#segmen').val();
            refresh(seg);
            $('#result').remove();
        });

        $(document).on('click', '.remove-field', function () {            
            $(this).parents('tr').remove();
        });

        $('#panjang').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });

        $('#lebar').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });

        $('#lubang').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });

        $('#bekas').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });

        $('#retak').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });


        $('#formSta').on('submit', function(e){
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'{{ route("data-sdi.hitung.save") }}',
                method:'post',
                data:formdata,
                dataType:'json',
                beforeSend:function(){
                    $('#save').attr('disabled','disabled');
                },
                success:function(data)
                {
                    if(data.error)
                    {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<p>'+data.error[count]+'</p>';
                        }
                        warningAdd();
                    }
                    else
                    {
                        refresh(0);
                        $('#id_sta').val('');
                        $('#panjang').val('');
                        $('#lebar').val('');
                        $('#jumlah_lubang').val('');
                        $('#bekas_roda').val('');
                        $('#lebar_retak').val('');                        
                        $('#segmen').val('1');                        
                        successAdd()
                    }
                    $('#save').attr('disabled', false);
                    var selVal = $('#stationing option:selected').val();
                    $('select').children('option[value="' + selVal + '"]').remove();
                    $('#stationing option').trigger('chosen:updated');
                }
            })
        });

        function successAdd(){
          Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Data Stationing berhasil disimpan',
              showConfirmButton: true,
              confirmButtonColor: '#3085d6'
            })  
        }

        function warningAdd(){
          Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Error',
              text: 'Data gagal disimpan!',
              showConfirmButton: true,
              confirmButtonColor: '#3085d6'
            })  
        }

    });

</script>
@endpush