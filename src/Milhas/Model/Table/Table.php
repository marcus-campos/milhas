<?php

namespace Milhas\Model\Table;


abstract class Table
{
    protected $db;
    protected $table;

    /**
     * Table constructor.
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        try
        {
            $this->db = $db;
        }
        catch (\PDOException $ex)
        {
            echo "Erro: ".$ex;
        }
    }

    /**
     * @return array
     */
    public function all()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $query
     * @param array $params
     * @return \PDOStatement
     */
    public function query($query, $params = [])
    {
        $stmt = $this->db->prepare($query);
        //$stmt->bindParam(":id", $id);

        if($params != null && count($params) > 0)
            $stmt->execute($params);
        else
            $stmt->execute();

        return $stmt;
    }

}