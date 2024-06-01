<?php
require 'header.php';
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                     <h2 class="box-title">Prestamos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h2>
                </header>
                <div class="main-box-body clearfix" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="tbllistado">
                            <thead>
                                <tr>
                                   <th>Opciones</th>
                                    <th>Clientes</th>
                                    <th>Usuarios</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Interes</th>
                                    <th>Saldo</th>
                                    <th>Pagos</th>
                                    <th>Fechas</th>
                                    <th>Plazo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
                </div>
                
                   <div class="main-box-body clearfix" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                           <div class="form-group col-md-6 col-sm-9 col-xs-12">
                            <label>Cliente</label>
                            <input type="hidden" name="idprestamo" id="idprestamo">
                            <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required></select>                           
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                           <label>Usuarios</label>
                            <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" required></select> 
                            <input type="hidden" class="form-control" name="fprestamo" id="fprestamo" required>
                        </div>                          
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Monto</label>
                            <input type="number" name="monto" id="monto" class="form-control" placeholder="Monto" required>
                            <input type="hidden"  id="valor" >
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Interes</label>
                            <select class="form-control select-picker" name="interes" id="interes" required>
                              <option value="20">20 %</option>
                              <option value="15">15 %</option>
                              <option value="13">13 %</option>
                              <option value="10">10 %</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Saldo</label>
                            <input type="number" name="saldo" id="saldo" class="form-control" placeholder="Saldo" required >
                        </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Forma Pago</label>
                            <select class="form-control select-picker" name="formapago" id="formapago" required>
                              <option value="Diario">Diario</option>
                              <option value="Semanal">Semanal</option>
                              <option value="Quincenal">Quincenal</option>
                              <option value="Mensual">Mensual</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha pago:</label>
                            <input type="date" class="form-control" name="fechapago" id="fechapago" required >

                          </div>
                        </div>
                         <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Plazo</label>
                            <select class="form-control select-picker" name="plazo" id="plazo" required>
                              <option value="Dia">Dia</option>
                              <option value="Semana">Semana</option>
                              <option value="Quincena">Quincena</option>
                              <option value="Mes">Mes</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha Cancelacion</label>
                            <input type="date" class="form-control" name="fplazo" id="fplazo" required >
                          </div>
                         </div>
                        <div class="form-group col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php

require 'footer.php';
?>
    <script type="text/javascript" src="scripts/prestamos.js"></script>
<?php 
ob_end_flush();
?>
