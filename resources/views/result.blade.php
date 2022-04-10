@extends('layouts.master')
@section('title', 'Sorova - Result Data Primer')
@section('pageTitle', 'Result Data')
@section('content')

        <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Card -->
              <div class="card">
                <!-- <h5 class="card-header">Hasil Perhitungan Data Primer</h5> -->
                <div class="card-body">

                {{$data}}

                </div>
              </div>
              <!--/ Card -->
        </div>
@endsection
