<?php

class Model extends Database
{

    public $errors = array();

    function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . "s";
        }
    }

    public function findAll($order = 'desc')
    {

        $query = "select * from $this->table order by id $order";
        $data = $this->query($query);

        // run after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        return $data;
    }


    public function where($column, $value, $order = 'desc')
    {

        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value order by id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        // run after where
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        return $data;
    }

    public function firstResult($column, $value, $order = 'desc')
    {

        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value order by id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        // run after where
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        if (is_array($data)) {
            $data = $data[0];
        }
        return $data;
    }

    // insert users
    public function insert($data)
    {

        // remove unwanted columns
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        // Functions to run before Inserting Data
        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }


        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);
        $query = "insert into $this->table ($columns) values (:$values) ";
        return $this->query($query, $data);
    }

    // update user
    public function update($id, $data)
    {
        // remove unwanted columns
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        // // Functions to run before updating Data
        if (property_exists($this, 'beforeUpdate')) {
            foreach ($this->beforeUpdate as $func) {
                $data = $this->$func($data);
            }
        }



        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        $data['id'] = $id;
        $query = "update $this->table set $str where id = :id";
        return $this->query($query, $data);
    }

    // delete users
    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }
}
