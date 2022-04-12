@extends('layouts.master')
@section('title', 'Sorova - Result Data Primer')
@push('plugin-styles')
<style type="text/css">
  .tab-content>.tab-pane {
    height: 1px;
    overflow: hidden;
    display: block;
    visibility: hidden;
  }
  .tab-content>.active {
    height: auto;
    overflow: auto;
    visibility: visible;
  }
</style>
@endpush
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
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"  data-bs-target="#navs-pills-top-case"  aria-controls="navs-pills-top-case" ria-selected="false">
                          Metode Penanganan
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">

                    
                        <div class="tab-pane fade show active" id="navs-pills-top-primer" role="tabpanel">
                          <div class="row">
                            <div class="col-lg-3">
                            <small class="text-light fw-semibold">Foto Map </small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-lg-12">
                                  <img src="{{asset('/fotomaps/'.$dataPrimer->foto_map)}}" width="100%" />
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-9">
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
                          <div class="col-lg-12">
                            <small class="text-light fw-semibold">Table Hasil Perhitungan SDI </small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-lg-12">
                                  <div class="table-responsive">
                                    <table class="table table-bordered">
                                      <thead class="text-center table-primary">
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
                                                  $rowspan = count($dataSta);
                                              @endphp
                                              <td rowspan="{{ $rowspan }}">{{$rowSta->lebar}}</td>
                                          @endif
                                          <td>{{$rowSta->jumlah_lubang}}</td>                                      
                                          @if ($key == 0 || $rowspan == $rowid)
                                              @php
                                                  $rowid = 0;
                                                  $rowspan = count($dataSta);
                                              @endphp
                                              <td rowspan="{{ $rowspan }}">{{$rowSta->bekas}}</td>
                                          @endif  
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="navs-pills-top-hasil" role="tabpanel">
                          <div class="col-lg-12">
                            <small class="text-light fw-semibold">Nilai SDI</small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-lg-12">
                                  <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered">
                                      <thead class="text-center table-primary">
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
                                      <tfoot class="table-light">
                                        <tr>
                                          <td colspan="2">Rata-rata SDI</td>
                                          <td colspan="5">{{round($avgSta->rata_rata,2)}}</td>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="navs-pills-top-chart" role="tabpanel">
                          <div class="col-lg-12">
                            <small class="text-light fw-semibold">Pie Chart</small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-12 text-center">
                                  <div id="piechart"></div>
                                </div>
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                <script type="text/javascript">
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                            
                                    function drawChart() {
                            
                                    var data = google.visualization.arrayToDataTable([
                                        ['Kondisi Jalan', 'Persentase'],
                            
                                            @php
                                            foreach($dataPie as $d) {
                                                echo "['".$d->kondisi_jalan."', ".$d->persentase."],";
                                            }
                                            @endphp
                                    ]);
                            
                                      var options = {
                                        is3D: true,
                                        colors: ['#eb2f06', '#f6b93b', '#60a3bc', '#78e08f'],
                                        chartArea: {width: 800, height: 600},
                                      };
                            
                                      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            
                                      chart.draw(data, options);
                                      
                                      
                                    }
                                </script>
                              </div>
                          </div>
                          <div class="mt-4 mb-4"></div>
                          <div class="col-lg-12">
                            <small class="text-light fw-semibold">Diagram Batang</small>
                                <div class="col-md-12 text-center">
                                  <div id="barChart"></div>
                                </div>

                                <script type="text/javascript">
                                window.addEventListener("load", () => {
                                  google.charts.load('current', {
                                    packages: ['corechart']
                                  });

                                  google.charts.setOnLoadCallback(drawChart);
                                });
                            
                                    function drawChart() {
                            
                                    var data = google.visualization.arrayToDataTable([
                                        ['STA', 'Nilai SDI'],
                                            @php
                                            foreach($dataBar as $r) {
                                                echo "['".'STA '.substr_replace($r->id_sta, '+', 1, 0)."', ".$r->nilai_sdi."],";
                                            }
                                            @endphp
                                    ]);
                                                                        
                                    var options = {
                                        width: 800,
                                        height: 400,
                                        hAxis: { 
                                          direction:1, 
                                          slantedText:true, 
                                          fontsize:5, 
                                          slantedTextAngle:45,
                                        },                                                                              
                                      };
                                      var chart = new google.visualization.ColumnChart(document.getElementById('barChart'));
                                      chart.draw(data, options);
                                      
                                      $(window).resize(function(){
                                      var view = new google.visualization.DataView(data);
                                      chart.draw(view, options);
                                      })
                                    }
                                </script>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="navs-pills-top-case" role="tabpanel">
                          <div class="col-sm-12">
                            <small class="text-light fw-semibold">Penanganan Kerusakan Berdasarkan Kondisi Jalan</small>
                              <div class="demo-inline-spacing mt-2">
                                <div class="col-12">
                                  <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered">
                                      <thead class="text-center table-primary">
                                        <tr>
                                          <th class="align-middle" width="1%">No.</th>
                                          <th class="align-middle" width="15%">STA</th>
                                          <th class="align-middle" width="15%">Kondisi Jalan</th>
                                          <th class="align-middle" width="35%">Penanganan Kerusakan</th>
                                        </tr>
                                      </thead>
                                      <tbody class="text-center">
                                        @foreach($resultData as $key => $rowRes)
                                          <tr>
                                            <td>{{$loop->iteration}}
                                            <td>{{substr_replace($rowRes->id_sta, '+', 1, 0)}} ‒ @if(!$loop->last) {{substr_replace($resultData[$key+1]->id_sta, '+', 1, 0)}} @else {{substr_replace($resultData[$key]->id_sta+100, '+', 1, 0)}} @endif</td>
                                            <td>{{$rowRes->kondisi_jalan}}</td>
                                            <td>{{App\Models\ResultSdi::checkCase($rowRes->kondisi_jalan)}}</td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
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
