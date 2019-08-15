<?php
include('../database/db.php');
session_start();
include('../addons/header.php');
include('../addons/nav.php');

$queryDatPer = "SELECT * FROM dat_per";
$resultPer = mysqli_query($conexion, $queryDatPer);
?>
<!--tabla Deportista-->
<div id="con_todo">

    <!-- Barra de busqueda y boton -->
    <nav class="navbar navbar-dark unique-color">
        <form class="form-inline">            
            <input class="form-control mr-sm-2" id="filtrar" type="text" placeholder="Buscar" aria-label="Buscar">
            <span class="navbar-brand" id="brand1">Participación</span>
        </form>        
        <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" onclick="location.href='reg_bas1.php?cod_perf=4'">Registrar</button>
        <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" onclick="location.href='reg_bas1.php?cod_perf=4'">Participación</button>
    </nav> 
    
    <!-- Tabla -->
    <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tabla">
        <?php
        $queryDatDep = "SELECT * FROM dat_dep";
        $resultDatDe = mysqli_query($conexion, $queryDatDep);
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody class="buscar">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>                    
                </tr>

            </tbody>
        </table>
    </div>
</div>
sdfsadfsf


<script type="text/javascript">
    $(document).ready(function() {
        (function($) {
            $('#filtrar').keyup(function() {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function() {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
</script>

<?php include('../addons/footer.php') ?>