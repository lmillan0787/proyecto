<?php

    class vistasModelo{
        protected function obtener_vistas_modelo($vistas){
            $listaBlanca = ["home","eventos","registrarEvento","regPueblo","deportistas","delegados","medicos","invitados","pertec","reg_usr","principal","personas","regPersona","usuarios","regDeportista","vistaPrueba","regDelegado","regMedico","regInvitado","regInvitadoE","participacion","regParticipacion"];
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