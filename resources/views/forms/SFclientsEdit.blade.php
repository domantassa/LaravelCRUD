@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Edit a client</h1>
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

<form method="post" action="{{ route('client.update', ['client' => $client[0]->id_Client]) }}">
  @method('PATCH') 
  @csrf
   
  <div class="form-group">
    <label>Name</label>
    <input type="name" class="form-control" name="NAME" value='{{$client[0]->NAME}}'>
  </div>
  <div class="form-group">
    <label >Lastname</label>
    <input type="name" class="form-control" name="Last_name" value="{{$client[0]->Last_name}}">
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="email" class="form-control" name="Email" value="{{$client[0]->Email}}">
  </div>
  <div class="form-group">
    <label>Phone</label>
    <input type="phone" class="form-control" name="Phone" value="{{$client[0]->Phone}}">
  </div>
  <div class="form-group">
    <label >Amount of orders</label>
    <input type="number" class="form-control" name="Amount_of_orders" value="{{$client[0]->Amount_of_orders}}">
  </div>
  <button type="submit" class="btn ">Submit</button>
</form>


@endsection