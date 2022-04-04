@extends('layouts.master')
@section('title', 'Sorova - Data Penelitian')
@section('content')
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Penelitian SDI</strong>
                            </div>
                            <div class="card-body">
                                <form id="dataRiset" method="POST" action="">
                                    <div class="row col-lg-12">
                                        <div class="col-md-4">
                                            <div class="img-bg">
                                                <img  id="frame" src="{{asset('assets/images/notfound.jpg')}}" class="img-fluid" alt="Image">
                                            </div>
                                            <div class="mb-5 mt-3">
                                                <label>
                                                    <div class="btn btn-info">
                                                        <i class="fa fa-folder-open"></i>
                                                        Pilih Gambar
                                                    </div>
                                                    <input class="form-control" type="file" id="formFile" onchange="preview()" hidden>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label for="ruas" class="col-4 col-form-label">Ruas Jalan</label> 
                                                <div class="col-8">
                                                <input id="ruas" name="ruas" placeholder="Masukkan nama jalan" type="text" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ruas" class="col-4 col-form-label">STA Awal</label> 
                                                <div class="col-6">
                                                <input id="ruas" name="sta_awal" placeholder="0" type="text" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ruas" class="col-4 col-form-label">STA Akhir</label> 
                                                <div class="col-6">
                                                <input id="ruas" name="sta_akhir" placeholder="0" type="text" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lebar" class="col-4 col-form-label">Lebar</label> 
                                                <div class="col-6">
                                                <div class="input-group">
                                                    <input id="lebar" name="lebar" placeholder="0" type="number" class="form-control" required="required"> 
                                                    <div class="input-group-append">
                                                    <div class="input-group-text">Meter</div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lajur" class="col-4 col-form-label">Jumlah Lajur</label> 
                                                <div class="col-8">
                                                <select id="lajur" name="lajur" class="form-control" required="required">
                                                    <option disabled selected><i class="text-muted">Pilih jumlah lajur...</i></option>
                                                    <option value="1 Lajur">1 Lajur</option>
                                                    <option value="2 Lajur">2 Lajur</option>
                                                    <option value="3 Lajur">3 Lajur</option>
                                                    <option value="4 Lajur">4 Lajur</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="jalur" class="col-4 col-form-label">Jumlah Jalur</label> 
                                                <div class="col-8">
                                                <select id="jalur" name="jalur" class="form-control" required="required">
                                                    <option disabled selected><i class="text-muted">Pilih jumlah jalur...</i></option>
                                                    <option value="1 Jalur">1 Jalur</option>
                                                    <option value="2 Jalur">2 Jalur</option>
                                                    <option value="3 Jalur">3 Jalur</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="arah" class="col-4 col-form-label">Jumlah Arah</label> 
                                                <div class="col-8">
                                                <select id="arah" name="arah" class="form-control" required="required">
                                                    <option disabled selected><i class="text-muted">Pilih jumlah arah...</i></option>
                                                    <option value="1 Arah">1 Arah</option>
                                                    <option value="2 Arah">2 Arah</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tipe" class="col-4 col-form-label">Tipe Perkerasan</label> 
                                                <div class="col-8">
                                                <select id="tipe" name="tipe" required="required" class="form-control">
                                                    <option disabled selected><i class="text-muted">Pilih tipe...</i></option>
                                                    <option value="Lentur">Lentur</option>
                                                    <option value="Kaku">Kaku</option>
                                                </select>
                                                </div>
                                            </div> 
                                            <div class="form-group row mt-4">
                                                <div class="col-4">
                                                <button name="reset" type="reset" class="btn btn-block btn-secondary">
                                                <i class="fa fa-refresh"></i> Reset
                                                </button>
                                                </div>
                                                <div class="col-8">
                                                <button name="submit" type="submit" class="btn btn-block btn-primary">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
@endpush