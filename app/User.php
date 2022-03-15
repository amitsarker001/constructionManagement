<?php

namespace App;


use DB;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class User extends Model
{
//    use Notifiable;
    use BaseTrait;

    protected $tableName = 'users';
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
    protected $fillable = [
        'user_name', 'email', 'mobile', 'user_type_id', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkRegistrationValidation($request)
    {
        return $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255'],
            'user_type_id' => ['required', 'integer', 'max:11'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:5'],
            'confirm_password' => ['required', 'string', 'min:5'],
        ]);
    }

    public function checkRegistrationValidationForUpdate($request)
    {
        return $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255'],
            'user_type_id' => ['required', 'integer', 'max:11'],
            'address' => ['required', 'string', 'max:255'],
//            'password' => ['required', 'string', 'min:5'],
//            'confirm_password' => ['required', 'string', 'min:5'],
        ]);
    }

    public function checkUserProfileValidation($request)
    {
        return $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:5'],
            'confirm_password' => ['required', 'string', 'min:5'],
        ]);
    }

    public function checkSigninValidation($request)
    {
        return $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5'],
        ]);
    }

    public function changePasswordValidation($request)
    {
        return $request->validate([
            'current_password' => ['required', 'string', 'min:5'],
            'new_password' => ['required', 'string', 'min:5'],
            'confirm_password' => ['required', 'string', 'min:5'],
        ]);
    }

    public function getUserTypeArray()
    {
        return array(
            '1' => 'Admin',
            '2' => 'Others',
            '3' => 'Super Admin'
        );
    }

    public function getUserInfoByEmailAndPassword($email, $passwordPlain)
    {
        try {
            //        echo $a = passwordEncrypt($password);
//        getPrintr(passwordDecrypt($a));
//        DB::enableQueryLog(); // Enable query log
// Your Eloquent query executed by using get()
//        dd(DB::getQueryLog()); // Show results of log
            if ((!empty($email) && (!empty($passwordPlain)))) {
//        $query = DB::select('select * from users where email = ?', [$value]);
                $query = DB::table($this->tableName)->where('email', '=', $email)
                    ->where('password', '=', passwordEncrypt($passwordPlain))
                    ->where('is_active', '=', 1)
                    ->first();
//                ->toSql();
//            getPrintr(DB::getQueryLog());
                return (!empty($query)) ? $query : null;
            } else {
                return null;
            }
        } catch (Exception $exception) {
            return null;
        }
    }

    public function setUserSession($userInfo)
    {
        try {
            if (request()->session()->has('userSession')) {
                request()->session()->forget('userSession');
            }
            return request()->session()->put('userSession', $userInfo);
        } catch (Exception $exception) {

        }
    }

    public function getUserSession()
    {
        try {
            if (request()->session()->has('userSession')) {
                return request()->session()->get('userSession');
            }
            return null;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getLoggedinUserId()
    {
        try {
            $userSession = $this->getUserSession();
            if (!empty($userSession)) {
                return intval($userSession->id);
            }
            return null;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getLoggedinUserTypeId()
    {
        try {
            $userSession = $this->getUserSession();
            if (!empty($userSession)) {
                return intval($userSession->user_type_id);
            }
            return null;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getLoggedinUserName()
    {
        try {
            $userSession = $this->getUserSession();
            if (!empty($userSession)) {
                return $userSession->user_name;
            }
            return null;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getLoggedinUserEmail()
    {
        try {
            $userSession = $this->getUserSession();
            if (!empty($userSession)) {
                return $userSession->email;
            }
            return null;
        } catch (Exception $exception) {
            return null;
        }
    }

}
