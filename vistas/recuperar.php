<!DOCTYPE html>
<html>

<!-- Mirrored from www.ravijaiswal.com/Afro-v.1.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Mar 2017 03:30:10 GMT -->
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Prestamos</title>

<link rel="stylesheet" type="text/css" href="../public/css/bootstrap/bootstrap.min.css"/>
 
<script src="../public/js/demo-rtl.js"></script>
 
<link rel="stylesheet" type="text/css" href="../public/css/libs/font-awesome.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/libs/nanoscroller.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/compiled/theme_styles.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>
 

</head>
    <body id="login-page">
    <div class="container">
    <div class="row">
    <div class="col-xs-12">
    <div id="login-box">
    <div id="login-box-holder">
    <div class="row">
    <div class="col-xs-12">
<header id="login-header">
    <div id="login-logo">
    </div>
</header>
<div id="login-box-inner">

    <?php
        if(isset($_POST["msj"]))
        {
            echo '<div class="alert alert-info TextoCentrado">' . $_POST["msj"] . '</div>';
        }
    ?>
    <form id="frmAcceso" method="post">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input id="txtIdentificacion" name="txtIdentificacion" type="text" class="form-control"
        placeholder="Identificación" required>
    </div>

    <div class="row">
        <div class="col-xs-12">
        <button type="submit" id="btnRecuperarAcceso" name="btnRecuperarAcceso" class="btn btn-success col-xs-12">Procesar</button>
        </div>
    </div>
    </form>
    <br>
    <p class="mb-1">
        <a href="login.php" class="text-center">Ya tienes una cuenta?</a>
    </p>

</div>
 
<script src="../public/js/demo-skin-changer.js"></script>  
<script src="../public/js/jquery.js"></script>
<script src="../public/js/bootstrap.js"></script>
<script src="../public/js/jquery.nanoscroller.min.js"></script>
<script src="../public/js/demo.js"></script>  
<script src="../public/js/bootbox.min.js"></script>
<script src="../vistas/scripts/login.js"></script>
 
</body>

<!-- Mirrored from www.ravijaiswal.com/Afro-v.1.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Mar 2017 03:30:10 GMT -->
</html>