<?php

/** Defino o local da classe */
namespace vendor\controller\Users;

/** Importação de classes */
use \vendor\controller\main\Main;

class UsersValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $user_id = null;
    private $situation_id = null;
    private $permission_id = null;
    private $nickname = null;
    private $name = null;
    private $date_birth = null;
    private $office = null;
    private $ctps = null;
    private $ctps_serie = null;
    private $pis = null;
    private $date_admission = null;
    private $email = null;
    private $password = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setUserId(int $user_id) : void
    {

        /** Tratamento de dados */
        $this->user_id = isset($user_id) ? $this->main->antiInjection($user_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->user_id < 0) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Usuário ID", deve ser válido');

        }

    }

    public function setSituationId(int $situation_id) : void
    {

        /** Tratamento de dados */
        $this->situation_id = isset($situation_id) ? $this->main->antiInjection($situation_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->situation_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Situação ID", deve ser válido');

        }

    }

    public function setPermissionId(string $permission_id) : void
    {

        /** Tratamento de dados */
        $this->permission_id = isset($permission_id) ? $this->main->antiInjection($permission_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->permission_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Permissão ID", deve ser válido');

        }

    }

    public function setNickname(string $nickname) : void
    {

        /** Tratamento de dados */
        $this->nickname = isset($nickname) ? $this->main->antiInjection($nickname) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->nickname)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Apelido", deve ser válido');

        }

    }

    public function setName(string $name) : void
    {

        /** Tratamento de dados */
        $this->name = isset($name) ? $this->main->antiInjection($name) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->name)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Nome", deve ser válido');

        }

    }

    public function setDateBirth(string $date_birth) : void
    {

        /** Tratamento de dados */
        $this->date_birth = isset($date_birth) ? $this->main->antiInjection($date_birth) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->date_birth)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Data de Nascimento", deve ser válido');

        }

    }

    public function setOffice(string $office) : void
    {

        /** Tratamento de dados */
        $this->office = isset($office) ? $this->main->antiInjection($office) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->office)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Cargo", deve ser válido');

        }

    }

    public function setCtps(string $ctps) : void
    {

        /** Tratamento de dados */
        $this->ctps = isset($ctps) ? $this->main->antiInjection($ctps) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->ctps)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "CTPS", deve ser válido');

        }

    }

    public function setCtpSerie(string $ctps_serie) : void
    {

        /** Tratamento de dados */
        $this->ctps_serie = isset($ctps_serie) ? $this->main->antiInjection($ctps_serie) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->ctps_serie)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "SERIE", deve ser válido');

        }

    }

    public function setPis(string $pis) : void
    {

        /** Tratamento de dados */
        $this->pis = isset($pis) ? $this->main->antiInjection($pis) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->pis)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "PIS", deve ser válido');

        }

    }

    public function setDateAdmission(string $date_admission) : void
    {

        /** Tratamento de dados */
        $this->date_admission = isset($date_admission) ? $this->main->antiInjection($date_admission) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->date_admission)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Data de Admissão", deve ser válido');

        }

    }

    public function setEmail(string $email) : void
    {

        /** Tratamento de dados */
        $this->email = isset($email) ? $this->main->antiInjection($email) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->email)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Email", deve ser válido');

        }

    }

    public function setPassword(string $password) : void
    {

        /** Tratamento de dados */
        $this->password = isset($password) ? $this->main->antiInjection($password) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->password)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Senha", deve ser válido');

        }

    }

    public function setHistory(array $history) : void
    {

        /** Tratamento de dados */
        $this->history = isset($history) ? $this->main->antiInjection($history) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->history)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Histórico", deve ser válido');

        }

    }

    public function getUserId() : string
    {

        return (string)$this->user_id;

    }

    public function getSituationId() : string
    {

        return (string)$this->situation_id;

    }

    public function getPermissionId() : string
    {

        return (string)$this->permission_id;

    }

    public function getNickname() : string
    {

        return (string)$this->nickname;

    }

    public function getName() : string
    {

        return (string)$this->name;

    }

    public function getDateBirth() : string
    {

        return (string)$this->date_birth;

    }

    public function getOffice() : string
    {

        return (string)$this->office;

    }

    public function getCtps() : string
    {

        return (string)$this->ctps;

    }

    public function getCtpSerie() : string
    {

        return (string)$this->ctps_serie;

    }

    public function getPis() : string
    {

        return (string)$this->pis;

    }

    public function getDateAdmission() : string
    {

        return (string)$this->date_admission;

    }

    public function getEmail() : string
    {

        return (string)$this->email;

    }

    public function getPassword() : string
    {

        return (string)$this->password;

    }

    public function getHistory() : array
    {

        return (array)$this->history;

    }

    public function getErrors()
    {

        /** Verifico se deve informar os erros */
        if (count($this->errors)) {

            /** Verifica a quantidade de erros para informar a legenda */
            $this->info = count($this->errors) > 1 ? 'Os seguintes erros foram encontrados:' : 'O seguinte erro foi encontrado:';

            /** Lista os erros  */
            foreach ($this->errors as $keyError => $error) {

                /** Monto a mensagem de erro */
                $this->info .= '</br>' . ($keyError + 1) . ' - ' . $error;

            }

            /** Retorno os erros encontrados */
            return (string)$this->info;

        } else {

            return false;

        }
    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
