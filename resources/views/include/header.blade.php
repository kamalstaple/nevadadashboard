<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="correct-SHA-256-hash-value" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type='text/javascript' src="{{asset('js/amcharts.js')}}"></script>
<script src="{{asset('js/serial.js')}}"></script> 
<script type='text/javascript' src="{{asset('js/chartexport.js')}}"></script>
<script type='text/javascript' src="{{asset('js/jquery.tmpl.min.js')}}"></script>

<script type='text/javascript' src="{{asset('js/jquery.colorbox.js')}}"></script>
<script type='text/javascript' src="{{asset('js/jquery.popover-1.1.2.js')}}"></script>
<script type='text/javascript' src="{{asset('js/dataportal.js')}}"></script>




 <script src="{{asset('js/redirect.js')}}"></script>

 <script src="{{asset('js/jquery-ui.js')}}"></script>

@yield('headerlinks')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style>
	.map-area{}
	.map-area polygon:hover{ fill: #0c436a; cursor: pointer; }
	.map-area polygon.active{ fill: #1f5a7b; cursor: pointer; }
	.map-area polygon.disable:hover{ fill: #2288c9; cursor: auto; }
	.name-text polygon:hover{ fill: #000000; }
	.name-text path:hover{ fill: #000000; }
	.demo-hover{ fill: #1f5a7b; cursor: pointer; }
	.name-text:hover polygon{ fill: #FFFFFF; }
	.name-text:hover path{ fill: #FFFFFF; }
	.name-text:hover rect{ fill: #FFFFFF; }
	</style>

  </head>
  <body>

    <header class="custom_header">
      <div class="custom_container">
        <nav class="navbar navbar-expand-lg ">
          <div class="header_wrapper">
            <a class="navbar-brand" href="#">
              <img src="images/logo.png" alt="logo"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
               <img src="images/mobile_toggle.png"/>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{route('/')}}">Economic Performance Data</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('economical') ? 'active' : '' }}" href="{{route('/economical')}}">Economic development Data</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ request()->is('location_comparistion') ? 'active' : '' }}" href="{{route('/location_comparistion')}}">location comparison</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ request()->is('overview') ? 'active' : '' }}" href="{{route('/overview')}}">Detailed overview reports</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>