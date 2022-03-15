<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Supplier extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'suppliers';
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
    protected $fillable = ['supplier_name', 'address', 'is_active'];


    public function checkValidation($request)
    {
        return $request->validate([
            'supplier_name' => ['required', 'string', 'max:255'],
        ]);
    }
}
