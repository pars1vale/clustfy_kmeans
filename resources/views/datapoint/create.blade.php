@extends('layouts.backend.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Datapoints</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('datapoints.index') }}">Datapoint</a></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Add New Datapoint</h2>
      <p class="section-lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus, cumque a tenetur mollitia sint id ducimus qui sequi nulla
        officia, necessitatibus earum ipsum esse. Perspiciatis assumenda ad inventore omnis perferendis.</p>
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <form action="{{ route('datapoints.store') }}" method="post">
            @csrf
            <div class="card-body">
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
