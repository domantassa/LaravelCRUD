@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Add a client</h1>
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

<form method="post" action="{{ route('client.store') }}">
    @csrf
  <div class="form-group">
    <label>Name</label>
    <input type="name" class="form-control" name="NAME">
  </div>
  <div class="form-group">
    <label >Lastname</label>
    <input type="name" class="form-control" name="Last_name">
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="email" class="form-control" name="Email">
  </div>
  <div class="form-group">
    <label>Phone</label>
    <input type="phone" class="form-control" name="Phone">
  </div>
  <div class="form-group">
    <label disabled >Amount of orders</label>
    <input type="number" class="form-control disabledOrders" value="0" name="Amount_of_orders" readonly>
  </div>

  <div class="OrdersBox">
    <div class="form-group hidden OrdersGroup" >
      <div class="input-group mb-3 form-group">
      <div class="input-group-prepend">
        <label class="input-group-text" for="Office">All orders</label>
      </div>
      <select class="custom-select" name="application_orders[]">
        @foreach($application_orders as $application_order)
        <option value="{{$application_order->id_Application_order}}">{{$application_order->NAME}}</option>
        @endforeach
      </select>
      <a  href="#" title="" class="removeChild"><button type="button"  class="ml-2 btn">Delete order</button></a>
      </div>  
      
    </div>
  </div>
  
  <a  href="#" title="" class="addChild"><button type="button"  class="mb-2  btn">Add order</button></a>

  <button style="display:block;" type="submit" class="btn ">Submit</button>
</form>


@endsection