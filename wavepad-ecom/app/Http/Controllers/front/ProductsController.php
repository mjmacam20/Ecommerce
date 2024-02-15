<?php

namespace App\Http\Controllers\Front;

use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    public function listing(){
        //echo "test"; die;
        $url = Route::getFacadeRoot()->current()->uri(); 
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount>0){
            //Get Category Details
            $categoryDetails = Category::categoryDetails($url);
            $categoryProducts = Product::with('author')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);
            
            //check for sort
            if(isset($_GET['sort']) && !empty($_GET['sort'])){
                if($_GET['sort']=="product_latest"){
                    $categoryProducts->orderby('products.id','Desc');
                }else if($_GET['sort']=="price_lowest"){
                    $categoryProducts->orderby('products.product_price','Asc');
                }else if($_GET['sort']=="price_highest"){
                    $categoryProducts->orderby('products.product_price','Desc');
                }else if($_GET['sort']=="name_z_a"){
                    $categoryProducts->orderby('products.product_name','Desc');
                }else if($_GET['sort']=="name_a_z"){
                    $categoryProducts->orderby('products.product_name','Asc');
                }
            }

            $categoryProducts = $categoryProducts->paginate(30);
            //dd($categoryProducts);
            //echo "Categories Exists"; die;
            return view ('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
            abort(404);
        }
    }
    public function detail($id){
        $productDetails = Product::with(['section','category','author','attributes'=>function($query){
            $query->where('stock','>',0)->where('status',1);
        },'images'])->find($id)->toArray();
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        //dd( $categoryDetails);
        $totalStock = ProductsAttribute::where('product_id',$id)->sum('stock'); 
        return view('front.products.detail')->with(compact('productDetails','categoryDetails','totalStock'));
    }

}
