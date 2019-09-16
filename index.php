<!DOCTYPE html>
<html>
<head>
  <title>location</title>
  <style>
    .main{
      border:1px solid gray;
      border-radius: 15px;
      height: 450px; 
      width:450px;
      margin-left: 410px;
      margin-top: 30px;
      background-color:#85C1E9 ;  
    
    }
    .container,.t,.bt,.bt1,.bt2{
      margin-left: 80px;
      margin-top: 40px;
    }
   .contain input{
    border-radius: 15px;
    height: 30px;
    width: 200px;
}
.bt1 input{

  height: 40px;
  width: 90px;
  margin-left: 100px;
} 
.bt2 button{
  height: 40px;
  width:90px;
  margin-left: 500px;
  margin-bottom:400px; 
}
.bt2 h3{
  margin-left: 400px;
}

  </style>
</head>
<body>
  <center><h1>LOCATION</h1></center>
  <form method = "POST" action = "" enctype="multipart/form-data" >
    <div class="main">
      <div class="contain">
        <div class="container">
    Lat : <input type = "text" id="lat" name = "lat" value =""><BR><br>
    longi : <input type = "text" id="longi" name = "longi" value=""><BR><br>
    Zoom : <input type = "text" name = "zoom"><BR><br>
    </div>
    <div class="t">
    description:<textarea name="description" height="250px"></textarea>
  </div>
    <div class="bt">
    <input type="file"  name = "image" >
  </div>
  <div class="bt1">
    <input type = "submit" name = "locate" value = "Locate">
  </div>
  </form>
</div>
</div>
  <div class="bt2">
    <h3>click on button get current location</h3>
  <button onclick="getLocation()">Try It</button>
</div>

<p id="demo1"></p>
<p id="demo2"></p>
</body>
</html>
<?php
require 'conn.php';
//error_reporting(E_ALL);
  if(isset($_POST['locate'])){
    $lat=$_POST['lat'];
    $longi=$_POST['longi'];
    $zoom=$_POST['zoom'];
    $description=addslashes($_POST['description']);

     $imgpath=$_FILES['image']['tmp_name'];
     if($imgpath){
          $img_binary = fread(fopen($imgpath, "r"), filesize($imgpath));
          $picture = base64_encode($img_binary);

          $insert=mysqli_query($conn,"INSERT INTO map (lat,longi,zoom,image,description) VALUES ('$lat','$longi','$zoom','$picture','$description')");
            if($insert){
               //echo "inserted successfully";
                echo"<script language='javascript'>";
                echo'document.location.replace("./map.php")';
                echo"</script>";
            }else{
                echo $conn->error;
            }
    }else{
      echo "insert image";
    }
  }
  ?>
<!--<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}

</script>-->
<script>
  var lat = document.getElementById("demo1");
  var longi=document.getElementById("demo2");


  function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function showPosition(position){
        lat.innerHTML =  position.coords.latitude;
        longi.innerHTML =  position.coords.longitude;
        document.getElementById("lat").value = position.coords.latitude;
        document.getElementById("longi").value = position.coords.longitude;
      }
      );
  } else { 
    lat.innerHTML = "Geolocation is not supported by this browser.";
    longi.innerHTML = "Geolocation is not supported by this browser.";
  }
}
</script>
