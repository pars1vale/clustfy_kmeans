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
      <h2 class="section-title">Add Data Attributes</h2>
      <p class="section-lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus, cumque a tenetur mollitia sint id ducimus qui sequi nulla
        officia, necessitatibus earum ipsum esse. Perspiciatis assumenda ad inventore omnis perferendis.</p>
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <form action="{{ route('attributes.store') }}" method="post">
            @csrf

            <div class="card-body">
              <div class="form-group">
                <label>Attribute Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required="">
                @error('name')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
              </div>

              <div class="form-group mb-0">
                <label>description attribute</label>
                <textarea name="description" class="form-control  @error('description') is-invalid @enderror" style="height: 100px"></textarea>
                @error('description')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                @enderror
              </div>
            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
