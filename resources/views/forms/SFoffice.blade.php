@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Register an office</h1>
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

<form method="post" action="{{ route('office.store') }}">

  @csrf
   
  <div class="form-group">
    <label>Name</label>
    <input type="name" class="form-control" name="NAME">
  </div>
  <div class="form-group">
    <label >Address</label>
    <input type="name" class="form-control" name="Address" >
  </div>
  <div class="form-group">
    <label >Population</label>
    <input type="number" class="form-control" name="Population" >
  </div>
  <div class="form-group">
    <label>Establishment year</label>
    <input type="date" class="form-control" name="Establishment_year" >
  </div>
  <label >City</label>
  <div class="input-group mb-3 form-group">
  <div class="input-group-prepend">
    <label class="input-group-text" for="City">Options</label>
  </div>
  <select class="custom-select" name="fk_Cityid_City">
    @foreach($cities as $city)
    <option value="{{$city->id_City}}">{{$city->NAME}}</option>
    @endforeach
  </select>
</div>
  <button type="submit" class="btn ">Submit</button>
</form>


@endsection