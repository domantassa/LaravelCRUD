@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Select filters</h1>
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

<form method="post" action="{{ route('client.resultsData') }}">

  @csrf
   
  <div class="form-group">
    <label>Started at</label>
    <input type="date" class="form-control" name="Started_at">
  </div>
  <div class="form-group">
    <label >End term</label>
    <input type="date" class="form-control" name="End_term" >
  </div>
  <div class="form-group">
    <label >Min price</label>
    <input type="name" class="form-control" name="minPrice" >
  </div>

  <button type="submit" class="btn ">Submit</button>
</form>


@endsection