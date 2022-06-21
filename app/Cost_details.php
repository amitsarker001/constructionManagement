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

    public function getCostDetailsByCostId($costId)
    {
        if (intval($costId) > 0) {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', 'costs.step_id', '=', 'steps.id')
                ->where($this->tableName . '.cost_id', '=', $costId)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
        }
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

//    public function update_order_details($sale_order_id, $order_details) {
//        $order_details_ids = array();
//        if (intval($sale_order_id) > 0 && !empty($order_details)) {
//            foreach ($order_details as $order) {
//                $order = !is_array($order) ? (array) $order : $order;
//                $order_details_id = intval($order['id']);
//                $details = $this->get_by_id($order_details_id);
//                if (!empty($details)) {
//                    //update
//                    $this->update_data($order);
//                } else {
//                    //insert
//                    $order['sales_orders_id'] = $sale_order_id;
//                    $order_details_id = $this->insert_data($order);
//                }
//                array_push($order_details_ids, $order_details_id);
//            }
//            return $this->delete_order_details($sale_order_id, $order_details_ids);
//        } else {
//            return false;
//        }
//    }
    public function getStepwiseCostDetailsList($stepId = 0)
    {
        if (intval($stepId) > 0) {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
//                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', $this->tableName.'.step_id', '=', 'steps.id')
                ->where($this->tableName . '.step_id', '=', $stepId)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
//                ->toSql();
        }
    }

    public function getItemwiseCostDetailsList($itemId = 0)
    {
        if (intval($itemId) > 0) {
            return $query = DB::table($this->tableName)
                ->leftJoin('suppliers', $this->tableName . '.supplier_id', '=', 'suppliers.id')
                ->leftJoin('items', $this->tableName . '.item_id', '=', 'items.id')
//                ->leftJoin('costs', $this->tableName . '.cost_id', '=', 'costs.id')
                ->leftJoin('steps', $this->tableName.'.step_id', '=', 'steps.id')
                ->where($this->tableName . '.item_id', '=', $itemId)
                ->orderByRaw('created_at DESC')
                ->select($this->tableName . '.*', 'items.item_name', 'steps.step_name', 'suppliers.supplier_name')
                ->get();
//                ->toSql();
        }
    }

}
