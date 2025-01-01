@extends('layouts.backend.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Datapoint</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('attributes.index') }}">Datapoint</a></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Datapoints</h2>
      <p class="section-lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorum cumque repellendus voluptatibus unde possimus eius
        accusantium corporis? Fugiat dolorum harum corporis nobis perspiciatis, laboriosam et consectetur delectus rerum nam dolores!</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Datapoint Table</h4>
          </div>
          <div class="card-body">
            <div class="buttons">
              {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button> --}}
              <a href="{{ route('datapoints.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> add atribute</a>
              <a href="{{ route('datapoint_pdf') }}" class="btn btn-outline-primary">export as PDF</a>
              <a href="{{ route('landscapePDF') }}" class="btn btn-outline-primary">landscape</a>
              <a href="#" class="btn btn-outline-primary">export as CSV/.xls</a>
            </div>
            <div class="table-responsive">
              {{-- <table class="table table-bordered table-md"> --}}
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Type</th>
                    @foreach ($attributes as $attribute)
                      <th>{{ $attribute->name }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($datapoints as $datapoint)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <div class="d-flex justify-content-around ">
                          @include('datapoint.action')
                        </div>
                      </td>
                      <td>{{ $datapoint->name }}</td>
                      <td>{{ $datapoint->type }}</td>
                      @foreach ($attributes as $attribute)
                        <!-- Menampilkan nilai berdasarkan attribute_id di tiap datapoint -->
                        <td>
                          @php
                            // Mengambil nilai dari pivot table
                            $pivot = $datapoint->attributes->where('id', $attribute->id)->first();
                          @endphp
                          {{ $pivot ? $pivot->pivot->value : 'N/A' }}
                        </td>
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              {{ $datapoints->links('vendor.pagination.custom') }}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
