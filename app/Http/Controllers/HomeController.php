<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); //lấy sản phẩm ra trang chủ
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        //$all_product = DB::table('tbl_product')
        //->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        //->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        //->orderby('tbl_product.product_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get(); //oderby biến tăng dần
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request){
        $keywords = $request->keywords_submit; //từ khóa sản phẩm
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        //$all_product = DB::table('tbl_product')
        //->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        //->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        //->orderby('tbl_product.product_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); //LIKE trong MySQL được sử dụng để so sánh một giá trị với các giá trị tương tự sử dụng toán tử ký tự đại diện
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);

    }
}
