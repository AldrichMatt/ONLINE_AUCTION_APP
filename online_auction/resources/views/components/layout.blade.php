<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <title>Online Auction Web</title>
      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
      @yield('script')
      <style>
        a{
            text-decoration: none;
        }
        body{ 
            font-size: 1em;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        body::-webkit-scrollbar{
            display: none;
        }
        .text-overlay {
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
            padding-left: 30%;
            padding-top: 25%;
            font-size: 2.5vw;
            font-weight: 100;
            color: white;
        }
        .link-overlay {
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
            padding-left: 30%;
            padding-top: 30%;
            font-size: 2.5vw;
            font-weight: 100;
            color: white;
        }
      </style>
</head>
<body id="top" class="modal-open">
   {{ $slot }}
</body>
</html>


