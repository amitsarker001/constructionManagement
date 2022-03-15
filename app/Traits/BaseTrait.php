<?php

namespace App\Traits;

use DB;
use Illuminate\Http\Request;

trait BaseTrait
{
    protected $primaryKey = 'id';
    protected $primaryFilter = 'intval';
    protected $orderBy = 'ASC';
    protected $limit = 0;
    protected $offset = 0;
    protected $whereColumn = 'id';

    public function testTrait()
    {
        return 'This is Base Trait';
    }

    /**
     * @param Request using $columnName and $value
     * @return $this|false|true
     */
    public function isColumnValueExist($columnName = '', $value = '', $id = 0)
    {
        if (intval($id) == 0) {
            if ((!empty($columnName) && (!empty($value)))) {
//        $query = DB::select('select * from customers where email = ?', [$value]);
                $query = DB::table($this->tableName)->where($columnName, $value)->first();
//                ->toSql();
                return (!empty($query)) ? TRUE : FALSE;
            } else {
                return TRUE;
            }
        } else {
            if ((!empty($columnName) && (!empty($value)))) {
//        $query = DB::select('select * from customers where email = ?', [$value]);
                $query = DB::table($this->tableName)->where($columnName, $value)->where($this->primaryKey, '!=', $id)->first();
//                ->toSql();
                return (!empty($query)) ? TRUE : FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function getAll()
    {
            $query = DB::table($this->tableName)->get();
            return (!empty($query)) ? $query : null;
    }

    public function getById($id)
    {
        if ((!empty($id) && intval($id) > 0)) {
            $query = DB::table($this->tableName)->where($this->primaryKey, $id)->first();
            return (!empty($query)) ? $query : null;
        } else {
            return null;
        }
    }

    public function getWhere1($id)
    {
        if ((!empty($id) && intval($id) > 0)) {
            $query = DB::table($this->tableName)->where($this->primaryKey, $id)->first();
            return (!empty($query)) ? $query : null;
        } else {
            return null;
        }
    }

    public function getWhere($where = array(), $single = FALSE)
    {
        if (!empty($where)) {
            $method = ($single) ? 'first' : 'get';
            return $query = DB::table($this->tableName)
                ->where($where)
                ->$method();
        } else {
            return null;
        }
    }

    /**
     * @param null $data
     * @return int
     */
    public function saveData($data = null)
    {
        if (!empty($data)) {
            return $this->save($data);
//            return $query =DB::table($this->tableName)->insert($data);
        } else {
            return 0;
        }
    }

    /**
     * @param null $data
     * @param int $id
     * @return bool
     */
    public function updateData($data = null, $id = 0)
    {
        if ((!empty($id) && intval($id) > 0) && !empty($data)) {
            return $query = DB::table($this->tableName)
                ->where($this->primaryKey, $id)
                ->update($data);
        } else {
            return false;
        }
    }

    public function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);

        // OR

        return Schema::getColumnListing($table);

    }

    public function deleteWhere($where = array())
    {
        if (!empty($where)) {
            return $query = DB::table($this->tableName)->where($where)->delete();
        } else {
            return null;
        }
    }

}
