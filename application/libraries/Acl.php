<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ACL
 *
 * @author valentin
 */
class Acl {
    public function __construct()
    {
        $this->ci =& get_instance(); 
    }
    
    public function get_menu_id($menu_title)
    {
        $this->ci->db->select('id');
        $this->ci->db->from('menu');
        $this->ci->db->where('title',$menu_title);
        return $this->ci->db->get()->row(0)->id;
    }
    
    public function tienePermisoAcceso ($menu_title = null)
    {
        if($menu_title === null)
        {
            return FALSE;
        }
        $menu_id = $this->get_menu_id($menu_title);
        $group_id = $this->ci->ion_auth->get_group_id();
        $this->ci->db->select('access');
        $this->ci->db->from('permisos');
        $this->ci->db->where('menu_id',$menu_id);
        $this->ci->db->where('group_id',$group_id);
        return $this->ci->db->get()->row_array()['access'];
    }
    
    public function modificarCRUD($crud, $menu_title)
    {
        $group_id = $this->ci->ion_auth->get_group_id();
        $menu_id = $this->get_menu_id($menu_title);
        $permisos = $this->ci->db->get_where('permisos',array('group_id' => $group_id, 'menu_id' => $menu_id))->row(0);
        if (!$permisos->crud_see) {
            $crud->unset_read();
        }
        if (!$permisos->crud_add) {
            $crud->unset_add();
        }
        if (!$permisos->crud_modify) {
            $crud->unset_edit();
        }
        if (!$permisos->crud_delete) {
            $crud->unset_delete();
        }
        if (!$permisos->crud_export) {
            $crud->unset_export();
        }
        if (!$permisos->crud_print) {
            $crud->unset_print();
        }
    }

    public function permisosDelMenuTitulo($menuTitle=null)
    {
        if($menuTitle == null)
        {
            return FALSE;
        }
        $idGrupo = $this->ci->ion_auth->get_group_id();
        $sql = "SELECT * FROM permisos AS p, menu AS m WHERE p.menu_id = m.id AND p.group_id = ".$idGrupo." AND m.title ='".$menuTitle."'";
        $resultado = $this->ci->db->query($sql)->result_array();
        if (count($resultado)>0)
        {
            foreach ($resultado[0] as $nombreCampo => $dato) {
                if(strpos($nombreCampo, 'crud_') == 0)
                    $resultado[0][$nombreCampo]=($dato!='0');
            }
            return $resultado[0];
        }
        else
            return FALSE;
     }
}