<html>
<head>
    <title>Multi Step Form Example In Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body style="background-color: #f3fdf3">
      
<div class="container">
    <div class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-7">
            <h2> Laravel Multi Step Form Example </h2>
        </div>
    </div>
       
    @yield('content')
</div>
     
</body>
  
</html>