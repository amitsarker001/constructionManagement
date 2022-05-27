<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Budget extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'budgets';
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
    protected $fillable = ['cash_amount', 'extra_amount_claimed', 'total_allocated_funds', 'funds_remaining', 'entry_date'];


    public function checkValidation($request)
    {
        return $request->validate([
            'cash_amount' => ['required', 'numeric'],
        ]);
    }
}
