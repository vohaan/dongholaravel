<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    } //kiểm tra đăng nhập có đúng admin đăng nhập chưa
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin(); //gọi hàm authlogin check có đăng nhập admin chưa
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first(); //hàm kiểm tra emmail password chỉ lấy 1 giá trị tài khoản thôi.
        if ($result) {
            Session::put('admin_name', $result->admin_name);           
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard'); // nhập đúng thì trả về dashboah
        }else{
            Session::put('message', 'Sai tài khoản hoặc mật khẩu xin thử lại'); 
            return Redirect::to('/admin'); // nhập sai thì trả về admin login
        }
    }
    public function logout(){
        $this->AuthLogin(); //gọi hàm authlogin check có đăng nhập admin chưa đăng nhập mới đăng xuất được
        Session::put('admin_name', null);           
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
