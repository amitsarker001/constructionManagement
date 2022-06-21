<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Receive_details extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'receive_details';
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
    protected $fillable = ['entry_date', 'receive_amount', 'money_receipt_no', 'remarks'];


    public function checkValidation($request)
    {
        return $request->validate([
            'receive_amount' => ['required', 'numeric', 'min:0'],
        ]);
    }

    public function getTotalReceiveAmount()
    {
        return DB::table($this->tableName)->sum('receive_amount');
    }
}
