<?php

$peticionAjax = false;
require_once "./controllers/eventoControlador.php";
require_once "./controllers/disciplinaControlador.php";
$insEvento = new eventoControlador();
$insDisciplina = new disciplinaControlador();
?>
<!-- Validar Cedula -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#des_even').on('blur', function() {
            $('#result-even').html('<img src="<?php echo SERVERURL ?>views/assets/img/loader.gif" />').fadeOut(1000);

            var des_even = $(this).val();
            var dataString = 'des_even=' + des_even;

            $.ajax({
                type: "POST",
                url: "<?php echo SERVERURL ?>ajax/validarEventoAjax.php",
                data: dataString,
                success: function(data) {
                    $('#result-even').fadeIn(1000).html(data);
                }
            });
        });
    });
</script>
<?php
$insEvento->formulario_editar_evento_controlador();
?>
</center><br>
                        <div id="autoctono" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i
                                            class="fas fa-feather prefix grey-text"></i></label>
                                </div>
                                <select class="browser-default custom-select" id="inputGroupSelect01" id="" name="">
                                    <option selected disabled value="">Disciplinas autoctonas</option>
                                    <?php
                                        $insDisciplina->consultar_disciplinas_autoctonas_controlador();
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div id="convencional" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i
                                            class="fas fa-futbol prefix grey-text"></i></label>
                                </div>
                                <select class="browser-default custom-select" id="inputGroupSelect01" id="" name="">
                                    <option selected disabled value="">Disciplinas convencionales</option>
                                    <?php
                                        $insDisciplina->consultar_disciplinas_convencionales_controlador();
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div id="mixto" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i
                                            class="fas fa-futbol prefix grey-text"></i><i
                                            class="fas fa-feather prefix grey-text"></i></label>
                                </div>
                                <select class="browser-default custom-select" id="inputGroupSelect01" id="" name="">
                                    <option selected disabled value="">Disciplinas</option>
                                    <?php
                                        $insDisciplina->consultar_disciplinas_controlador();
                                        ?>
                                </select>
                            </div>
                        </div>
                        <p><button class="btn btn-info btn-block" type="submit">Registrar</button></p>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
            </div>
