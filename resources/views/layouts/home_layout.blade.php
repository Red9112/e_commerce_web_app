<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="{{mix('/css/app.css')}}">
     <link id="lightLink"  rel="stylesheet" href="{{mix('/css/theme.css')}}">
     <link  id="darkLink" rel="stylesheet" href="{{asset('')}}">
     
<title>Home</title>
</head>
<body >
    
 

<div class="countainer">
@yield('content')
</div>

  

    

     
       
   
   
    


<script src="{{mix('/js/app.js')}}"></script>

</body>
</html>
