<?php

namespace Core;

/**
 *
 * Base model
 *
 */
class Model
{
    protected static $DB = null;

    protected $className = null;

    protected $fillable = [];

    public function __construct()
    {
        self::$DB = DB::getInstance();

        self::$DB->setCurrentModelName(get_class($this));
    }

    /**
     * Get all rows from specified model
     *
     * @param string $columns specify which columns to query
     * @return array|null
     */
    public function getAll($columns = '')
    {
        if($columns !== '') {
            $data = self::$DB->query("SELECT {$columns} FROM ".$this->table)->get();
        } else {
            $data = self::$DB->query('SELECT * FROM '.$this->table)->get();
        }

        return $data;
    }

    /**
     * Store data in database
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $queryData = [];
        foreach ($this->fillable as $field) {
            if (array_key_exists($field, $data)) {
                $queryData[$field] = $data[$field];
            }
        }

        $fields = array_keys($queryData);
        $insertFields = implode(', ', $fields);
        $insertValues = ':' . implode(', :', $fields);

        $query = self::$DB->query("INSERT INTO {$this->table} ({$insertFields}) VALUES ({$insertValues})");

        foreach ($queryData as $key => $value) {
            $query->bind(':' . $key, $value);
        }

        return $query->execute();
    }

    /**
     * Update data in database
     *
     * @param array $data
     * @param int $id
     *
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $queryData = [];

        if (!empty($data)) {
            foreach ($this->fillable as $field) {
                if (array_key_exists($field, $data)) {
                    $queryData[$field] = $data[$field];
                }
            }
        }

        $queryData = array_map(function ($field){
            return "{$field} = :{$field}";
        }, $queryData);


        $updateParams = implode(', ', $queryData);

        dd($updateParams);
        $query = App::get('db')->query("
            UPDATE {$this->table} SET {$updateParams} WHERE id = {$this->id}
        ");

        foreach ($this->fillable as $field) {
            $query->bind(':' . $field, $this->$field);
        }

        return $query->execute();
    }

    /**
     * Delete data from database
     *
     * @return bool
     */
    public function delete()
    {
        return App::get('db')->query("
            DELETE FROM {$this->table} WHERE id = {$this->id}
        ")->execute();
    }
}
