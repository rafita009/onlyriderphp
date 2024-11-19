<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\CajasModel;
use App\Models\RolesModel;
use App\Models\LogsModel;



class Usuarios extends BaseController
{
    protected $usuarios, $cajas, $roles;
    protected $reglas, $reglasLogin, $reglasCambia, $reglasUsuario, $logs;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->cajas = new CajasModel();
        $this->roles = new RolesModel();
        $this->logs = new LogsModel();
        helper(['form']);

        $this->reglas = [
            'usuario' => [
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'password' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'repassword' =>  [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'

                ]
            ],
            'nombre' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_caja' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_rol' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
        $this->reglasLogin = [
            'usuario' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} no existe.'
                ]
            ],

            'password' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Contraseña no existe.'
                ]
            ],
        ];
        $this->reglasCambia = [
            'password' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} no existe.'
                ]
            ],

            'repassword' =>  [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
            ],
            
        ];$this->reglasUsuario = [
            'usuario' => [
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'nombre' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
        ];
        
    }

    public function index($activo = 1)
    {
        $this->usuarios->select('usuarios.id, usuarios.usuario, usuarios.nombre, 
        cajas.nombre as caja_nombre, roles.nombre as rol_nombre')
            ->join('cajas as cajas', 'usuarios.id_caja = cajas.id', 'left')
            ->join('roles as roles', 'usuarios.id_rol = roles.id', 'left')
            ->where('usuarios.activo', $activo);

        $usuarios = $this->usuarios->findAll();
        $data = ['titulo' => 'Usuarios', 'datos' => $usuarios];

        echo view('usuarios/usuarios', $data);
    }
    public function eliminados($activo = 0)
    {
        $this->usuarios->select('usuarios.id, usuarios.usuario, usuarios.nombre, 
        cajas.nombre as caja_nombre, roles.nombre as rol_nombre')
            ->join('cajas as cajas', 'usuarios.id_caja = cajas.id', 'left')
            ->join('roles as roles', 'usuarios.id_rol = roles.id', 'left')
            ->where('usuarios.activo', $activo);
        $usuarios = $this->usuarios->findAll();
        $data = ['titulo' => 'Usuarios', 'datos' => $usuarios];

        echo view('usuarios/eliminados', $data);
    }
    public function nuevo()
    {
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();

        $data = ['titulo' => 'Agregar Usuario', 'cajas' => $cajas, 'roles' => $roles];
        echo view('usuarios/nuevo', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglas)) {


            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $this->usuarios->save([
                'usuario' => $this->request->getPost('usuario'),
                'password' => $hash,
                'nombre' => $this->request->getPost('nombre'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol'),
                'activo' => 1

            ]);
            return redirect()->to(base_url() . 'usuarios');
        } else {
            $cajas = $this->cajas->where('activo', 1)->findAll();
            $roles = $this->roles->where('activo', 1)->findAll();
            $data = ['titulo' => 'Agregar Unidad', 'cajas' => $cajas, 'roles' => $roles, 'validation' => $this->validator];
            echo view('usuarios/nuevo', $data);
        }
    }
    public function editar($id, $valid = null)
    {
        $session = session();
        $usuario = $this->usuarios->where('id', $session->id_usuario)->first();

        $datos = $this->usuarios->where('id', $id)->first();
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();
        if ($valid != null) {
            $data = ['titulo' => 'Editar Usuario', 'datos' => $datos, 'cajas' => $cajas, 'roles' => $roles, 'validation' => $this->validator];
        } else {
            $data = ['titulo' => 'Editar Usuario', 'datos' => $datos, 'cajas' => $cajas, 'roles' => $roles, 'usuario' => $usuario];
        }
        echo view('usuarios/editar', $data);
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglasUsuario)) {
            $this->usuarios->update($this->request->getPost('id'), [
                'usuario' => $this->request->getPost('usuario'),
                'nombre' => $this->request->getPost('nombre'),
                'id_caja' => $this->request->getPost('id_caja'),
                'id_rol' => $this->request->getPost('id_rol')

            ]);
            return redirect()->to(base_url() . 'usuarios');
        }else{
            return $this->editar($this->request->getPost('id'),$this->validator);
        }
       
    }
    public function eliminar($id)
    {
        $this->usuarios->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . 'usuarios');
    }
    public function reingresar($id)
    {
        $this->usuarios->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . 'usuarios');
    }
    public function login()
    {
        return view('login');
    }
    public function valida()
    {
        // Verifica si el método es POST y si los datos cumplen con las reglas de validación
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglasLogin)) {
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();

            if ($datosUsuario != null) {
                // Verifica si el campo de contraseña está vacío
                if (empty($password)) {
                    $data['error'] = "La contraseña es requerida";
                    echo view('login', $data);
                } else if (password_verify($password, $datosUsuario['password'])) {
                    // Si el usuario y la contraseña son correctos, se crean los datos de sesión
                    $datosSesion = [
                        'id_usuario' => $datosUsuario['id'],
                        'nombre' => $datosUsuario['nombre'],
                        'id_caja' => $datosUsuario['id_caja'],
                        'id_rol' => $datosUsuario['id_rol'],
                    ];

                    $ip= $_SERVER['REMOTE_ADDR'];
                    $detalles = $_SERVER['HTTP_USER_AGENT'];

                    $this->logs->save([
                        'id_usuario' => $datosUsuario['id'],
                        'evento' => 'Inicio de sesion',
                        'ip' => $ip,
                        'detalles' => $detalles
                    ]);

                    $session = session();
                    $session->set($datosSesion);
                    return redirect()->to(base_url() . 'dashboard');
                } else {
                    // Si la contraseña es incorrecta
                    $data['error'] = "La contraseña es incorrecta";
                    echo view('login', $data);
                }
            } else {
                // Si el usuario no existe
                $data['error'] = "El usuario no existe";
                echo view('login', $data);
            }
        } else {
            // Si hay errores de validación, envía los mensajes de validación a la vista
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }
    public function logout()
    {
        $session = session();
        $ip= $_SERVER['REMOTE_ADDR'];
        $detalles = $_SERVER['HTTP_USER_AGENT'];

        $this->logs->save([
            'id_usuario' => $session->id_usuario,
            'evento' => 'Cierre de sesion',
            'ip' => $ip,
            'detalles' => $detalles
        ]);
        $session->destroy();
        return redirect()->to(base_url());
    }
    public function cambia_password()
    {
        $session = session();
        $usuario = $this->usuarios->where('id', $session->id_usuario)->first();

        $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario];
        return view('usuarios/cambia_password', $data);
    }
    public function actualizar_password()
    {
        if ($this->request->getMethod() == "POST" && $this->validate($this->reglasCambia)) {

            $session = session();
            $idUsuario = $session->id_usuario;

            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $this->usuarios->update($idUsuario, ['password' => $hash]);


            $usuario = $this->usuarios->where('id', $session->id_usuario)->first();
            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'mensaje' => 'Contraseña actualizada correctamente'];

            return redirect()->to(base_url() . 'usuarios');
        } else {
            $session = session();
            $usuario = $this->usuarios->where('id', $session->id_usuario)->first();

            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'validation' => $this->validator];
            return view('usuarios/cambia_password', $data);
        }
    }
}
