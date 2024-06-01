<?php
require 'header.php';
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2 class="box-title">Permiso</h2>
                </header>
                <div class="main-box-body clearfix" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="tbllistado">
                            <thead>
                                <tr>
                                   <th>Codigo</th>
                                    <th>Permiso</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php
//}
//else
//{
//  require 'noacceso.php';
//}

require 'footer.php';
?>
        <script type="text/javascript" src="scripts/permiso.js"></script>
<?php 
ob_end_flush();
?>
