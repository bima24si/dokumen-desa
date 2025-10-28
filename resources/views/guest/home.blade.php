@extends('layouts.guest.app')

@section('content')
<section class="main-content">

 <!-- Start Hero Section -->
    <div class="hero">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-8">
            <div class="intro-excerpt">
              <h1>Website Dokumen Desa</h1>
              <p class="mb-4">
                Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit
                imperdiet dolor tempor tristique.
              </p>
              <p>
                <a href="#dokumen" class="btn btn-secondary me-2">Lihat Dokumen</a>
              </p>
            </div>
          </div>
          <div class="col-lg-7"></div>
        </div>
      </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
<div class="product-section" id="dokumen">
    <div class="container">
        <div class="row gcr-row">

        @foreach($dataDokumen as $data)
          <!-- Card 1 -->
          <div class="col-md-6">
            <a href="#" class="gcr-card-link">
              <div class="gcr-card">
                <div class="gcr-header">
                  <img src="https://via.placeholder.com/48" alt="Profile" class="profile-img" />
                  <div class="header-text">
                    <h6 class="name">{{ $data->nama_jenis}}</h6>
                  </div>
                </div>
                <div class="gcr-footer">
                  <p class="date">{{ $data->deskripsi}}</p>
                </div>
              </div>
            </a>
          </div>
    @endforeach


        </div>
      </div>
    </div>
    <!-- End Product Section -->
</section>

@endsection
