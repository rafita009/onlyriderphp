<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleRolesPermisosModel extends Model
{
    protected $table = 'detalle_roles_permisos';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_rol', 'id_permiso'];

    protected $useTimestamps = false;

    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';


    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function __construct()
    {
        parent::__construct();
    }
    public function verificaPermisos($idRol, $permiso)
    {
        $tieneacceso = false;
        $this->select('*');
        $this->join('permisos', 'detalle_roles_permisos.id_permiso = permisos.id');
        $existe = $this->where(['id_rol' => $idRol, 'permisos.nombre' => $permiso])->first();

        echo $this->getLastQuery();
        if ($existe != null) {
            $tieneacceso = true;
        }
        return $tieneacceso;
    }
}
