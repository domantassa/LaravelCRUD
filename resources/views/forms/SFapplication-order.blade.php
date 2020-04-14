@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Register an application order</h1>
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

<form method="post" action="{{ route('application-order.store') }}">

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
    <label >Name</label>
    <input type="name" class="form-control" name="NAME" >
  </div>
  <div class="form-group">
    <label>Price ($)</label>
    <input type="number" class="form-control" name="Price" >
  </div>
  <div class="form-group">
    <label>Development software</label>
    <input type="name" class="form-control" name="Development_software" >
  </div>
  <div class="form-group">
    <label>Development methodology</label>
    <input type="name" class="form-control" name="Development_methodology" >
  </div>
  <label >Client</label>
  <div class="input-group mb-3 form-group">
  <div class="input-group-prepend">
    <label class="input-group-text" for="Client">Options</label>
  </div>
  <select class="custom-select" name="fk_Clientid_Client">
    @foreach($clients as $client)
    <option value="{{$client->id_Client}}">{{$client->NAME}} {{$client->Last_name}}</option>
    @endforeach
  </select>
</div>
  <button type="submit" class="btn ">Submit</button>
</form>


@endsection