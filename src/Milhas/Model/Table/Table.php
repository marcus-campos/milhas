<?php

namespace Milhas\Model\Table;


abstract class Table
{
    protected $db;
    protected $table;
    protected $fillable;

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

    /**
     * @param $values
     * @return mixed
     */
    public function insert($values)
    {
        $query = "INSERT INTO {$this->table} ({$this->fillableString()}) VALUES ({$this->bindString($values)})";

        $stmt = $this->db->prepare($query);
        $stmt->execute($values);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $values
     * @return string
     */
    public function bindString($values)
    {
        $bindString = '';
        foreach ($values as $key => $value) {
            if ($bindString == '')
                $bindString .= ':'.$key;
            else
                $bindString .= ', :'.$key;
        }

        return $bindString;
    }

    /**
     * @param $stmt
     * @param $values
     * @return mixed
     */
    public function bindParams($stmt, $values)
    {
        foreach ($values as $key => $value)
            $stmt->bindParam(":".$key, $value);

        return $stmt;
    }

    /**
     * @return string
     */
    public function fillableString()
    {
        $fillableString = '';
        foreach ($this->fillable as $value) {
            if ($fillableString == '')
                $fillableString .= $value;
            else
                $fillableString .= ', ' . $value;
        }

        return $fillableString;
    }
}