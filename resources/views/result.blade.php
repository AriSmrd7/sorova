@extends('layouts.master')
@section('title', 'Sorova - Result Data Primer')
@section('pageTitle', 'Result Data')
@section('content')

        <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Card -->

              <div class="col-xl-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                      <li class="nav-item">
                        <button type="button"class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-primer"  aria-controls="navs-pills-top-primer" aria-selected="true">
                          Data Primer
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-sdi" aria-controls="navs-pills-top-sdi" aria-selected="false">
                          Metode SDI
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-hasil" aria-controls="navs-pills-top-hasil" aria-selected="false">
                          Nilai SDI
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"  data-bs-target="#navs-pills-top-chart"  aria-controls="navs-pills-top-chart" ria-selected="false">
                          Chart
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">

                    
                      <div class="tab-pane fade show active" id="navs-pills-top-primer" role="tabpanel">
                        <div class="row">
                          <div class="col-md-3">
                          <small class="text-light fw-semibold">Foto Map </small>
                            <div class="demo-inline-spacing mt-2">
                              <div class="col-12">
                                 <img src="{{asset('/fotomaps/'.$dataPrimer->foto_map)}}" width="100%" />
                              </div>
                            </div>
                          </div>

                          <div class="col-md-9">
                          <small class="text-light fw-semibold me-5">Data Primer </small>
                            <div class="demo-inline-spacing mt-2">
                              <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-map-pin me-2"></i>
                                  <div class="col-3 me-4">Ruas Jalan</div>
                                  <div class="text-primary">{{$dataPrimer->ruas_jalan}}</div> 
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-station me-2"></i>
                                  <div class="col-3 me-4">Stationing</div>
                                  <div class="text-primary">{{$dataPrimer->sta_awal}} <i class="bx bx-chevron-right"></i> {{$dataPrimer->sta_akhir}}</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-tachometer me-2"></i>
                                  <div class="col-3 me-4">Lebar Jalan</div>
                                  <div class="text-primary">{{$dataPrimer->lebar}} Meter</div> 
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-trip me-2"></i>
                                  <div class="col-3 me-4">Jumlah Lajur</div>
                                  <div class="text-primary">{{$dataPrimer->jumlah_lajur}} Lajur</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-sort-alt-2 me-2"></i>
                                  <div class="col-3 me-4">Jumlah Jalur</div>
                                  <div class="text-primary">{{$dataPrimer->jumlah_jalur}} Jalur</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-directions me-2"></i>
                                  <div class="col-3 me-4">Jumlah Arah</div>
                                  <div class="text-primary">{{$dataPrimer->jumlah_arah}} Arah</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-hive me-2"></i>
                                  <div class="col-3 me-4">Tipe Perkerasan</div>
                                  <div class="text-primary">{{$dataPrimer->tipe_perkerasan}}</div>                               
                                </li>
                              </ul>
                            </div>
                          </div>
                          <small class="text-light fw-semibold mt-2">Tanggal Input : {{date('l, j F Y , h:i A', strtotime($dataPrimer->created_at))}} </small>
                        </div> 
                      </div>



                        <div class="tab-pane fade" id="navs-pills-top-sdi" role="tabpanel">
                          <div class="col-sm-12">
                            <small class="text-light fw-semibold">Table Hasil Perhitungan SDI </small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-12">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead class="text-center">
                                        <tr>
                                          <th rowspan="2" class="align-middle" width="1%">No.</th>
                                          <th rowspan="2" class="align-middle" width="17%">STA</th>
                                          <th colspan="4">Nilai SDI</th>
                                        </tr>
                                        <tr>
                                          <th>Luas Retak (%)</th>
                                          <th>Lebar Retak (mm)</th>
                                          <th>Jumlah Lubang</th>
                                          <th>Dalam Bekas Roda (cm)</th>
                                        </tr>
                                      </thead>
                                      <tbody class="text-center">
                                      @php
                                        $rowid = 0;
                                        $rowspan = 0;
                                      @endphp
                                      @foreach($dataSta as $key => $rowSta)
                                      @php
                                        $rowid += 1
                                      @endphp
                                        <tr>
                                          <td>{{ ++$i }}</td>
                                          <td>{{substr_replace($rowSta->nama_sta, '+', 1, 0)}} ‒ @if(!$loop->last) {{substr_replace($dataSta[$key+1]->nama_sta, '+', 1, 0)}} @else {{substr_replace($dataSta[$key]->nama_sta+100, '+', 1, 0)}} @endif</td>
                                          <td>{{$rowSta->persen_luas_retak}}</td>
                                          @if ($key == 0 || $rowspan == $rowid)
                                              @php
                                                  $rowid = 0;
                                                  $rowspan = $maxLR;
                                              @endphp
                                              <td rowspan="{{ $rowspan }}">{{$maxLR}}</td>
                                          @endif
                                          <td>{{$rowSta->jumlah_lubang}}</td>
                                          @if ($key == 0 || $rowspan == $rowid)
                                              @php
                                                  $rowid = 0;
                                                  $rowspan = $maxBR;
                                              @endphp
                                              <td rowspan="{{ $rowspan }}">{{$maxBR}}</td>
                                          @endif                                        
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                      <div class="col-md-12">
                                        <div class="row text-center">
                                          {{$dataSta->links("pagination::bootstrap-5")}}
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>


                        <div class="tab-pane fade" id="navs-pills-top-hasil" role="tabpanel">
                          <div class="col-sm-12">
                            <small class="text-light fw-semibold">Nilai SDI</small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-12">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead class="text-center">
                                        <tr>
                                          <th rowspan="2" class="align-middle" width="1%">No.</th>
                                          <th rowspan="2" class="align-middle" width="25%">STA</th>
                                          <th colspan="4">Nilai SDI</th>
                                          <th rowspan="4" class="align-middle" width="15%">Kondisi Jalan</th>
                                        </tr>
                                        <tr>
                                          <th>SDI 1</th>
                                          <th>SDI 2</th>
                                          <th>SDI 3</th>
                                          <th>SDI 4</th>
                                        </tr>
                                      </thead>
                                      <tbody class="text-center">
                                        @foreach($resultData as $key => $rowRes)
                                          <tr>
                                            <td>{{$loop->iteration}}
                                            <td>{{substr_replace($rowRes->id_sta, '+', 1, 0)}} ‒ @if(!$loop->last) {{substr_replace($resultData[$key+1]->id_sta, '+', 1, 0)}} @else {{substr_replace($resultData[$key]->id_sta+100, '+', 1, 0)}} @endif</td>
                                            <td>{{$rowRes->sdi_1}}</td>
                                            <td>{{$rowRes->sdi_2}}</td>
                                            <td>{{$rowRes->sdi_3}}</td>
                                            <td>{{$rowRes->sdi_4}}</td>
                                            @if($rowRes->kondisi_jalan == 'RUSAK BERAT') @php $bgBadge = 'bg-danger'; @endphp
                                            @elseif($rowRes->kondisi_jalan == 'RUSAK RINGAN')  @php $bgBadge = 'bg-warning'; @endphp
                                            @elseif($rowRes->kondisi_jalan == 'SEDANG') @php $bgBadge = 'bg-info'; @endphp
                                            @elseif($rowRes->kondisi_jalan == 'BAIK')  @php  $bgBadge = 'bg-success'; @endphp
                                            @else @php $bgBadge = ''; @endphp
                                            @endif

                                            <td><span class="badge {{$bgBadge}}">{{$rowRes->kondisi_jalan}}</span></td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="navs-pills-top-chart" role="tabpanel">
                          <div class="col-sm-12">
                            <small class="text-light fw-semibold">Pie Chart</small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-12 text-danger">
                                  <div id="piechart" style="width: 1200px; height: 800px;"></div>
                                </div>
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                <script type="text/javascript">
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                            
                                    function drawChart() {
                            
                                    var data = google.visualization.arrayToDataTable([
                                        ['Month Name', 'Registered User Count'],
                            
                                            @php
                                            foreach($dataPie as $d) {
                                                echo "['".$d->kondisi_jalan."', ".$d->persentase."],";
                                            }
                                            @endphp
                                    ]);
                            
                                      var options = {
                                        is3D: true,
                                      };
                            
                                      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            
                                      chart.draw(data, options);
                                    }
                                </script>
                              </div>
                          </div>
                          <div class="mt-4 mb-4"></div>
                          <div class="col-sm-12">
                            <small class="text-light fw-semibold">Diagram Batang</small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-12 text-danger">
                                  Under Maintenance
                                </div>
                              </div>
                          </div>
                        </div>


                      </div>
                    </div>
                </div>
              <!--/ Card -->
        </div>
@endsection
