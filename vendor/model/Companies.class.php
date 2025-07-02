<?php

/** Defino o local da classe */
namespace vendor\model;

class Companies{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

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

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function all()
    {

        /** Montagem do SQL */
        $this->sql = 'SELECT
                        c.company_id,
                        c.nickname,
                        c.name_fantasy,
                        c.cnpj,
                        c.responsible,
                        c.responsible_office,
                        s.situation_id,
                        s.name
                      FROM companies c
                      JOIN situations s ON c.situation_id = s.situation_id
                      ORDER BY company_id ASC';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($company_id, $situation_id, $nickname, $name_business, $name_fantasy, $cnpj, $cns, $site, $telephone, $cellphone, $email, $password, $responsible, $responsible_office, $cep, $state_id, $city_id, $district, $complement, $expiration_day, $value_monthly, $stations, $start_contract, $first_payment, $history, $date_register, $date_update)
    {

        /** Parâmetros de entrada */
        $this->company_id = $company_id;
        $this->situation_id = $situation_id;
        $this->nickname = $nickname;
        $this->name_business = $name_business;
        $this->name_fantasy = $name_fantasy;
        $this->cnpj = $cnpj;
        $this->cns = $cns;
        $this->site = $site;
        $this->telephone = $telephone;
        $this->cellphone = $cellphone;
        $this->email = $email;
        $this->password = $password;
        $this->responsible = $responsible;
        $this->responsible_office = $responsible_office;
        $this->cep = $cep;
        $this->state_id = $state_id;
        $this->city_id = $city_id;
        $this->district = $district;
        $this->complement = $complement;
        $this->history = $history;
        $this->expiration_day = $expiration_day;
        $this->value_monthly =  $value_monthly;
        $this->stations = $stations;
        $this->start_contract = $start_contract;
        $this->first_payment = $first_payment;
        $this->date_register = $date_register;
        $this->date_update = $date_update;

        /** Verifico se é cadastro ou atualização */
        if ($this->company_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO companies(company_id, situation_id, nickname, name_business, name_fantasy, cnpj, cns, site, telephone, cellphone, email, password, responsible, responsible_office, cep, state_id, city_id, district, complement, expiration_day, value_monthly, stations, start_contract, first_payment, history, date_register, date_update)
                          VALUES(:company_id, :situation_id, :nickname, :name_business, :name_fantasy, :cnpj, :cns, :site, :telephone, :cellphone, :email, :password, :responsible, :responsible_office, :cep, :state_id, :city_id, :district, :complement, :expiration_day, :value_monthly, :stations, :start_contract, :first_payment, :history, :date_register, :date_update)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE companies SET situation_id = :situation_id, nickname = :nickname, name_business = :name_business, name_fantasy = :name_fantasy, cnpj = :cnpj, cns = :cns, site = :site, telephone = :telephone, cellphone = :cellphone, email = :email, password = :password, responsible = :responsible, responsible_office = :responsible_office, cep = :cep, state_id = :state_id, city_id = :city_id, district = :district, complement = :complement, expiration_day = :expiration_day, value_monthly = :value_monthly, stations = :stations, start_contract = :start_contract, first_payment = :first_payment, history = :history, date_register = :date_register, date_update = :date_update WHERE company_id = :company_id';

        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':company_id', $this->company_id);
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':nickname', $this->nickname);
        $this->stmt->bindParam(':name_business', $this->name_business);
        $this->stmt->bindParam(':name_fantasy', $this->name_fantasy);
        $this->stmt->bindParam(':cnpj', $this->cnpj);
        $this->stmt->bindParam(':cns', $this->cns);
        $this->stmt->bindParam(':site', $this->site);
        $this->stmt->bindParam(':telephone', $this->telephone);
        $this->stmt->bindParam(':cellphone', $this->cellphone);
        $this->stmt->bindParam(':email', $this->email);
        $this->stmt->bindParam(':password', $this->password);
        $this->stmt->bindParam(':responsible', $this->responsible);
        $this->stmt->bindParam(':responsible_office', $this->responsible_office);
        $this->stmt->bindParam(':cep', $this->cep);
        $this->stmt->bindParam(':state_id', $this->state_id);
        $this->stmt->bindParam(':city_id', $this->city_id);
        $this->stmt->bindParam(':district', $this->district);
        $this->stmt->bindParam(':complement', $this->complement);
        $this->stmt->bindParam(':expiration_day', $this->expiration_day);
        $this->stmt->bindParam(':value_monthly', $this->value_monthly);
        $this->stmt->bindParam(':stations', $this->stations);
        $this->stmt->bindParam(':start_contract', $this->start_contract);
        $this->stmt->bindParam(':first_payment', $this->first_payment);
        $this->stmt->bindParam(':history', $this->history);
        $this->stmt->bindParam(':date_register', $this->date_register);
        $this->stmt->bindParam(':date_update', $this->date_update);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($company_id)
    {

        /** Parâmetros de entrada */
        $this->company_id = $company_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM companies WHERE company_id = :company_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':company_id', $this->company_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($company_id)
    {

        /** Parâmetros de entrada */
        $this->company_id = $company_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM companies WHERE company_id = :company_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':company_id', $this->company_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    public function load($company_id)
    {

        /** Parâmetros de entrada */
        $this->company_id = $company_id;

        /** Sql de busca */
        $this->sql = 'SELECT
                      *
                      FROM companies c
                      JOIN company_files cf ON c.company_id = cf.company_id 
                      WHERE c.company_id = :company_id
                      ORDER BY c.company_id
                      LIMIT 1';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':company_id', $this->company_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }


    /** Busco o email e senha */
    public function access($email, $password)
    {

        /** Parâmetros de entrada */
        $this->email = $email;
        $this->password = $password;

        /** Montagem do SQL */
        $this->sql = 'SELECT * FROM companies WHERE email = :email and password = :password ORDER BY company_id DESC LIMIT 1;';

        /** Preparo o Sql para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Adiciono os valores */
        $this->stmt->bindParam(':email', $this->email);
        $this->stmt->bindParam(':password', $this->password);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchObject();

    }

    /** Método para salvar um registro */
    public function history($company_id, $history)
    {

        /** Parâmetros de entrada */
        $this->company_id = $company_id;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE companies SET history = :history WHERE company_id = :company_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':company_id', $this->company_id);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}