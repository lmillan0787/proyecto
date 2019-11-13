<?php

    class vistasModelo{
        protected function obtener_vistas_modelo($vistas){
            $listaBlanca = ["geventos","gpueblos","gdisciplinas","gregiones","gregionespor","estadisticas","home","eventos","editarEvento","registrarEvento","registrarUsuario","deportistas","delegados","medicos","invitados","pertec","reg_usr","principal","personas","registrarPersona","editarPersona","usuarios","registrarDeportista","vistaPrueba","registrarDelegado","registrarMedico","registrarInvitado","regInvitadoE","participacion","registrarParticipacion","tecnicos","registrarTecnico","pueblos","registrarPueblo","disciplinas","registrarDisciplina","graficos"];
            if(in_array($vistas, $listaBlanca)){
                if(is_file("./views/contenidos/".$vistas.".php")){
                    $contenido="./views/contenidos/".$vistas.".php";
                }else{
                    $contenido = "inicio";
                }
            }elseif($vistas=="inicio"){
                $contenido = "inicio";                
            }elseif($vistas=="index"){
                $contenido = "inicio";
            }else{
                $contenido = "404";
            }
            return $contenido;
        }
    }