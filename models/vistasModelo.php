<?php

    class vistasModelo{
        protected function obtener_vistas_modelo($vistas){
<<<<<<< HEAD
            $listaBlanca = ["home","eventos","editarEvento","registrarEvento","regPueblo","deportistas","delegados","medicos","invitados","pertec","reg_usr","principal","personas","registrarPersona","editarPersona","usuarios","regDeportista","vistaPrueba","regDelegado","regMedico","regInvitado","regInvitadoE","participacion","regParticipacion","tecnicos","registrarTecnico"];
=======
            $listaBlanca = ["home","eventos","editarEvento","registrarEvento","regPueblo","deportistas","delegados","medicos","invitados","pertec","reg_usr","principal","personas","registrarPersona","editarPersona","usuarios","regDeportista","vistaPrueba","regDelegado","regMedico","regInvitado","regInvitadoE","participacion","regParticipacion"];
>>>>>>> bccd9cdb90572ceba500c982ea01407e78905c1a
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