<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  @vite('resources/css/app.css')
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href={{asset("css/style.css")}} type="text/css" media="all" />
  <link rel="stylesheet" href={{asset("css/dropdown.css")}} type="text/css" media="all" />
  <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-func.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>
<body class="bg-dark text-white">
<!-- START PAGE SOURCE -->
  <div id="header">
    <div class="tw-flex tw-flex-wrap tablet:tw-justify-center tw-justify-between">
      <a href="/home"><img src={{asset("images/HealthPackLogo.png")}} width="200px" height="150px"></a>
      <div id="navigation" class="">
        <ul class="!tw-pl-0">
          <li><a href="/home"><h6>HOME</h6></a></li>
          <li><a href="{{route('jual.create')}}"><h6>JUAL</h6></a></li>
          <li>
            <div class="dropdown">
              <button class="dropbtn"><img src="{{asset('images/profile-placeholder.png')}}" width="35px" height="auto" class="tw-rounded-[100%]"><span style="margin-left: 10px">{{Auth::user()->name}}</span></button>
              <div class="dropdown-content">
                <form method="POST" style="padding: 0" action="{{ route('logout') }}">
                  @csrf
                  <button style="border: none; background-color: transparent; color: white; width:100%; height:100%; padding-block: 8px; padding-inline: 16px">Logout</button>
                </form>
              </div>
            </div>

          </li>
        </ul>
      </div>

    <!-- navbar -->
    </div>
    <div id="sub-navigation" class="navbar navbar-dark bg-dark !tw-flex tw-flex-wrap">
      <ul>
        <li><a href="{{route('beli.indexbeli')}}">Daftar Belimu</a></li>
        <li><a href="{{route('jual.indexjual')}}">Daftar Jualmu</a></li>
        <li><a href="{{route('beli.indexpesan')}}">Daftar Pesanan</a></li>
      </ul>

      <div id="search">
        <form action="{{route('home')}}" method="get" accept-charset="utf-8" class="tw-flex">
          <label for="search">SEARCH</label>
          <input type="text" name="search" value="" placeholder="Type here..." id="search-field" class="blink search-field"/>
          <div>
            <input type="submit" value="GO!" class="btn btn-outline-light btn-sm"/>
          </div>
          </form>
      </div>
    </div>
  </div>

  <div>
    <div id="sub-navigation" class="!tw-flex tw-flex-wrap"></div>
  </div>

  <!-- news -->
  <div id="main">
    <div id="content">
        @yield('content')
    </div>

  
</html>