<?php

namespace App;

use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Payment extends Model
{
    //
    use BaseTrait;

    protected $tableName = 'payments';
    protected $primaryKey = 'id';
    protected $primaryFilter = 'intval';
    protected $orderBy = 'ASC';
    protected $limit = 0;
    protected $offset = 0;
    protected $whereColumn = 'id';

    public function getPaymentByAssessmentId($assessmentId)
    {
        if (intval($assessmentId) > 0) {
            return $query = DB::table($this->tableName)
                ->leftJoin('assessments', $this->tableName . '.assessment_id', '=', 'assessments.id')
                ->leftJoin('customers', $this->tableName . '.customer_id', '=', 'customers.id')
                ->where($this->tableName . '.assessment_id', '=', $assessmentId)
                ->select($this->tableName . '.*', 'customers.customer_name', 'customers.customer_code', 'assessments.assessment_year')
                ->orderByRaw('created_at DESC')
                ->first();
        }
        return null;
    }
}
