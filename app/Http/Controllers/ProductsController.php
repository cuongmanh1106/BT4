<?php

namespace App\Http\Controllers;
use App\Http\Requests;
// use Illuminate\Http\Request;
use App\Http\Requests\productsRequest;
use App\Http\Controllers\Controller;
use App\Http\Models\ProductsModel;
use Illuminate\Support\Facades\Input;
use Validator;
use File;
use App\Http\Models\CategoriesModel;
use App\Http\Models\ProductImagesModel;
use Carbon\Carbon;
use Request;

class ProductsController extends Controller
{
	public function __construct() {
    }
    public function index(Request $request) {
        //Get and search Products
        if (isset($_POST['tim'])) {
            $search = $_POST['tim'];
            $product = ProductsModel::search_product($search);
        } else {
            $search = '';
            $product = ProductsModel::get_product_paging(5);
        }
        $data = array(
                'product'=>$product,
                'search'=>$search
        );
        return view('product.list')->with($data); 
	}

    /**
     * Show form create products.
     *
     * @return Response
     */
	public function create() {
        $cate = categoriesModel::get_categories_all();
        return view('product.insert',compact('cate'));
    }

    /**
     * Store a new products.
     *
     * @param Request $request
     * @return Response
     */
    public function store (productsRequest $request) {
        //Check file
        $file = $request->file('image');
        $img_name = $file->getClientOriginalName();

        //check images
        if ($img_name == null) {
        	$request->session()->flash('fail','that bai');
        	return back();
        }

        //create a new image name app/function/functions.php
        $new_img = newImage($img_name);
        
        // Create item to insert db
        $product = [
            'name' => $_POST['name'],
            'cate_id' => $_POST['cate_id'],
            'cost' => $_POST['cost'],
            'images'    => $new_img,
            'view' => 0,
            'created_at' => Carbon::now()
        ];

       
        $pro_id = ProductsModel::insert_product($product);
        //process insert
        if ($pro_id != null) {
            //Move file to server
            $file->move("public/images",$new_img);

            //add detail images
            if(Input::hasFile('fProductDetail')) {
                foreach(Input::file('fProductDetail') as $f) {
                    $new_name = newImage($f->getClientOriginalName());
                    if(isset($f)) {
                        $data = [
                            'name' => $new_name,
                            'product_id' => $pro_id
                        ];
                        ProductImagesModel::insert_productImages($data);
                        $f->move('public/images',$new_name);
                    }
                }
                    $request->session()->flash('alert-success','Thành công');
                    return back();
           
            }
            
        } else {
            $request->session()->flash('alert-danger','Thất bại');
            return back();
        }
    }

    /**
     * Edit a product.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        // Get blog
        $product = ProductsModel::get_product_by_id($id);
        $cate= CategoriesModel::get_categories_all();
        $pro_imgs = ProductImagesModel::get_productImages($id);
        $data = array(
                'product'=>$product,
                'cate'=>$cate,
                'pro_imgs' => $pro_imgs
        );
        return view('product.edit')->with($data);
    }

    /**
     * Update a product.
     *
     * @param int $id
     * @return Response
     */
    public function update($id, productsRequest $request) {
        //check images
     	$product = ProductsModel::get_product_by_id($id);
     	$file = $request->file('image');
     	$old_img = $product->images;
        $new_img = $old_img;
        if ($file!=null) {
        	$new_img = newImage($file->getClientOriginalName());
        }

        //create array to update to DB
     	$content = [
     		'name' => $_POST['name'],
     		'cate_id' => $_POST['cate_id'],
            'cost' => $_POST['cost'],
            'images'    => $new_img
     	];

        //process update
     	if (ProductsModel::update_product($id,$content)) {
            //Move file to server
            if ($old_img != $new_img) {
                if (file_exists(public_path('images/'.$old_img)))
                    unlink(public_path('images/'.$old_img));
                $file->move("public/images",$new_img);
            }

            //insert detail images
            if(!empty(Request::file('fEditDetail'))) {
                foreach(Request::file('fEditDetail') as $f) {
                    if (isset($f)) {
                        $data = [
                            'name' => newImage($f->getClientOriginalName()),
                            'product_id' => $id
                        ];
                        ProductImagesModel::insert_productImages($data);
                        $f->move("public/images",newImage($f->getClientOriginalName()));
                    }

                }
            }
            $request->session()->flash('alert-success',"Thành công");
            return redirect()->route('product.list');
        } else {
            $request->session()->flash('alert-danger','Thất bại');
            return redirect()->back();
        }
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function delete ($id,Request $request) {
        //get old_image
        $product = ProductsModel::get_product_by_id($id);
        $old_image = $product->images;

        //process delete
        if (ProductsModel::delete_product($id)) {
            File::delete(public_path('images/'.$old_image));
            $pro_imgs = ProductImagesModel::get_productImages($id);
            foreach($pro_imgs as $pro_img) {
                File::delete(public_path('images/'.$pro_img->name));
                ProductImagesModel::delete_productImages($pro_img->id);
            }
            $request->session()->flash('alert-success','Sản phẩm đã được xóa');
            return back();
        }
    }

    public function getDelImg($id)
    {
        if(Request::ajax()) {
            $idImg = (int)Request::get('idImg');
            $image_detail = ProductImagesModel::get_productImages_by_id($idImg);
            if(!empty($image_detail)) {
                $img = 'images/'.$image_detail->name;
                if(file_exists(public_path('images/'.$image_detail->name))) {
                    File::delete(public_path('images/'.$image_detail->name));
                }
                ProductImagesModel::delete_productImages($idImg);
            }
            return "ok";
        }
    }

}