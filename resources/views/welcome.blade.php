@extends('layouts.frontend.app')
@section('content')
  <main class="px-3">
    <h1>Cluster Framework & Library.</h1>
    <p class="lead">"Selamat datang di clustify, platform inovatif yang dirancang untuk memberikan kemudahan dan efisiensi dalam melakukan clustering
      data secara akurat dan cepat menggunakan algoritma K-Means, dilengkapi dengan fitur-fitur canggih
      untuk memenuhi kebutuhan Anda dengan pengalaman pengguna yang optimal."</p>
    <p class="lead">
      <a href="{{ route('home') }}" class="btn btn-lg btn-light fw-bold border-white bg-white">Do Clustering</a>
    </p>
  </main>
@endsection
