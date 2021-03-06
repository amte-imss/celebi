<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
    * Valida si existe un usuario con el nombre y contraseñas pasados como parámetros
    * @param string usr - nombre de usuario
    * @param string passwd - contraseña
    * @return int - Devuelve 1 si existe dicho usuario y su contraseña es válida,
    * 2 si el el usuario existe pero la contraseña pasada es incorrecta 
    * y 3 si el usuario no esta registrado.
    */
    function validar_usuario($usr, $passwd) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->start_cache();

        $this->db->select(array('matricula', 'password', 'token', ''));
        $this->db->from('sistema.usuarios u');
        $this->db->join('censo.docente d', 'd.id_docente = u.id_docente', 'inner');
        $this->db->where('d.matricula', $usr);
        $this->db->where('u.activo', true);

        $num_user = $this->db->count_all_results();
        $this->db->reset_query();
        if ($num_user == 1) {
            $usuario = $this->db->get();
            $result = $usuario->result_array();

            $this->load->library('seguridad');
            $cadena = $result[0]['token'] . $passwd . $result[0]['token'];
            $clave = $this->seguridad->encrypt_sha512($cadena);
            if ($clave == $result[0]['password']) {
                return 1; 
            }
            return 2; 
        } else {
            return 3; 
        }
    }

    public function update_password($code = null, $new_password = null)
    {
        $salida = false;
        if ($code != null && $new_password != null)
        {
            $this->db->flush_cache();
            $this->db->reset_query();

            $this->db->select(array(
                'id_usuario', 'token'
            ));
            $this->db->where('recovery_code', $code);
            $this->db->limit(1);
            $resultado = $this->db->get('sistema.usuarios')->result_array();
            //pr($resultado);
            if ($resultado)
            {
                $this->load->library('seguridad');
                $usuario = $resultado[0];
                $this->db->reset_query();
                $pass = $this->seguridad->encrypt_sha512($usuario['token'] . $new_password . $usuario['token']);
                $this->db->where('id_usuario', $usuario['id_usuario']);
                $this->db->set('password', $pass);
                $this->db->set('recovery_code', null);
                $this->db->update('sistema.usuarios');
                //pr($this->db->last_query());
                $salida = true;
            }
        }
        return $salida;
    }


    public function recuperar_password($username) {
                $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->select(array(
            'id_usuario', 'nombre', 'email', 'recovery_code'
        ));
        $this->db->join('censo.docente d', 'd.id_docente = u.id_docente');
        $this->db->where('matricula', $username);
        $this->db->or_where('email', $username);
        $this->db->limit(1);
        $resultado = $this->db->get('sistema.usuarios u')->result_array();

        if ($resultado)
        {
            $usuario = $resultado[0];
            if (empty($usuario['recovery_code']))
            {
                $this->load->library('seguridad');
                $usuario['recovery_code'] = $this->seguridad->crear_token();
                $this->db->reset_query();
                $this->db->where('id_usuario', $usuario['id_usuario']);
                $this->db->set('recovery_code', $usuario['recovery_code']);
                $this->db->update('sistema.usuarios');
                //pr($this->db->last_query());
            }
            $this->send_recovery_mail($usuario);
        }
    }

    private function send_recovery_mail($usuario)
    {
        $this->load->config('email');
        $this->load->library('My_phpmailer');
        $mailStatus = $this->my_phpmailer->phpmailerclass();
        $emailStatus = $this->load->view('sesion/mail_recovery_password.tpl.php', $usuario, true);
//        $mailStatus->addAddress('zurgcom@gmail.com'); //pruebas chris
        $mailStatus->addAddress($usuario['email']);
        $mailStatus->Subject = utf8_decode('Recuperación de contraseña para el Censo de profesores');
        $mailStatus->msgHTML(utf8_decode($emailStatus));
        $mailStatus->send();
    }
}
