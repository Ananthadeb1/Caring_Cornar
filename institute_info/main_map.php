<?php
include('../header/header.php');

?>
<script src="map.js"></script>
<style>
    .contain{
        height: 500px;
        width:100%
    }
    #map{
        height: 100%;
        width: 100%;
        border: 1px solid skyblue;
    }
</style>
<div class="contain">
    <center><h1>access the direction of your desired organization</h1></center>
    <div id='map'></div>
</div>

<script acync defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq47n_ujN_-DyhYvtZEBewE4q6-zLrZn8&callback=loadMap"></script>