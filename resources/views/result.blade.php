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
                                 <img src="{{asset('/fotomaps/1649570909.png')}}" width="100%" />
                              </div>
                            </div>
                          </div>

                          <div class="col-md-9">
                            <small class="text-light fw-semibold">Data Primer </small>
                            <div class="demo-inline-spacing mt-2">
                              <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-tv me-2"></i>
                                  <div class="col-3">Ruas Jalan</div>
                                  <div>Jl.MMM</div> 
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-bell me-2"></i>
                                  <div class="col-3">Stationing</div>
                                  <div>5+000 - 7+000</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-support me-2"></i>
                                  <div class="col-3">Lebar Jalan</div>
                                  <div>7.5 Meter</div> 
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-purchase-tag-alt me-2"></i>
                                  <div class="col-3">Jumlah Lajur</div>
                                  <div>Jl.MMM</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-closet me-2"></i>
                                  <div class="col-3">Jumlah Arah</div>
                                  <div>Jl.MMM</div>                               
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                  <i class="bx bx-closet me-2"></i>
                                  <div class="col-3">Tipe Perkerasan</div>
                                  <div>Jl.MMM</div>                               
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div> 
                      </div>



                        <div class="tab-pane fade" id="navs-pills-top-sdi" role="tabpanel">
                          <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                            cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                            cheesecake fruitcake.
                          </p>
                          <p class="mb-0">
                            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                            cotton candy liquorice caramels.
                          </p>
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
