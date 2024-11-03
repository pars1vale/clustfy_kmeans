@extends('layouts.backend.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Users</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data Users</h2>
      <p class="section-lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas repellendus iste numquam quam voluptatem tempora, error
        officia. Impedit ipsam cupiditate explicabo eaque commodi dignissimos soluta, ullam quo expedita unde eum!</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Users Table</h4>
          </div>
          <div class="card-body">
            <div class="buttons">
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email Verified At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>
                      {{-- @include('attribute.action') --}}
                    </td>
                  </tr>
                  @endforeach
                  </tr>
                </tbody>
              </table>
            </div>
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
