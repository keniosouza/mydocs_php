<?php

/** Defino o local da classe */
namespace vendor\controller\Permissions;

/** Importação de classes */
use \vendor\controller\main\Main;

class PermissionsValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();

    private $permission_id = null;
    private $name = null;
    private $permissions = null;
    private $date_register = null;
    private $date_update = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setPermissionId(int $permission_id)
    {

        $this->permission_id = isset($permission_id) ? $this->main->antiInjection($permission_id) : null;

    }

    public function setName($name)
    {

        $this->name = isset($name) ? $this->main->antiInjection($name) : null;

    }

    public function setPermissions($permissions)
    {

        $this->permissions = isset($permissions) ? $this->main->antiInjection($permissions) : null;

    }

    public function setDateRegister($date_register)
    {

        $this->date_register = isset($date_register) ? $this->main->antiInjection($date_register) : null;

    }

    public function setDateUpdate($date_update)
    {

        $this->date_update = isset($date_update) ? $this->main->antiInjection($date_update) : null;

    }

    public function getPermissionId() : int
    {

        return (int)$this->permission_id;

    }

    public function getName()
    {

        return $this->name;

    }

    public function getPermissions()
    {

        return $this->permissions;

    }

    public function getDateRegister()
    {

        return $this->date_register;

    }

    public function getDateUpdate()
    {

        return $this->date_update;

    }

    public function getErrors()
    {

        return $this->errors;

    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
