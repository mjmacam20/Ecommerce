<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            dd($categoryDetails);
            echo "Categories Exists"; die;
        }else{
            abort(404);
        }
    }
}
