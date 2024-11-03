@extends('layouts.backend.app')
@section('content')
  <form action="{{ route('clustering.showCentroidForm') }}" method="POST">
    @csrf
    <label for="k">Number of Clusters (k):</label>
    <input type="number" name="k" min="1" required>
    <button type="submit">Next</button>
  </form>
@endsection
