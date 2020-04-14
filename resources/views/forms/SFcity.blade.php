@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Register a city</h1>
  <div>
</div>

@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

<form method="post" action="{{ route('city.store') }}">
  @csrf
   
  <div class="form-group">
    <label>Residents</label>
    <input type="number" class="form-control" name="Number_of_residents">
  </div>
  <div class="form-group">
    <label >Area (Km)</label>
    <input type="number" class="form-control" name="Area_square_km" >
  </div>
  <div class="form-group">
    <label >Name</label>
    <input type="name" class="form-control" name="NAME" >
  </div>
  <div class="form-group">
    <label>Mayor</label>
    <input type="Mayor" class="form-control" name="Mayor" >
  </div>
  <div class="form-group">
    <label >Has bussiness center</label>
    <input type="checkbox" class="form-control" name="Has_bussiness_center" >
  </div>
  <div class="form-group">
    <label>Country</label>
    <input type="name" class="form-control" name="Country" >
  </div>
  <button type="submit" class="btn ">Submit</button>
</form>


@endsection