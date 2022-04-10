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
                            <small class="text-light fw-semibold">Data Primer </small>
                            <div class="demo-inline-spacing mt-2">
                              <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-map-pin me-2"></i>
                                  <div class="col-3">Ruas Jalan</div>
                                  <div class="text-primary">{{$dataPrimer->ruas_jalan}}</div> 
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-station me-2"></i>
                                  <div class="col-3">Stationing</div>
                                  <div class="text-primary">{{$dataPrimer->sta_awal}} <i class="bx bx-chevron-right"></i> {{$dataPrimer->sta_akhir}}</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-tachometer me-2"></i>
                                  <div class="col-3">Lebar Jalan</div>
                                  <div class="text-primary">{{$dataPrimer->lebar}} Meter</div> 
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-trip me-2"></i>
                                  <div class="col-3">Jumlah Lajur</div>
                                  <div class="text-primary">{{$dataPrimer->jumlah_lajur}} Lajur</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-sort-alt-2 me-2"></i>
                                  <div class="col-3">Jumlah Jalur</div>
                                  <div class="text-primary">{{$dataPrimer->jumlah_jalur}} Jalur</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-directions me-2"></i>
                                  <div class="col-3">Jumlah Arah</div>
                                  <div class="text-primary">{{$dataPrimer->jumlah_arah}} Arah</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-hive me-2"></i>
                                  <div class="col-3">Tipe Perkerasan</div>
                                  <div class="text-primary">{{$dataPrimer->tipe_perkerasan}}</div>                               
                                </li>
                              </ul>
                            </div>
                          </div>
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


                        <div class="tab-pane fade" id="navs-pills-top-chart" role="tabpanel">
                          <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                            cupcake gummi bears cake chocolate.
                          </p>
                          <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                            jelly-o tart brownie jelly.
                          </p>
                        </div>


                      </div>
                    </div>
                </div>
              <!--/ Card -->
        </div>
@endsection
