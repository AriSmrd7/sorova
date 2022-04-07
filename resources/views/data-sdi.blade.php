@extends('layouts.master')
@section('title', 'Sorova - Data Penelitian')
@section('content')
            <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Card -->
                        <div class="card">
                            <h5 class="card-header">Form Input Data Primer</h5>
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li><small>{{ $error }}</small></li>
                                            @endforeach
                                        </ul>                                
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                                <form id="dataRiset" method="POST" action="{{route('data-sdi.insert')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id_data" value="{{$id}}">
                                    <div class="row col-lg-12">
                                        <div class="col-md-3">
                                            <div class="img-bg">
                                                <img  id="frame" src="{{asset('new-assets/img/notfound.jpg')}}" class="img-fluid" alt="Image">
                                            </div>
                                            <div class="mb-5 mt-3">
                                                <label>
                                                    <div class="btn btn-info">
                                                        <span class="tf-icons bx bx-folder-open"></span>
                                                        Pilih Gambar
                                                    </div>
                                                    <input class="form-control" type="file" name="foto_map" id="formFile" onchange="preview()" hidden>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group row mb-2">
                                                <label for="ruas" class="col-md-4 col-form-label">Ruas Jalan</label> 
                                                <div class="col-md-8">
                                                <input id="ruas"  name="ruas" placeholder="Masukkan nama jalan" type="text" class="form-control form-control-sm" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row  mb-2">
                                                <label for="ruas" class="col-md-4 col-form-label">STA Awal</label> 
                                                <div class="col-md-5">
                                                <div class="input-group input-group-sm">
                                                    <input id="sta_awal" onkeypress="return onlyNumber(event, false)"   maxlength="4" name="sta_awal"  placeholder="0" type="text" class="form-control" required="required">
                                                    <span class="input-group-text">+</span>
                                                    <select name="sta_awal2" class="form-select">
                                                        <option value="000">000</option>
                                                        <option value="100">100</option>
                                                        <option value="200">200</option>
                                                        <option value="300">300</option>
                                                        <option value="400">400</option>
                                                        <option value="500">500</option>
                                                        <option value="600">600</option>
                                                        <option value="700">700</option>
                                                        <option value="800">800</option>
                                                        <option value="900">900</option>
                                                    </select>       
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  mb-2">
                                                <label for="ruas" class="col-md-4 col-form-label">STA Akhir</label> 
                                                <div class="col-md-5">
                                                <div class="input-group input-group-sm">
                                                    <input id="sta_awal" onkeypress="return onlyNumber(event, false)"   maxlength="4" name="sta_akhir"  placeholder="0" type="text" class="form-control" required="required">
                                                    <span class="input-group-text">+</span>
                                                    <select name="sta_akhir2" class="form-select">
                                                        <option value="000">000</option>
                                                        <option value="100">100</option>
                                                        <option value="200">200</option>
                                                        <option value="300">300</option>
                                                        <option value="400">400</option>
                                                        <option value="500">500</option>
                                                        <option value="600">600</option>
                                                        <option value="700">700</option>
                                                        <option value="800">800</option>
                                                        <option value="900">900</option>
                                                    </select>       
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="lebar" class="col-md-4 col-form-label">Lebar</label> 
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-sm">
                                                        <input id="lebar"  name="lebar" min="0" placeholder="0" type="text" class="form-control" maxlength="6" onkeypress="return isNumberKey(event,this)" required="required"> 
                                                        <span class="input-group-text">Meter</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="lajur" class="col-md-4 col-form-label">Jumlah Lajur</label> 
                                                <div class="col-md-4">
                                                <select id="lajur" name="lajur" class="form-select form-select-sm" required="required">
                                                    <option disabled selected><i class="text-muted">Pilih jumlah lajur...</i></option>
                                                    <option value="1">1 Lajur</option>
                                                    <option value="2">2 Lajur</option>
                                                    <option value="3">3 Lajur</option>
                                                    <option value="4">4 Lajur</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="jalur" class="col-md-4 col-form-label">Jumlah Jalur</label> 
                                                <div class="col-md-4">
                                                <select id="jalur" name="jalur" class="form-select form-select-sm" required="required">
                                                    <option disabled selected><i class="text-muted">Pilih jumlah jalur...</i></option>
                                                    <option value="1">1 Jalur</option>
                                                    <option value="2">2 Jalur</option>
                                                    <option value="3">3 Jalur</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="arah" class="col-md-4 col-form-label">Jumlah Arah</label> 
                                                <div class="col-md-4">
                                                <select id="arah" name="arah" class="form-select form-select-sm" required="required">
                                                    <option disabled selected><i class="text-muted">Pilih jumlah arah...</i></option>
                                                    <option value="1">1 Arah</option>
                                                    <option value="2">2 Arah</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tipe" class="col-md-4 col-form-label">Tipe Perkerasan</label> 
                                                <div class="col-md-4">
                                                <select id="tipe" name="tipe" required="required" class="form-select form-select-sm">
                                                    <option disabled selected><i class="text-muted">Pilih tipe...</i></option>
                                                    <option value="Lentur">Lentur</option>
                                                    <option value="Kaku">Kaku</option>
                                                </select>
                                                </div>
                                            </div> 
                                            <div class="form-group row mt-3">
                                                <div class="d-grid gap-2 d-md-block">
                                                    <button name="submit" type="submit" class="btn btn-block btn-primary">
                                                    <span class="tf-icons bx bx-save"></span>  Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <!--/ Card -->
            </div>
        
@endsection
@push('custom-scripts')
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";
        }
    </script>

    <script type="text/javascript">
        function onlyNumber(e,decimal){
                    var key;
                    var keychar;
                    if(window.event){
                        key = window.event.keyCode;
                    }else
                        if(e){
                            key = e.which;
                        }else return true;
                        
                        keychar = String.fromCharCode(key);
                        if((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27)){
                            return true;
                        }else
                            if((("0123456789").indexOf(keychar)>-1)){
                                return true;
                            }else
                                if(decimal && (keychar ==".")){
                                    return true;
                                }else return false;
            }

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