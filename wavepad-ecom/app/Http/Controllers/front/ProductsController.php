<?php

namespace App\Http\Controllers\Front;

use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category;
use Session;
use DB;

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

    public function vendorListing($vendorid){
        //Get Vendor Shop Name
       $getVendorShop = Vendor::getVendorShop($vendorid);
       // Get Vendor Products
       $vendorProducts = Product::with('author')->where('vendor_id',$vendorid)->where('status',1);
       $vendorProducts = $vendorProducts->paginate(30);
       return view('front.products.vendor_listing')->with(compact('getVendorShop','vendorProducts'));
    }
    public function detail($id){
        $productDetails = Product::with(['section','category','author','attributes'=>function($query){
            $query->where('stock','>',0)->where('status',1);
        },'images','vendor'])->find($id)->toArray();
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        //dd($productDetails);

        //get similar products
        $similarProducts = Product::with('author')->where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->limit(10)->inRandomOrder()->get()->toArray();
        //dd($similarProducts);

        // Set ka ng session sa recently viewed products
        if(empty(Session::get('session_id'))){
            $session_id = md5(uniqid(rand(), true));
        }else{
            $session_id = Session::get('session_id');
        }

        Session::put('session_id',$session_id);

        // Insert ka ng products sa table if not hindi pa nag eexists 
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where(['product_id'=>$id,'session_id'=>$session_id])->count();
        if($countRecentlyViewedProducts==0){
            DB::table('recently_viewed_products')->insert(['product_id'=>$id,'session_id'=>$session_id]);
        }
        // Get Recently Viewed Products IDs
        $recentProductIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id','!=',$id)->where('session_id',$session_id)->inRandomOrder()->get()->take(10)->pluck('product_id');

         // Get Recently Viewed Products
        $recentlyViewedProducts = Product::with('author')->whereIn('id', $recentProductIds)->get()->toArray();

        $totalStock = ProductsAttribute::where('product_id',$id)->sum('stock'); 
        return view('front.products.detail')->with(compact('productDetails','categoryDetails','totalStock','similarProducts','recentlyViewedProducts'));
    }

    public function getProductPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'],$data['size']);
            return $getDiscountAttributePrice;
        }
    }

    
}
