   <!-- Barra de busqueda y boton -->
   <nav class="navbar navbar-dark unique-color">
        <form class="form-inline">            
            <input class="form-control mr-sm-2" id="filtrar" type="text" placeholder="Buscar" aria-label="Buscar">
            <span class="navbar-brand" id="brand1">Usuarios</span>
        </form>        
        <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="submit" onclick="location.href='<?php echo SERVERURL ?>regper/'">Registrar</button>        
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
                    <th scope="col">Disciplina</th>
                    <th scope="col">Categoria</th>                    
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody class="buscar">
            <?php
                $querydel=mysqli_query($conexion,"SELECT a.*, b.*, c.* FROM `dat_per` AS a INNER JOIN dat_par AS b ON b.cod_per=a.cod_per INNER JOIN dat_del AS c ON a.cod_per=c.cod_per ORDER BY c.cod_per ASC");                
                while($r = mysqli_fetch_array($querydel))
                {echo '
                <tr>
                    <td>'.$r['cod_per'].'</td>
                    <td>'.$r['nom'].'</td>
                    <td>'.$r['ape'].'</td>
                    <td>'.$r['ced'].'</td>
                    <td>'.$r['des_gen'].'</td>
                    <td>'.$r['cod_reg'].'</td>
                    <td>'.$r['cod_cat'].'</td>
                    <td><button class="btn btn-success btn-md my-2 my-sm-0 ml-3" type="submit"><a href="act_dep.php?cod_per='.$r['cod_per'].'">Editar</a></button></td>                                                        
                </tr>';
                }?>
            </tbody>
        </table>
    </div>
    



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