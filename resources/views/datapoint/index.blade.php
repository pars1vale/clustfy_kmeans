@extends('layouts.backend.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Attributes Clustering</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('attributes.index') }}">Attributes</a></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Datapoints</h2>
      <p class="section-lead">datapoint</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Datapoint Table</h4>
          </div>
          <div class="card-body">
            <div class="buttons">
              {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button> --}}
              <a href="{{ route('datapoints.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> add atribute</a>
              <a href="#" class="btn btn-outline-primary">export as PDF</a>
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
          <div class="container">
            <h2>Buat DataPoint Baru</h2>

            <form action="{{ route('datapoints.store') }}" method="POST">
              @csrf

              <!-- Input untuk name -->
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
              </div>

              <!-- Input untuk type -->
              <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                  <option value="framework" {{ old('type') == 'framework' ? 'selected' : '' }}>Framework</option>
                  <option value="library" {{ old('type') == 'library' ? 'selected' : '' }}>Library</option>
                </select>
              </div>

              <!-- Looping untuk setiap attribute -->
              @foreach ($attributes as $attribute)
                <div class="form-group">
                  <label for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
                  <input type="number" class="form-control" id="attribute-{{ $attribute->id }}" name="attributes[{{ $attribute->id }}]"
                    value="{{ old('attributes.' . $attribute->id) }}" required>
                </div>
              @endforeach

              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
          <div class="card-footer text-right">
            {{-- <nav class="d-inline-block">
              {{ $attributes->links('vendor.pagination.custom') }}
            </nav> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
