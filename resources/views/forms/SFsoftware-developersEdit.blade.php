@extends('layout')
@section('content')

<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3 mb-3">Edit a software Developer</h1>
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

<form method="post" action="{{ route('software-developer.update', ['software_developer' => $software_developer[0]->id_Software_developer]) }}">
  @method('PATCH') 
  @csrf
   
  <div class="form-group">
    <label>Name</label>
    <input type="name" class="form-control" name="NAME" value='{{$software_developer[0]->NAME}}'>
  </div>
  <div class="form-group">
    <label >Lastname</label>
    <input type="name" class="form-control" name="Last_name" value="{{$software_developer[0]->Last_name}}">
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="email" class="form-control" name="Email" value="{{$software_developer[0]->Email}}">
  </div>
  <div class="form-group">
    <label>Phone</label>
    <input type="phone" class="form-control" name="Phone" value="{{$software_developer[0]->Phone}}">
  </div>
  <div class="form-group">
    <label >Experience (years)</label>
    <input type="number" class="form-control" name="Experience" value="{{$software_developer[0]->Experience}}">
  </div>
  <div class="form-group">
    <label>Best known programming language</label>
    <input type="phone" class="form-control" name="Best_known_language" value="{{$software_developer[0]->Best_known_language}}">
  </div>
  <label >Office</label>
  <div class="input-group mb-3 form-group">
  <div class="input-group-prepend">
    <label class="input-group-text" for="Office">Options</label>
  </div>
  <select class="custom-select" name="fk_Officeid_Office">
    @foreach($offices as $office)
    <option value="{{$office->id_Office}}">{{$office->NAME}}</option>
    @endforeach
  </select>
  </div>
  @foreach ($application_orders as $application_order)
   <div class="OrdersBox">
    <div class="form-group OrdersGroup" >
      <div class="input-group mb-3 form-group">
      <div class="input-group-prepend">
        <label class="input-group-text" for="Office">All orders</label>
      </div>
      <select class="custom-select" name="application_orders[]">
        @foreach($application_orders as $application_order)
        <option value="f">f</option>
        @endforeach
      </select>
      <a  href="#" title="" class="removeChild"><button type="button"  class="ml-2 btn">Delete order</button></a>
      </div>  
    </div>
  </div>
  @endforeach
  <button style="display:block" type="submit" class="btn ">Submit</button>
</form>


@endsection