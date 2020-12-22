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
     * @return boolean
     */
    public function update(int $id, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        $queryData = [];

        $updateParams = [];

        foreach ($this->fillable as $field) {
            if (array_key_exists($field, $data)) {
                $queryData[$field] = $data[$field];

                $updateParams[] = "{$field} = :{$field}";
            }
        }

        $updateParams = implode(', ', $updateParams);

        $query = self::$DB->query("
            UPDATE {$this->table} SET {$updateParams} WHERE id = {$id}
        ");

        foreach ($queryData as $key => $value) {
            $query->bind(':' . $key, $value);
        }

        return $query->execute();
    }

    /**
     * Delete data from database
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return self::$DB->query("
            DELETE FROM {$this->table} WHERE id = {$id}
        ")->execute();
    }
}
