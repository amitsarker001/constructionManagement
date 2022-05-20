<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Letter extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'letters';
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
    protected $fillable = ['supplier_id', 'entry_date', 'subject', 'description'];


    public function checkValidation($request)
    {
        return $request->validate([
            'description' => ['required', 'string', 'max:255'],
        ]);
    }
}
