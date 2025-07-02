<?php

/** Defino o local da classe */
namespace vendor\model;

class UsersFiles{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $user_file_id = null;
    private $user_id = null;
    private $name = null;
    private $path = null;
    private $extension = null;
    private $history = null;

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function All(int $user_id)
    {

        /** Parâmetros de entrada */
        $this->user_id = $user_id;

        /** Montagem do SQL */
        $this->sql = 'SELECT * FROM users_files WHERE user_id = :user_id';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':user_id', $this->user_id);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function Save($user_file_id, $user_id, $name, $path, $extension, $history)
    {

        /** Parâmetros de entrada */
        $this->user_file_id = $user_file_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->path = $path;
        $this->extension = $extension;
        $this->history = $history;

        /** Sql para inserção */
        $this->sql = 'INSERT INTO users_files(user_file_id, user_id, name, path, extension, history) VALUES(:user_file_id, :user_id, :name, :path, :extension, :history)';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':user_file_id', $this->user_file_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':path', $this->path);
        $this->stmt->bindParam(':extension', $this->extension);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function Get($user_file_id)
    {

        /** Parâmetros de entrada */
        $this->user_file_id = $user_file_id;

        /** Sql de busca */
        $this->sql = 'SELECT uf.user_file_id,
                             uf.user_id,
                             uf.name,
                             uf.path,
                             uf.extension,
                             uf.history,
                             u.nickname,
                             u.email
                      FROM users_files uf
                      JOIN users u ON uf.user_id = u.user_id
                      WHERE uf.user_file_id = :user_file_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':user_file_id', $this->user_file_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    public function Delete($user_file_id)
    {

        /** Parâmetros de entrada */
        $this->user_file_id = $user_file_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM users_files WHERE user_file_id = :user_file_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':user_file_id', $this->user_file_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    /** Método para salvar um registro */
    public function SaveHistory($user_file_id, $history)
    {

        /** Parâmetros de entrada */
        $this->user_file_id = $user_file_id;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE users_files SET history = :history WHERE user_file_id = :user_file_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':user_file_id', $this->user_file_id);
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