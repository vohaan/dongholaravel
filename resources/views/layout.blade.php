<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AN SƠN WATCH</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<style>
.product-image-wrapper {
    height: 450px; /* Đặt chiều cao cố định cho hộp sản phẩm */
}

.product-image-wrapper .single-products:hover {
    transform: translateY(-10px); /* Di chuyển sản phẩm lên khi hover */
    transition: transform 0.3s ease; /* Hiệu ứng di chuyển mềm mại */
}

.product-image-wrapper .single-products:hover .choose {
    visibility: visible; /* Hiển thị phần chọn khi hover */
}

.product-image-wrapper .choose {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    visibility: hidden; /* Ẩn phần chọn mặc định */
}

.product-image-wrapper .choose ul {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
}

.product-image-wrapper .choose ul li {
    margin: 0 5px;
}

.product-image-wrapper .choose ul li a {
    display: block;
    width: 30px;
    height: 30px;
    background: #333;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 50%;
}
</style>

<body>
    
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 84+ 987852903</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> vohaan01@gmmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{URL::to('public/frontend/images/as.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VIETNAM
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">VIETNAM</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VNĐ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dollar</a></li>
                                    <li><a href="#">VNĐ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                <?php 
                                    $customers_id = Session::get('customers_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customers_id!=NULL && $shipping_id==NULL){


                                 ?>
                                 <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                                 <?php 
                                }elseif ($customers_id!=NULL && $shipping_id!=NULL) {
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                
                                <?php 
                                    }else{


                                 ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                 <?php 

                                 }
                                 ?>

                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php 
                                    $customers_id = Session::get('customers_id');
                                    if($customers_id!=NULL){


                                 ?>
                                 <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                
                                <?php 
                                    }else{


                                 ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                 <?php 

                             }
                                 ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{URL::to('/trang-chu')}}">Products</a></li>
                                         
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    
                                </li> 
                                <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
                                <li><a href="https://www.facebook.com/an.ctulxken">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" method="POST">
                            {{ csrf_field() }}
                        <div class="search_box pull-right">
                            <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
                            <input type="submit" style="margin-top: 0;color: #666;" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>AN SƠN</span>-WATCH</h1>
                                    <h2>Miễn phí vận chuyển</h2>
                                    <p>Chúng ta cần phải đi ngang với thời gian chứ không phải để thời gian đi ngang qua. </p>
                                    <button type="button" class="btn btn-default get">Đặt mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{URL::to('public/frontend/images/mau1.png')}}" class="girl img-responsive" alt="" />
                                    <img src="{{('public/frontend/images/')}}" class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>AN SƠN</span>-SHOPPER</h1>
                                    <h2>100% Hàng thật</h2>
                                    <p>Chúng ta cần phải đi ngang với thời gian chứ không phải để thời gian đi ngang qua. </p>
                                    <button type="button" class="btn btn-default get">Đặt mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{URL::to('public/frontend/images/mau2.png')}}" class="girl img-responsive" alt="" />
                                    <img src="{{('public/frontend/images/')}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>An Sơn</span>-SHOPPER</h1>
                                    <h2>Bảo hành đến 12 tháng</h2>
                                    <p>Chúng ta cần phải đi ngang với thời gian chứ không phải để thời gian đi ngang qua. </p>
                                    <button type="button" class="btn btn-default get">Đặt mua ngay</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{URL::to('public/frontend/images/mau3.png')}}" class="girl img-responsive" alt="" />
                                    <img src="{{('public/frontend/images/')}}" class="pricing" alt="" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($category as $key => $cate)                          
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                            
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right">(50)</span>{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        
                        
                        
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>AS</span>-watch</h2>
                            <p>Có đồng hồ thì mở ra xem,không có thì mua đồng hồ đi nha hỏi quài!</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{URL::to('public/frontend/images/nobita.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Võ Hà An</p>
                                <h2>02/05/2001</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{URL::to('public/frontend/images/doraemon.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Phạm Nam Sơn</p>
                                <h2>09/04/2001</h2>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{URL::to('public/frontend/images/map.png')}}" alt="" />
                            <p>566 Núi Thành,Hoà Cường Nam,Quận Hải Châu,TP.Đà Nẵng,Việt Nam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="https://www.facebook.com/an.ctulxken/">Online Help</a></li>
                                <li><a href="https://www.facebook.com/an.ctulxken/">Contact Us</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Nam</a></li>
                                <li><a href="#">Nữ</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Hình thức</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Cơ</a></li>
                                <li><a href="#">Pin</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chất liệu</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Da</a></li>
                                <li><a href="#">Cao su</a></li>
                                <li><a href="#">Nhựa</a></li>
                                <li><a href="#">Kim loại</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2024 Võ Hà AN KS & Phạm Nam Sơn KS All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">V.H.A</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>
</html>