<!DOCTYPE html>
<html lang="en">
<head>


<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page info -->
    <title>CRUD</title>

    <!-- Scripts -->
    <script> window.addEventListener("load", () => {
    document.querySelector("body").classList.add("loaded"); 
   }); </script>
    <!-- Fonts -->
    
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('js/custom.js') }}" rel="stylesheet">

</head>
<body class="fadein">

<nav class="navbar navbar-expand-lg navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fa fa-bars" style="color:#000; font-size:28px;"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown nav-item3">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Cities
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/city">List</a>
          <a class="dropdown-item" href="/city/create">Add new</a>
        </div>
      </li>
      <li class="nav-item dropdown nav-item3">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Clients
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/">List</a>
          <a class="dropdown-item" href="/client/create">Add new</a>
        </div>
      </li>
      <li class="nav-item dropdown nav-item3">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Application orders
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/application-order">List</a>
          <a class="dropdown-item" href="/application-order/create">Add new</a>
        </div>
      </li>
      <li class="nav-item dropdown nav-item3">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Software developers
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/software-developer">List</a>
          <a class="dropdown-item" href="/software-developer/create">Add new</a>
        </div>
      </li>
      <li class="nav-item dropdown nav-item3">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Offices
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/office">List</a>
          <a class="dropdown-item" href="/office/create">Add new</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="icon-bar">
      <div class="btn-group-vertical">
        
        <button onclick="window.location.href='/city'" type="button" class="btn fixed">SF #1</button>
        <button onclick="window.location.href='/client'" type="button" type="button" class="btn fixed">SF #2</button>
        <button onclick="window.location.href='/application-order'" type="button" type="button" class="btn fixed">SF #3</button>
        <button onclick="window.location.href='/software-developer'" type="button" type="button" class="btn fixed">SF #4</button>
        <button onclick="window.location.href='/office'" type="button" type="button" class="btn fixed">SF #5</button>
        <button onclick="$('.fixed').toggleClass('hidden')" type="button" class="btn offon"><i class="fa fa-bars"></i></button>
        <button onclick="window.location.href='/city/create'" type="button" type="button" class="btn fixed">PN1 #1</button>
        <button onclick="window.location.href='/office/create'" type="button" type="button" class="btn fixed">PP1 #1</button>
        <button onclick="window.location.href='/application-order'" type="button" type="button" class="btn fixed">PP1 #2</button>
        <button onclick="window.location.href='/client/create'" type="button" type="button" class="btn fixed">SPa #1</button>
        <button onclick="window.location.href='/software-developer/create'" type="button" type="button" class="btn fixed">SPva #1</button>

      </div>
</div>




<div class="container" style="margin-top: 3rem">
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
$(window).ready(function (){
  $kiek = parseInt($('.disabledOrders').val());
    $(".addChild").click(function() {
      $('.disabledOrders').attr('value', $kiek+1);
      $kiek = $kiek+1;
      if($(".OrdersGroup").hasClass( "hidden" ))
      {
        $(".OrdersGroup").removeClass("hidden");
      }
      else 
      {
        Clone = $(".OrdersGroup").clone(true, true);
        Clone.removeClass("OrdersGroup");
        Clone.appendTo($(".OrdersBox"));
      }
        return false;
    })

    $(".removeChild").click(function() {
      $('.disabledOrders').attr('value', $kiek-1);
      $kiek = $kiek-1;
        if($(".OrdersBox").children('.form-group').hasClass('OrdersGroup')) { 
          $(this).parent().parent().addClass('hidden');
        } else { 
          $(this).parent().parent().remove();
           
        }
        return false;
    })
    

   
    
});
</script>
</body>
</html>