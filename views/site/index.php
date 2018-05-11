<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$tituloexport = 'Inicio';
  $this->title = $tituloexport
/* @var $this yii\web\View */

?>

<body background="pizzaa.jpg" src="piccolinas/web/pizzaa.jpg">

<div class="site-index">

    <div class="jumbotron">
            <h1 style="color:#5858FA;font-weight:800;">Piccolinas Pizza</h1>
            <link rel="icon" type="image/png" href="http://example.com/myicon.png">
            <p class="lead"  style="color:#0B2161;font-weight:800;">Pizza y algo más.</p>
    </div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 text-center">

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
                        <a class="btn btn-lg btn-success" href="index.php?r=order/create">
                            <span class="glyphicon glyphicon-cutlery fa-lg"></span> Nueva Orden
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">          
                        <a class="btn btn-lg btn-info" href="index.php?r=order/indextoday">
                            <span class="glyphicon glyphicon-time fa-lg"></span> Ordenes de Hoy
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">          
                        <a class="btn btn-lg btn-warning" href="index.php?r=order">
                            <span class="glyphicon glyphicon-list-alt fa-lg"></span> Ordenes
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">          
                        <a href="index.php?r=repartidor/repartidor" class="btn btn-lg btn-primary">
                          <span class="fa fa-motorcycle fa-lg"></span> Repartidores 
                        </a>
                    </div>
    </div>
</div><br>

<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 text-center">

        <div class="col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">          
            <a href="index.php?r=finanzas/finanzas" class="btn btn-lg btn-danger">
              <span class="fa fa-money fa-lg"></span> Capital de Egresos
            </a>
        </div>      
    </div> 
</div> 

</div>
</body>
