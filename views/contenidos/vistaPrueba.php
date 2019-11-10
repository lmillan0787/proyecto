<?php
$peticionAjax = false;



?>


<style>


  .carousel-inner{
    width: 100%;
    height: 70%;
}
.carousel-inner img{
    width: 80%;
    height: 100%;
    margin: 120px;
    margin-top: 30px;
}


</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="h-75 d-inline-block" src="<?php echo SERVERURL ?>views/assets/img/indi1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="h-75 d-inline-block" src="<?php echo SERVERURL ?>views/assets/img/indi2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="h-75 d-inline-block" src="<?php echo SERVERURL ?>views/assets/img/indi3.jpg" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="h-75 d-inline-block" src="<?php echo SERVERURL ?>views/assets/img/indi4.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>








  



