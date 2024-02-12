<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;
use Session;
class FilterController extends Controller
{
    public function filters(){
        Session::put('page','filters');
        $filters = ProductsFilter::get()->toArray();
        /*dd($filters); die;*/
        return view('admin.filters.filters')->with(compact('filters'));
    }

    public function filtersValues(){
        Session::put('page','filters');
        $filters_values = ProductsFiltersValue::get()->toArray();
        /*dd($filters); die;*/
        return view('admin.filters.filters_values')->with(compact('filters_values'));
    }
    public function updateFilterStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            
            /*echo"<pre>"; print_r($data); die;*/
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFilter::where('id',$data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=> $status,'filter_id'=>$data['filter_id']]);
        }
    }

    public function updateFilterValueStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            
            /*echo"<pre>"; print_r($data); die;*/
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFiltersValue::where('id',$data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=> $status,'filter_id'=>$data['filter_id']]);
        }
    }
}
