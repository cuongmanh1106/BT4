<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Models\UsersQModel;
class UsersModel extends Model
{
    public static function get_users_by_userid($id) {
        
        $user = UsersQModel::get_user_by_id($id);

        return DB::table('users')->where('level','<=',$user->level)->get();
    }

    
    

}
