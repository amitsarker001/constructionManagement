<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Step extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'steps';
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
    protected $fillable = ['step_name', 'start_date', 'end_date', 'description'];


    public function checkValidation($request)
    {
        return $request->validate([
            'step_name' => ['required', 'string', 'max:255'],
        ]);
    }
}
