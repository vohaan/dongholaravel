<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function view_order($orderId){ // hóa đơn
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customers_id','=','tbl_customers.customers_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_oder_details','tbl_order.order_id','=','tbl_oder_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_oder_details.*') // .* là chọn tất cả
        ->first();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }
    public function login_checkout(){ //not login logout

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 

        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customers(Request $request){ //dk account

        $data = array();
        $data['customers_name'] = $request->customers_name;
        $data['customers_phone'] = $request->customers_phone;
        $data['customers_email'] = $request->customers_email;
        $data['customers_password'] = md5($request->customers_password); //LẤY DỮ LIỆU TRONG BẢNG // md5 có nghĩa là mã hóa mật khẩu

        $customers_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customers_id',$customers_id);
        Session::put('customers_name',$request->customers_name);
        return Redirect::to('/checkout');
    }
    public function checkout(){ //sau đăng nhập hoặc chuyển hướng sau khi đăng ký
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 

        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function save_checkout_customers(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes; //LẤY DỮ LIỆU TRONG BẢNG
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);
        
        return Redirect::to('/payment');  //quay lại trang 
    }
    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 

        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
        
    }
    public function order_place(Request $request){
        // insert payment method ( hình thức thanh toán)
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id= DB::table('tbl_payment')->insertGetId($data);

        // insert order
        $order_data = array();
        $order_data['customers_id'] = Session::get('customers_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id= DB::table('tbl_order')->insertGetId($order_data);

        // insert order details\
        $content = Cart::content();
        foreach($content as  $v_content){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_oder_details')->insert($order_d_data);

        }
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán thẻ ATM';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy(); //sau khi đặt mua xong thì giỏ hàng sẽ xóa sản phẩm được mua đi
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 

            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
        
        } else {
            echo 'Thẻ ghi nợ';
        }
        
        //return Redirect::to('/payment');  //quay lại trang 


    }
    public function logout_checkout(){ //đăng xuất chuyển huowsmg về trang đăng nhập 
        Session::flush(); // xóa hết dl đăng nhập
        return Redirect::to('/login-checkout');
    }
    public function login_customers(Request $request){ //khách hàng đăng nhập
        $email = $request->email_account;
        $password = md5($request->password_account); //soi đúng mk mã hóa
        $result = DB::table('tbl_customers')->where('customers_email',$email)->where('customers_password',$password)->first(); //kết quả đi so sánh với dữ liệu trong bảng customers

        if ($result) {
            Session::put('customers_id',$result->customers_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }

        
        
    }
    // hàm của đơn hàng
    public function manage_order(){

        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customers_id','=','tbl_customers.customers_id')
        ->select('tbl_order.*','tbl_customers.customers_name') // .* là chọn tất cả
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);

    }
    public function delete_order($order_id)
    {
        // Xóa đơn hàng dựa trên $order_id
        $deleted = DB::table('tbl_order')->where('order_id', $order_id)->delete();
        Session::put('message','Xóa đơn hàng thành công');

        return Redirect::to('/manage-order');
    }
    
}
