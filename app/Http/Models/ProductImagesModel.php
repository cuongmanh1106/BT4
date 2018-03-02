<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductImagesModel extends Model
{
	public static function get_productImages($id) {
        $result = DB::table('productimages')->where('product_id','=',$id)->get();
       return $result;
    }
   
    public static function get_productImages_all() {
        $result = DB::table('productimages')->get();
       return $result;
    }

    public static function get_productImages_by_id($id) {
    	$result = DB::table('productimages')
                ->where('id', '=', $id)
                ->get();

        if (empty($result[0])) {
            return FALSE;
        }
        return $result[0];
    }

    public static function insert_productImages($data) {
    	return DB::table('productImages')->insert($data);
    }
    public static function update_productImages($id, $content) {
        return DB::table('productImages')
                ->where('id', $id)
                ->update($content);
    }
    public static function delete_productImages($id) {
    	return DB::table('productImages')
    			->where('id','=',$id)
    			->delete();
    }
}