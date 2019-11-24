<?php

    class vistasModelo{
        protected function obtener_vistas_modelo($vistas){
            $listaBlanca = ["home","listaEventos","listaPersonas","listaParticipacion","listaTecnicos","listaInvitados","listaDeportistas","listaDelegados","listaMedicos","listaUsuarios","listaEventos","listaDisciplinas","listaPueblos","registrarEvento","registrarPersona","registrarTecnico","registrarInvitado","registrarDeportista","registrarDelegado","registrarMedico","registrarUsuario","registrarPueblo","registrarDisciplina","editarEvento","editarPersona","editarTecnico","editarInvitado","editarDeportista","editarDelegado","editarMedico","editarUsuario","editarPueblo","editarDisciplina","listaInstitucion","registrarInstitucion","editarInstitucion","listaPerfiles","registrarPerfil","editarPerfil","estadisticas"];
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
            }elseif($vistas=="validacion"){
                $contenido = "validacion";
            }else{
                $contenido = "404";
            }
            return $contenido;
        }
    }