@extends('layouts.master')
@section('title', 'Sorova - Riwayat Penelitian')
@section('pageTitle', 'Riwayat Data Primer')
@section('content')

        <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Card -->
              <div class="card">
                <!-- <h5 class="card-header">Daftar Riwayat Penelitian</h5> -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead class="text-center">
                        <th>No</th>
                        <th>Ruas Jalan</th>
                        <th>STA Awal</th>
                        <th>STA Akhir</th>
                        <th>Lebar Jalan</th>
                        <th>Opsi</th>
                      </thead>
                      <tbody class="text-center">
                        @foreach($dataSta as $rowSta)
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{$rowSta->ruas_jalan}}</td>
                            <td>{{$rowSta->sta_awal}}</td>
                            <td>{{$rowSta->sta_akhir}}</td>
                            <td>{{$rowSta->lebar}} Meter</td>
                            <td>
                            <a href="{{route('data-primer.sdi.result',$rowSta->id)}}" class="btn btn-sm btn-info">
                            Detail <span class="tf-icons bx bx-send"></span> 
                            </a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Card -->
        </div>
@endsection
