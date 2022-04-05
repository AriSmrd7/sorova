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
                                <!--head content-->
                                <div class="form-group row col-md-12">
                                    <label for="stationing" class="col-xs-2 col-form-label">
                                        <strong class="text-muted">Stationing</strong>
                                    </label> 
                                    <div class="col-sm-4">
                                        <select name="stationing" id="stationing" class="form-control">
                                            <option disabled selected>Pilih stationing...</option>
                                            <option value="">5+000</option>
                                            <option value="">5+100</option>
                                            <option value="">5+200</option>
                                            <option value="">5+300</option>
                                            <option value="">5+400</option>
                                            <option value="">5+500</option>
                                            <option value="">5+600</option>
                                            <option value="">5+700</option>
                                            <option value="">5+800</option>
                                            <option value="">5+900</option>
                                        </select>
                                    </div>
                                    <label for="segmen" class="col-xs-2 offset-md-1 col-form-label">
                                        <strong class="text-muted">Segmen</strong>
                                    </label> 
                                    <div class="col-sm-2">
                                        <input id="segmen" min="1" name="segmen" placeholder="0" type="number" class="form-control" required="required">
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="addRow" type="button" class="btn btn-primary">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                                <!--end head content-->

                                <!--body content-->
                                        <div class="row col-md-12 mb-2 mt-5">
                                        <form method="POST" id="formSta">
                                         @csrf
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
                                                    <tfoot>
                                                    <tr>
                                                        <td>
                                                        <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </form>
                                       </div>
                                <!--end body content-->
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

        var row_i = 0;
        function emptyRow(){
            row_i++;
            $("#addedFields").append('<tr><td><input type="hidden" name="id_sta[' + row_i + ']" value="12"/><input class="form-control form-control-sm" id="panjang" placeholder="Panjang (m)" name="panjang[' + row_i + ']" required/></td><td><input class="form-control form-control-sm" id="lebar" placeholder="Lebar (m)" name="lebar[' + row_i + ']" required/></td> <td><input class="form-control form-control-sm" id="jumlah_lubang" placeholder="0" name="jumlah_lubang[' + row_i + ']" required/></td><td><input class="form-control form-control-sm" id="bekas_roda" value="0" name="bekas_roda[' + row_i + ']" required/></td><td><input class="form-control form-control-sm" id="lebar_retak" placeholder="0 mm" name="lebar_retak[' + row_i + ']" required/></td><td><button class="btn btn-sm btn-danger remove-field" href=""><i class="fa fa-times text-light"></i></button></td></tr>');
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
                url:'{{ route("save-stationing") }}',
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
                        $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                    }
                    else
                    {
                        emptyRow(0);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                    }
                    $('#save').attr('disabled', false);
                }
            })
            console.log($(this).serializeArray());
        });

    });

</script>
@endpush