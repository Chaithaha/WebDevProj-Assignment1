<?php
  $connect = mysqli_connect('localhost', 'chaithaha', 'Player@123', 'ProductList');
  
  if(!$connect){
    die("Connection Failed: " . mysqli_connect_error());
  }
