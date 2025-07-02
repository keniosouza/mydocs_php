<?php

/** Defino o local da classes */
namespace vendor\controller\configurations;

/** Importação de classes */
use vendor\controller\main\Main;

class ConfigurationsValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();

    private $configuration_id = null;
    private $nickname = null;
    private $name_business = null;
    private $name_fantasy = null;
    private $cnpj = null;
    private $site = null;
    private $telephone = null;
    private $cellphone = null;
    private $email = null;
    private $responsible = null;
    private $responsible_office = null;
    private $cep = null;
    private $state_id = null;
    private $city_id = null;
    private $complement = null;
    private $preferences = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setConfigurationId(int $configuration_id)
    {

        /** Validação de dados */
        $this->configuration_id = isset($configuration_id) ? $this->Main->antiInjection($configuration_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->configuration_id < 0) {

            /** Adição de elemento */
            array_push($this->errors, array('company_id', 'O campo "Configuração ID", deve ser válido'));

        }

    }

    public function setNickname(string $nickname)
    {

        /** Validação de dados */
        $this->nickname = isset($nickname) ? $this->Main->antiInjection($nickname) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->nickname)) {

            /** Adição de elemento */
            array_push($this->errors, array('nickname', 'O campo "Apelido", deve ser preenchido'));

        }

    }

    public function setNameBusiness(string $name_business)
    {

        $this->name_business = isset($name_business) ? $this->Main->antiInjection($name_business) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->name_business)) {

            /** Adição de elemento */
            array_push($this->errors, array('name_business', 'O campo "Nome Empresarial", deve ser preenchido'));

        }

    }

    public function setNameFantasy(string $name_fantasy)
    {

        $this->name_fantasy = isset($name_fantasy) ? $this->Main->antiInjection($name_fantasy) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->name_fantasy)) {

            /** Adição de elemento */
            array_push($this->errors, array('name_fantasy', 'O campo "Nome Fantasia", deve ser preenchido'));

        }

    }

    public function setCnpj(string $cnpj)
    {

        $this->cnpj = isset($cnpj) ? $this->Main->antiInjection($this->Main->removeMask($cnpj)) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->cnpj)) {

            /** Adição de elemento */
            array_push($this->errors, array('cnpj', 'O campo "CNPJ", deve ser preenchido'));

        }

    }

    public function setSite(string $site)
    {

        $this->site = isset($site) ? $this->Main->antiInjection($site) : null;

    }

    public function setTelephone(string $telephone)
    {

        $this->telephone = isset($telephone) ? $this->Main->antiInjection($this->Main->removeMask($telephone)) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->telephone)) {

            /** Adição de elemento */
            array_push($this->errors, array('telephone', 'O campo "Telefone", deve ser preenchido'));

        }

    }

    public function setCellphone(string $cellphone)
    {

        $this->cellphone = isset($cellphone) ? $this->Main->antiInjection($this->Main->removeMask($cellphone)) : null;

    }

    public function setEmail(string $email)
    {

        $this->email = isset($email) ? $this->Main->antiInjection($email) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->email)) {

            /** Adição de elemento */
            array_push($this->errors, array('email', 'O campo "Email", deve ser preenchido'));

        }

    }

    public function setResponsible(string $responsible)
    {

        $this->responsible = isset($responsible) ? $this->Main->antiInjection($responsible) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->responsible)) {

            /** Adição de elemento */
            array_push($this->errors, array('responsible', 'O campo "Responsável", deve ser preenchido'));

        }

    }

    public function setResponsibleOffice(string $responsible_office)
    {

        $this->responsible_office = isset($responsible_office) ? $this->Main->antiInjection($responsible_office) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->responsible_office)) {

            /** Adição de elemento */
            array_push($this->errors,
                array('responsible_office', 'O campo "Cargo do Responsável", deve ser preenchido'));

        }

    }

    public function setCep(string $cep)
    {

        $this->cep = isset($cep) ? $this->Main->antiInjection($cep) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->cep)) {

            /** Adição de elemento */
            array_push($this->errors, array('cep', 'O campo "CEP", deve ser preenchido'));

        }

    }

    public function setStateId(int $stateId): void
    {

        $this->state_id = isset($stateId) ? $this->Main->antiInjection($stateId) : null;

        /** Verificação dos dados de entrada */
        if ($this->state_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors, array('state_id', 'O campo "Estado", deve ser preenchido'));

        }

    }

    public function setCityId(int $cityId)
    {

        $this->city_id = isset($cityId) ? $this->Main->antiInjection($cityId) : null;

        /** Verificação dos dados de entrada */
        if ($this->city_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors, array('city_id', 'O campo "Cidade", deve ser preenchido'));

        }

    }

    public function setComplement(string $complement)
    {

        $this->complement = isset($complement) ? $this->Main->antiInjection($complement) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->complement)) {

            /** Adição de elemento */
            array_push($this->errors, array('complement', 'O campo "Complemento", deve ser preenchido'));

        }

    }

    public function setPreferences($preferences)
    {

        $this->preferences = isset($preferences) ? $this->Main->antiInjection($preferences) : null;

    }

    public function setHistory($history)
    {

        $this->history = isset($history) ? $this->Main->antiInjection($history) : null;

    }

    public function getConfigurationId(): int
    {

        return (int)$this->configuration_id;

    }

    public function getNickname(): string
    {

        return (string)$this->nickname;

    }

    public function getNameBusiness(): string
    {

        return (string)$this->name_business;

    }

    public function getNameFantasy(): string
    {

        return (string)$this->name_fantasy;

    }

    public function getCnpj(): string
    {

        return (string)$this->cnpj;

    }

    public function getSite(): string
    {

        return (string)$this->site;

    }

    public function getTelephone(): string
    {

        return (string)$this->telephone;

    }

    public function getCellphone(): string
    {

        return (string)$this->cellphone;

    }

    public function getEmail(): string
    {

        return (string)$this->email;

    }

    public function getResponsible(): string
    {

        return (string)$this->responsible;

    }

    public function getResponsibleOffice(): string
    {

        return (string)$this->responsible_office;

    }

    public function getCep(): string
    {

        return (string)$this->cep;

    }

    public function getStateId(): int
    {

        return (int)$this->state_id;

    }

    public function getCityId(): int
    {

        return (int)$this->city_id;

    }

    public function getComplement(): string
    {

        return (string)$this->complement;

    }

    public function getPreferences()
    {

        return $this->preferences;

    }

    public function getHistory()
    {

        return $this->history;

    }

    public function getErrors()
    {

        return $this->errors;

    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->Main = null;

    }

}