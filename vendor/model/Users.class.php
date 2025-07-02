<?php

/** Defino o local da classe */
namespace vendor\model;

class Users{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

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
        $this->sql = 'SELECT u.user_id,
                             u.nickname,
                             u.office,
                             u.situation_id,
                             s.name as situation_name
                      FROM users u
                      JOIN situations s ON u.situation_id = s.situation_id';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($user_id, $situation_id, $permission_id, $nickname, $name, $date_birth, $office, $ctps, $ctps_serie, $pis, $date_admission, $email, $password, $history)
    {

        /** Parâmetros de entrada */
        $this->user_id = $user_id;
        $this->situation_id = $situation_id;
        $this->permission_id = $permission_id;
        $this->nickname = $nickname;
        $this->name = $name;
        $this->date_birth = $date_birth;
        $this->office = $office;
        $this->ctps = $ctps;
        $this->ctps_serie = $ctps_serie;
        $this->pis = $pis;
        $this->date_admission = $date_admission;
        $this->email = $email;
        $this->password = $password;
        $this->history = $history;

        /** Verifico se é cadastro ou atualização */
        if ($this->user_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO users(user_id, situation_id, permission_id, nickname, name, date_birth, office, ctps, ctps_serie, pis, date_admission, email, password, history) VALUES(:user_id, :situation_id, :permission_id, :nickname, :name, :date_birth, :office, :ctps, :ctps_serie, :pis, :date_admission, :email, :password, :history)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE users SET 
                          situation_id = :situation_id,
                          permission_id = :permission_id,
                          nickname = :nickname,
                          name = :name,
                          date_birth = :date_birth,
                          office = :office,
                          ctps = :ctps,
                          ctps_serie = :ctps_serie,
                          pis = :pis,
                          date_admission = :date_admission,
                          email = :email,
                          password = :password,
                          history = :history
                          WHERE user_id = :user_id';

        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':permission_id', $this->permission_id);
        $this->stmt->bindParam(':nickname', $this->nickname);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':date_birth', $this->date_birth);
        $this->stmt->bindParam(':office', $this->office);
        $this->stmt->bindParam(':ctps', $this->ctps);
        $this->stmt->bindParam(':ctps_serie', $this->ctps_serie);
        $this->stmt->bindParam(':pis', $this->pis);
        $this->stmt->bindParam(':date_admission', $this->date_admission);
        $this->stmt->bindParam(':email', $this->email);
        $this->stmt->bindParam(':password', $this->password);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($user_id)
    {

        /** Parâmetros de entrada */
        $this->user_id = $user_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM users WHERE user_id = :user_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':user_id', $this->user_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($user_id)
    {

        /** Parâmetros de entrada */
        $this->user_id = $user_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM users WHERE user_id = :user_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':user_id', $this->user_id);

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
        $this->sql = 'SELECT * FROM users WHERE email = :email and password = :password ORDER BY user_id DESC LIMIT 1;';

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
    public function history($user_id, $history)
    {

        /** Parâmetros de entrada */
        $this->user_id = $user_id;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE users SET history = :history WHERE user_id = :user_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':user_id', $this->user_id);
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