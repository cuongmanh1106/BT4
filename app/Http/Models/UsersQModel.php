<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class UsersQModel extends Model
{
    public static function get_admin() {
        return DB::table('users')->where('level','=','1')->get()->toArray();
    }

    public static function get_superadmin() {
        return DB::table('users')->where('level','=','2')->get()->toArray();
    }

    public static function get_member() {
        return DB::table('users')->where('level','=','0')->get()->toArray();
    }

    public static function get_user_by_id($id) {
        $result =  DB::table('users')->where('id','=',$id)->get();
        if (empty($result[0])) {
            return FALSE;
        }
        return $result[0];
    }

    

}
