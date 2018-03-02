<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\ProductsModel;
use Illuminate\Support\Facades\Input;
use Validator;
use File;
use App\Http\Models\CategoriesModel;
use App\Http\Models\ProductImagesModel;

class ProductImagesController extends Controller {

	public function __construct() {
    }


    public function index(Request $request , $id) {
    	$imgs = ProductImagesModel::get_productImages($id);
    	$product = ProductsModel::get_product_by_id($id);
    	$data = array('imgs'=>$imgs , 'product'=>$product);
    	return view('productImages.list')->with($data);
    }
    public function create($id) {
    	return view('productImages.insert',compact('id'));
    }
    public function store(Request $request,$id) {
    	$v = Validator::make($request->all(),
            [
                'name' => 'required'
                
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm'
            ]
        );
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors());
        $file = $request->file('name');
        $img = newImage($file->getClientOriginalName());
        $data = [
        	'name' => $img,
        	'product_id' => $id
        ];

        //process insert product_images
        if (ProductImagesModel::insert_productImages($data)) {
        	$file->move("public/images",$img);
        	$request->session()->flash('alert-success','Success!!!');
        	return back();
        } else {
        	$request->session()->flash('alert-danger','Fail!!!');
        	return back();
        }


    }
    public function delete(Request $request,$pro_id, $id) {
    	$pro_img = ProductImagesModel::get_productImages_by_id($id);
    	$img = $pro_img->name;
    	if(ProductImagesModel::delete_productImages($id)) {
    		File::delete(public_path('images/'.$img));
            $request->session()->flash('alert-success','Hình đã được xóa');
            return back();
    	}
    }
}