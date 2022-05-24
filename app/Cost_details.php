<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Cost_details extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'cost_details';
    protected $primaryKey = 'id';
    protected $primaryFilter = 'intval';
    protected $orderBy = 'ASC';
    protected $limit = 0;
    protected $offset = 0;
    protected $whereColumn = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [''];


    public function checkValidation($request)
    {
        return $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
        ]);
    }

    public function getSupplierwiseList($supplierId = 0, $status = '')
    {
        if (intval($supplierId) > 0 && !empty($status)) {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', 'costs.step_id', '=', 'steps.id')
                ->where($this->tableName . '.supplier_id', '=', $supplierId)
                ->where($this->tableName . '.status', '=', $status)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
        } elseif (intval($supplierId) > 0 && $status == '') {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', 'costs.step_id', '=', 'steps.id')
                ->where($this->tableName . '.supplier_id', '=', $supplierId)
//                ->where($this->tableName . '.status', '=', $status)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
        } elseif (intval($supplierId) <= 0 && !empty($status)) {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', 'costs.step_id', '=', 'steps.id')
//                ->where($this->tableName . '.supplier_id', '=', $supplierId)
                ->where($this->tableName . '.status', '=', $status)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
        } else {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', 'costs.step_id', '=', 'steps.id')
//                ->where($this->tableName . '.supplier_id', '=', $supplierId)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
        }
    }
}
