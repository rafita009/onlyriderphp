<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\PermisosModel;
use App\Models\DetalleRolesPermisosModel;

class Roles extends BaseController
{
    protected $roles, $permisos, $detalleRoles;
    protected $reglas;

    public function __construct()
    {
        $this->roles = new RolesModel();
        $this->permisos = new PermisosModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo rol es obligatorio.'
                ]
            ],
           
        ];
    }

    public function index($activo = 1)
    {
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Roles', 'datos' => $roles];

        echo view('roles/roles', $data);
    }
    public function eliminados($activo = 0)
    {
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Roles eliminados', 'datos' => $roles];

        echo view('roles/eliminados', $data);
    }
    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Rol'];
        echo view('roles/nuevo', $data);
    }
    public function insertar()
    {       
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {
            $this->roles->save(['nombre' => $this->request->getPost('nombre')]);
            return redirect()->to(base_url() . 'roles');
        } else {
            $data = ['titulo' => 'Agregar Unidad', 'validation' => $this->validator];
            echo view('roles/nuevo', $data);
        }
    }
    public function editar($id, $valid=null)
    {
        $unidad = $this->roles->where('id', $id)->first();

        if($valid !=null){
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad, 'validation'=> $valid];
        }else{
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad];
        }
        echo view('roles/editar', $data);
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {

            $this->roles->update($this->request->getPost('id'), ['nombre' =>
            $this->request->getPost('nombre')]);
            return redirect()->to(base_url() . 'roles');
        }else{
            return $this->editar($this->request->getPost('id'),$this->validator);
        }
    }
    public function eliminar($id)
    {
        $this->roles->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'roles');
    }
    public function reingresar($id)
    {
        $this->roles->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . 'roles');
    }
    public function detalles($idRol) {
        // Obtener todos los permisos disponibles
        $permisos = $this->permisos->findAll();
        
        // Obtener los permisos ya asignados para este rol
        $permisosAsignados = $this->detalleRoles->where('id_rol', $idRol)->findAll();
        
        // Convertir los permisos asignados a un array simple de ids
        $idsPermisosAsignados = array_column($permisosAsignados, 'id_permiso');
        
        $data = [
            'titulo' => 'Asignar Permisos', 
            'permisos' => $permisos, 
            'id_rol' => $idRol,
            'permisosAsignados' => $idsPermisosAsignados
        ];
        
        echo view('roles/detalles', $data);
    }   
    public function guardaPermisos()
    {
        // Debug para ver el método de la petición
        log_message('debug', 'Método de la petición: ' . $this->request->getMethod());
        
        // Cambiamos la verificación para que no sea sensible a mayúsculas/minúsculas
        if (strtolower($this->request->getMethod()) === 'post') {
            $idRol = $this->request->getPost('id_rol');
            $permisos = $this->request->getPost('permisos');
            
            // Debug para ver los datos recibidos
            log_message('debug', 'ID Rol: ' . $idRol);
            log_message('debug', 'Permisos recibidos: ' . print_r($permisos, true));
            
            if (empty($idRol)) {
                return redirect()->back()->with('error', 'No se recibió el ID del rol');
            }
            
            if (empty($permisos) || !is_array($permisos)) {
                return redirect()->back()->with('error', 'No se seleccionaron permisos');
            }
            
            try {
                // Eliminamos permisos existentes
                $this->detalleRoles->where('id_rol', $idRol)->delete();
                
                // Guardamos los nuevos permisos
                foreach ($permisos as $permiso) {
                    $data = [
                        'id_rol' => (int)$idRol,
                        'id_permiso' => (int)$permiso
                    ];
                    
                    $inserted = $this->detalleRoles->insert($data);
                    
                    if (!$inserted) {
                        log_message('error', 'Error al insertar permiso: ' . print_r($this->detalleRoles->errors(), true));
                        return redirect()->back()->with('error', 'Error al guardar los permisos');
                    }
                }
                
                return redirect()->back()->with('mensaje', 'Permisos guardados correctamente');
                
            } catch (\Exception $e) {
                log_message('error', 'Error al guardar permisos: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error al guardar los permisos: ' . $e->getMessage());
            }
        }
        
        return redirect()->back()->with('error', 'Método no permitido - Método actual: ' . $this->request->getMethod());
    }
}


