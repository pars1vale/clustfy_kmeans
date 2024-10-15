@extends('layouts.backend.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Default Layout</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('attributes.index') }}">attributes</a></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">This is Example Page</h2>
      <p class="section-lead">This page is just an example for you to create your own page.</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Simple Table</h4>

            <div class="card-header-form">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  <tr>
                    @foreach ($attributes as $attribute)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->description }}</td>
                    <td><a href="{{ route('attributes.show', $attribute->id) }}" class="btn btn-secondary">Detail</a></td>
                  </tr>
                  @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              <ul class="pagination mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
