@extends('layouts.master')
@section('title', 'Sorova - Hitung Data SDI')
@section('content')
                <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Card -->
                        <div class="card">
                            <h5 class="card-header">Form Data SDI</h5>

                            <div class="card-body">
                                <form method="POST" id="formSta" class="row g-3">
                                @csrf
                                <div class="col-auto" id="topField1">
                                    <label for="stationing" class="col-xs-2 col-form-label">
                                        <strong class="text-muted">Stationing</strong>
                                    </label>                                     
                                    <select data-placeholder="Pilih ..." class="standardSelect" name="stationing" id="stationing" tabindex="1">
                                        <option>Pilih ...</option>
                                        @foreach ($dataSta as $rowSta)
                                        <option value="{{$rowSta->nama_sta}}" data-value="{{$rowSta->nama_sta}}">{{substr_replace($rowSta->nama_sta, '+', 1, 0)}}</option>
                                        @endforeach
                                    </select>
                                    @foreach($dataSta as $rowData)
                                    @endforeach
                                    <input type="hidden" name="id_data_detail" value="{{$rowData->id_data}}"/>
                                </div>
                                <div class="col-auto" id="topField2">
                                    <label for="segmen" class="col-xs-2 offset-md-1 col-form-label">
                                        <strong class="text-muted">Segmen</strong>
                                    </label>                                     
                                    <input id="segmen" min="1" name="segmen" placeholder="0" type="number" class="form-control form-control-sm" required="required">
                                </div>
                                <div class="col-auto" id="topField3">
                                    <label for="s" class="col-xs-2 offset-md-1 col-form-label">
                                        <strong class="text-muted">Confirm</strong>
                                    </label>                                        
                                    <button id="addRow" type="button" class="btn btn-sm btn-primary">
                                    <span class="tf-icons bx bx-plus-circle"></span> ADD
                                    </button>                                
                                </div>

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
                                                <div class="col-md-7 mt-3 g-2">
                                                    <p id="infoRes" style="display:none;">Semua data berhasil disimpan. Klik untuk melihat hasil perhitungan.</p>
                                                    <button type="submit" style="display: none;" name="save" id="save" class="btn btn-block btn-primary">
                                                        <span class="tf-icons bx bx-save"></span> SIMPAN
                                                    </button>
                                                    <di class="me-3"></di>
                                                    <a href="{{route('data-primer.sdi.result',$idData)}}" id="checkRes" class="btn btn-block btn-success" style="display:none;">
                                                        <span class="tf-icons bx bx-list-check"></span> RESULT
                                                    </a>
                                                </div>
                                       </div>
                                <!--end body content-->
                                </form>
                            </div>
                            <!-- Toast with Placements -->
                            <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true"data-delay="2000">
                                <div class="toast-header">
                                <i class="bx bx-bell me-2"></i>
                                <div class="me-auto fw-semibold">Informasi</div>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">Data STA : <strong id="staname"></strong> telah berhasil disimpan.</div>
                            </div>
                            <!-- Toast with Placements -->
                            <!--trigger toast with button-->
                                <button id="showToastPlacement" type="button" style="display: none;">+</button>
                                <input type="hidden" id="selectTypeOpt" value="bg-success"/>
                                <input type="hidden" id="selectPlacement" value="top-0 start-50 translate-middle-x"/>
                            <!-- end trigger -->

                        </div>
                        <!--/ Card -->
                </div>
        
@endsection

@push('custom-scripts')
<script>
  var $ = jQuery.noConflict();
  $(document).ready(function() {
        $('#stationing').on('change',function(e){
            e.preventDefault();
            var sta = $(this).children('option:selected').data('value');
            $('#id_sta').val(sta);
            $("#staname").text(sta);                        
        });
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
            $("#addedFields").append('<tr><td><input type="hidden" value="" id="id_sta" name="id_sta[' + row_i + ']"/><input class="form-control form-control-sm" id="panjang" placeholder="Panjang (m)" name="panjang[' + row_i + ']" required onkeypress="return isNumberKey(event,this)"/></td><td><input class="form-control form-control-sm" id="lebar" placeholder="Lebar (m)" name="lebar[' + row_i + ']" required onkeypress="return isNumberKey(event,this)"/></td> <td><input class="form-control form-control-sm" id="jumlah_lubang" value="0" name="jumlah_lubang[' + row_i + ']" required onkeypress="return isNumberKey(event,this)"/></td><td><input class="form-control form-control-sm" id="bekas_roda" value="0" name="bekas_roda[' + row_i + ']" required onkeypress="return isNumberKey(event,this)"/></td><td><input class="form-control form-control-sm" id="lebar_retak" placeholder="0 mm" name="lebar_retak[' + row_i + ']" value="0" required onkeypress="return isNumberKey(event,this)"/></td><td><button class="btn btn-sm btn-danger remove-field" href=""><i class="tf-icons bx bx-trash-alt"></i></button></td></tr>');
            $('#save').show();
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

        $('#formSta').on('submit', function(e){

            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'{{ route("data-primer.sdi.save") }}',
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
                        $('#jumlah_lubang').val('0');
                        $('#bekas_roda').val('0');
                        $('#lebar_retak').val('0');                        
                        $('#segmen').val('1');
                        $('#showToastPlacement').click();
                    }
                    $('#save').attr('disabled', false);
                    var selVal = $('#stationing option:selected').val();
                    $('select').children('option[value="' + selVal + '"]').remove();
                    $('#stationing option').trigger('chosen:updated');
                    var checkLastRow = $('#stationing option').length;
                    if (checkLastRow < 2){
                        $('#checkRes').show();
                        $('#save').attr('disabled','disabled');
                        $('#addRow').attr('disabled','disabled');
                        $('#segmen').attr('disabled','disabled');
                        $('#topField1').hide();
                        $('#topField2').hide();
                        $('#topField3').hide();
                        $('#save').hide();
                        $('#addedFields').hide();
                        $('#infoRes').show();
                    }
                }
            })
        });


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

<script>
    function isNumberKey(evt, element) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
        return false;
    else {
        var len = $(element).val().length;
        var index = $(element).val().indexOf('.');
        if (index > 0 && charCode == 46) {
        return false;
        }
        if (index > 0) {
        var CharAfterdot = (len + 1) - index;
        if (CharAfterdot > 3) {
            return false;
        }
        }

    }
    return true;
    }
</script>
@endpush