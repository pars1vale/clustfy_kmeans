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
      <h2 class="section-title">Data Attributes</h2>
      <p class="section-lead">Attribute berikut yang akan digunakan sebagai parameter untuk melakukan proses clustering</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Attribute Table</h4>

          </div>
          <div class="card-body">
            <div class="buttons">
              {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button> --}}
              <a href="{{ route('attributes.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> add atribute</a>
              <a href="#" class="btn btn-outline-primary">export as PDF</a>
              <a href="#" class="btn btn-outline-primary">export as CSV/.xls</a>
            </div>
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
                    <td>
                      @include('attribute.action')
                    </td>
                  </tr>
                  @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              {{ $attributes->links('vendor.pagination.custom') }}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
  {{-- <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
