<?php

/** Defino o local da classe */

namespace vendor\controller\Companies;

/** Importação de classes */
use \vendor\controller\main\Main;

class CompaniesValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $company_id = null;
    private $situation_id = null;
    private $nickname = null;
    private $name_business = null;
    private $name_fantasy = null;
    private $cnpj = null;
    private $cns = null;
    private $site = null;
    private $telephone = null;
    private $cellphone = null;
    private $email = null;
    private $password = null;
    private $responsible = null;
    private $responsible_office = null;
    private $cep = null;
    private $state_id = null;
    private $city_id = null;
    private $district = null;
    private $complement = null;
    private $expiration_day = null;
    private $value_monthly = null;
    private $stations = null;
    private $start_contract = null;
    private $first_payment = null;
    private $history = null;
    private $date_register = null;
    private $date_update = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setCompanyId(int $company_id)
    {

        /** Validação de dados */
        $this->company_id = isset($company_id) ? $this->main->antiInjection($company_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->company_id < 0) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "CompanyID", deve ser válido');

        }

    }

    public function setSituationId(int $situation_id)
    {

        /** Validação de dados */
        $this->situation_id = isset($situation_id) ? $this->main->antiInjection($situation_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->situation_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Situação", deve ser válido');

        }

    }

    public function setNickname(string $nickname)
    {

        /** Validação de dados */
        $this->nickname = isset($nickname) ? $this->main->antiInjection($nickname) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->nickname)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Apelido", deve ser válido');

        }

    }

    public function setNameBusiness(string $name_business)
    {

        $this->name_business = isset($name_business) ? $this->main->antiInjection($name_business) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->name_business)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Nome Empresarial", deve ser válido');

        }

    }

    public function setNameFantasy(string $name_fantasy)
    {

        $this->name_fantasy = isset($name_fantasy) ? $this->main->antiInjection($name_fantasy) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->name_fantasy)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Nome Fantasia", deve ser válido');

        }

    }

    public function setCnpj(string $cnpj)
    {

        $this->cnpj = isset($cnpj) ? $this->main->antiInjection($this->main->removeMask($cnpj)) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->cnpj)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "CNPJ", deve ser válido');

        }

    }

    public function setCns(string $cns)
    {

        $this->cns = isset($cns) ? $this->main->antiInjection($cns) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->cns)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "CNS", deve ser válido');

        }

    }

    public function setSite(string $site)
    {

        $this->site = isset($site) ? $this->main->antiInjection($site) : null;

    }

    public function setTelephone(string $telephone)
    {

        $this->telephone = isset($telephone) ? $this->main->antiInjection($this->main->removeMask($telephone)) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->telephone)) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Telefone", deve ser válido');

        }

    }

    public function setCellphone(string $cellphone)
    {

        $this->cellphone = isset($cellphone) ? $this->main->antiInjection($this->main->removeMask($cellphone)) : null;

    }

    public function setEmail(string $email)
    {

        $this->email = isset($email) ? $this->main->antiInjection($email) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->email)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "E-MAIL", deve ser válido');

        }

    }

    public function setPassword(string $password)
    {

        $this->password = isset($password) ? $this->main->antiInjection($password) : null;

    }

    public function setResponsible(string $responsible)
    {

        $this->responsible = isset($responsible) ? $this->main->antiInjection($responsible) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->responsible)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Responsável do Cartorio", deve ser válido');

        }

    }

    public function setResponsibleOffice(string $responsible_office)
    {

        $this->responsible_office = isset($responsible_office) ? $this->main->antiInjection($responsible_office) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->responsible_office)) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Cargo do Responsável", deve ser válido');

        }

    }

    public function setCep(string $cep)
    {

        $this->cep = isset($cep) ? $this->main->antiInjection($cep) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->cep)) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "CEP", deve ser válido');

        }

    }

    public function setStateId(string $state_id)
    {

        $this->state_id = isset($state_id) ? $this->main->antiInjection($state_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->state_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Estado", deve ser válido');

        }

    }

    public function setCityId(string $city_id)
    {

        $this->city_id = isset($city_id) ? $this->main->antiInjection($city_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->city_id <= 0) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Cidade", deve ser válido');

        }

    }

    public function setDistrict(string $district)
    {

        $this->district = isset($district) ? $this->main->antiInjection($district) : null;

    }

    public function setComplement(string $complement)
    {

        $this->complement = isset($complement) ? $this->main->antiInjection($complement) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->complement)) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Complemento", deve ser válido');

        }

    }

    public function setExpirationDay(int $expiration_day) : void
    {

        $this->expiration_day = isset($expiration_day) ? $this->main->antiInjection($expiration_day) : null;

    }

    public function setValueMonthly(string $value_monthly) : void
    {
        /**removo do valor a formatação de tela do form */
        $value_monthly = $this->main->removeMask($value_monthly);

        $this->value_monthly = isset($value_monthly) ? $this->main->antiInjection($value_monthly) : null;
        
    }

    public function setStations(int $stations) : void
    {

        $this->stations = isset($stations) ? $this->main->antiInjection($stations) : null;

    }

    public function setStartContract(string $start_contract) : void
    {

        $this->start_contract = isset($start_contract) ? $this->main->antiInjection($start_contract) : null;

    }

    public function setFirstPayment(string $first_payment) : void
    {

        $this->first_payment = isset($first_payment) ? $this->main->antiInjection($first_payment) : null;

    }


    public function setHistory(string $history)
    {

        $this->history = isset($history) ? $this->main->antiInjection($history) : null;

    }

    public function setDateRegister(string $date_register)
    {

        $this->date_register = isset($date_register) ? $this->main->antiInjection($date_register) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->date_register)) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Data Registro", deve ser válido');

        }

    }

    public function setDateUpdate(string $date_update)
    {

        $this->date_update = isset($date_update) ? $this->main->antiInjection($date_update) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->date_update)) {

            /** Adição de elemento */
            array_push($this->errors,'O campo "Data do vencimento", deve ser válido');

        }

    }

    public function getCompanyId(): int
    {

        return (int)$this->company_id;

    }

    public function getSituationId(): int
    {

        return (int)$this->situation_id;

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

    public function getCns(): string
    {

        return (string)$this->cns;

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

    public function getPassword(): string
    {

        return (string)$this->password;

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

    public function getStateId(): string
    {

        return (string)$this->state_id;

    }

    public function getCityId(): string
    {

        return (string)$this->city_id;

    }

    public function getDistrict(): string
    {

        return (string)$this->district;

    }

    public function getComplement(): string
    {

        return (string)$this->complement;

    }

    public function getExpirationDay(): int
    {

        return (int)$this->expiration_day;

    }

    public function getValueMonthly(): float
    {

        return (string)$this->value_monthly;

    }

    public function getStations(): int
    {

        return (int)$this->stations;

    }

    public function getStartContract(): string
    {

        return (string)$this->start_contract;

    }

    public function getFirstPayment(): string
    {

        return (string)$this->first_payment;

    }

    public function getHistory(): string
    {

        return (string)$this->history;

    }

    public function getDateRegister(): string
    {

        return (string)$this->date_register;

    }

    public function getDateUpdate(): string
    {

        return (string)$this->date_update;

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
