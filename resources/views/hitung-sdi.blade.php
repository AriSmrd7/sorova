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
                                            <option value="">5000+100</option>
                                            <option value="">5000+200</option>
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
                                            <table class="table" style="table-layout: auto;"  id="addedFields"> 
                                                <thead>
                                                    <tr>
                                                    <td colspan="2" class="text-muted">Luas Retak</td>
                                                    <td class="text-muted">Jumlah Lubang</td>
                                                    <td class="text-muted">Bekas Roda</td>
                                                    <td class="text-muted">Lebar Retak</td>
                                                    <td class="text-muted">#</td>
                                                    </tr>
                                                </thead>
                                                <form method="POST" action="{{ route('save-stationing') }}">
                                                    @csrf
                                                    <input type="hidden" name="id_sta" value="12"/>
                                                    <tbody>
                                                            <tr>
                                                                <td><input class="form-control form-control-sm" id="panjang" placeholder="Panjang" name="panjang[0]" required/></td>
                                                                <td><input class="form-control form-control-sm" id="lebar" placeholder="Lebar" name="lebar[0]" required/></td>
                                                                <td><input class="form-control form-control-sm" id="lubang" placeholder="0" name="lubang[0]" required/></td>
                                                                <td><input class="form-control form-control-sm" id="bekas" placeholder="0" name="bekas[0]" required/></td>
                                                                <td><input class="form-control form-control-sm" id="retak" placeholder="0" name="retak[0]" required/></td>
                                                            </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td>
                                                                <button class="btn btn-secondary">Sebelumnya</button>
                                                            </td>
                                                            <td colspan="2">
                                                                <button class="btn btn-primary" type="submit">Selanjutnya</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </form>
                                            </table>
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

        $('#addRow').on('click', function() {
            var totalrow = $('#segmen').val();
            for (let i = 0; i < totalrow; i++) {
                $("#addedFields").append('<tr><td><input class="form-control form-control-sm" id="panjang" placeholder="Panjang" name="panjang[' + i + ']" required/></td><td><input class="form-control form-control-sm" id="lebar" placeholder="Lebar" name="lebar[' + i + ']" required/></td> <td><input class="form-control form-control-sm" id="lubang" placeholder="0" name="lubang[' + i + ']" required/></td><td><input class="form-control form-control-sm" id="bekas" placeholder="0" name="bekas[' + i + ']" required/></td><td><input class="form-control form-control-sm" id="retak" placeholder="0" name="retak[' + i + ']" required/></td><td><button class="btn btn-sm btn-danger remove-field" href=""><i class="fa fa-times text-light"></i></button></td></tr>');
            }
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

    });
</script>
@endpush