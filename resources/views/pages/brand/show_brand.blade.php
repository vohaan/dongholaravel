@extends('layout')
@section('content')
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
<div class="features_items"><!--features_items-->
                        @foreach ($brand_name as $key => $name)
                        
                        <h2 class="title text-center">{{$name->brand_name}}</h2>
                        @endforeach
                        @foreach($brand_by_id as $key => $product) 
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                            <h2>{{ number_format(floatval($product->product_price)).' '.'VNĐ'}}</h2>
                                            <p>{{$product->product_name}}</p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach     
                    </div><!--features_items-->

 
 @endsection