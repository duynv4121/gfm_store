
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\home\profileController;
use App\Http\Controllers\home\contactController;
use App\Http\Controllers\home\paymentVNpayController;


use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryBlogController;
use App\Http\Controllers\admin\childCateController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\feeShipController;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\admin\StatisticalController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\customerController;
use App\Http\Controllers\admin\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// /*===========================================PHẦN QUẢN TRỊ DASHBOARD===================================================*/

// /*--------------------Chức năng đăng nhập--------------------*/
Route::group(['prefix'=>'admin','middleware'=>'CheckLogedIn'],function(){
    Route::get('/login',[AuthController::class, 'index']);
    Route::post('/login',[AuthController::class,'login']);
});

Route::group(['prefix'=>'admin','middleware'=>['CheckLogedOut','role:Admin|Writer|Editer|Publisher|Quản lí']], function(){
    /*--------------------Chức năng thoát--------------------*/
    Route::get('logout', [AuthController::class, 'logout']);

    /*--------------------Thông tin cá nhân--------------------*/
    Route::get('/profile/{id}', [AuthController::class, 'profile']);
    Route::get('/update-profile/{id}', [AuthController::class, 'getProfile']);
    Route::post('/update-profile/{id}', [AuthController::class, 'postProfile']);

    /*--------------------Trang chủ quản trị--------------------*/
    Route::get('home', [StatisticalController::class, 'getHome']);

    /*--------------------Thống kê--------------------*/
    Route::post('/filter_by_date', [StatisticalController::class, 'filter_by_date']);
    Route::post('/filter_by_select', [StatisticalController::class, 'filter_by_select']);
    Route::post('/default_chart', [StatisticalController::class, 'default_chart']);

    /*--------------------Quản lý đơn hàng--------------------*/
    Route::get('/manage-order', [OrderController::class, 'manageOrder'])->middleware('permission:quan ly don hang');
    Route::get('/order-detail/{order_code}', [OrderController::class, 'orderDetail'])->middleware('permission:quan ly don hang');
    Route::post('/update-order', [OrderController::class, 'update_order'])->middleware('permission:quan ly don hang');

    /*--------------------In đơn hàng--------------------*/
    Route::get('/printOrder/{maDH}', [OrderController::class, 'print'])->middleware('permission:quan ly don hang');

    /*--------------------Quản lý nhân viên--------------------*/
    Route::resource('/members',MemberController::class);
    
    /*--------------------Quản lý vai trò--------------------*/
    Route::get('role/{id}', [RoleController::class, 'getRole'])->middleware('permission:cap vai tro');
    Route::post('role/{id}', [RoleController::class, 'postRole'])->middleware('permission:cap vai tro');
    Route::post('create-role/', [RoleController::class, 'createRole'])->middleware('permission:cap vai tro');
    
    /*--------------------Quản lý quyền--------------------*/
    Route::get('permission/{id}', [RoleController::class, 'getPermission'])->middleware('permission:cap quyen');
    Route::post('permission/{id}', [RoleController::class, 'postPermission'])->middleware('permission:cap quyen');
    Route::post('create-permission/', [RoleController::class, 'createPermission'])->middleware('permission:cap quyen');

    /*--------------------Quản lý danh mục--------------------*/
    Route::resource('/category',App\Http\Controllers\admin\CategoryController::class);

    /*--------------------Quản lý danh mục con--------------------*/
    Route::resource('/child-category',App\Http\Controllers\admin\childCateController::class);
    Route::post('/select-category', [childCateController::class, 'select_category']);

    /*--------------------Quản lý sản phẩm--------------------*/
    Route::resource('/product',App\Http\Controllers\admin\ProductController::class);

    /*--------------------Quản lý danh mục bài viết--------------------*/
    Route::resource('/category_blog',App\Http\Controllers\admin\CategoryBlogController::class);

    /*--------------------Quản lý bài viết--------------------*/
    Route::resource('/blog',App\Http\Controllers\admin\BlogController::class);

    /*--------------------Quản lý mã giảm giá--------------------*/
    Route::resource('/coupon',App\Http\Controllers\admin\CouponController::class);
    Route::get('/coupon/send-mail/{id}', [CouponController::class, 'sendMail'])->middleware('permission:gui mail ma giam gia');

    /*--------------------Quản lý bình luận sản phẩm--------------------*/
    Route::get('comment', [CommentController::class, 'getComment'])->middleware('permission:quan ly binh luan san pham');
    Route::get('comment/{id}/detail', [CommentController::class, 'detailComment'])->middleware('permission:quan ly binh luan san pham');
    Route::post('comment/delete', [CommentController::class, 'delComment'])->middleware('permission:quan ly binh luan san pham');
    Route::post('allow-comment-product', [CommentController::class, 'allowCommentPro'])->middleware('permission:quan ly binh luan san pham');
    Route::post('reply-comment-product', [CommentController::class, 'replyCommentPro'])->middleware('permission:quan ly binh luan san pham');

    /*--------------------Quản lý bình luận bài viết--------------------*/
    Route::get('commentblog', [CommentController::class, 'getCommentBlog'])->middleware('permission:quan ly binh luan bai viet');
    Route::get('commentblog/{id}/detail', [CommentController::class, 'detailCommentBlog'])->middleware('permission:quan ly binh luan bai viet');
    Route::post('commentblog/delete', [CommentController::class, 'delCommentBlog'])->middleware('permission:quan ly binh luan bai viet');
    Route::post('allow-comment-blog', [CommentController::class, 'allowCommentBlog'])->middleware('permission:quan ly binh luan bai viet');
    Route::post('reply-comment-blog', [CommentController::class, 'replyCommentBlog'])->middleware('permission:quan ly binh luan bai viet');

    /*--------------------Quản lý slide banner--------------------*/
    Route::resource('/slide-banner',SlideController::class);

    /*--------------------Quản lý feeship--------------------*/
    Route::resource('/feeship',feeShipController::class);
    Route::post('/feeship/update-fee', [feeShipController::class, 'update_fee']);

    /*--------------------Sắp xếp danh mục theo kéo thả--------------------*/
    Route::post('/arrange-category', [CategoryController::class, 'arrange_category']);

    /*--------------------Quản lý khách hàng--------------------*/
    Route::resource('/customer',customerController::class)->middleware('permission:quan ly khach hang');;
    Route::get('/customer/active/{id}', [customerController::class, 'active'])->middleware('permission:quan ly khach hang');;
    Route::get('/customer/unactive/{id}', [customerController::class, 'unactive'])->middleware('permission:quan ly khach hang');;

});
/*===========================================KẾT THÚC PHẦN QUẢN TRỊ DASHBOARD============================================*/
/*=======================================================================================================================*/
/*=======================================================================================================================*/

/*==================================================PHẦN NGƯỜI DÙNG======================================================*/
// Trang chủ
Route::get('/', 'App\Http\Controllers\home\HomeController@index');

// Sản phẩm
Route::get('/tat-ca-san-pham', 'App\Http\Controllers\home\HomeController@allPro');

// Sản phẩm theo loại
Route::get('/loai-san-pham/{id}/{slug}', 'App\Http\Controllers\home\HomeController@ByCategory');

// Chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{id}/{slug}', 'App\Http\Controllers\home\HomeController@detail');

// Gửi đánh giá
Route::post('/send-comment', 'App\Http\Controllers\home\HomeController@insert_rating');
Route::post('/load-comment', 'App\Http\Controllers\home\HomeController@LoadComment');

// ADD-CART
Route::post('/add-cart','App\Http\Controllers\home\CartController@AddCart');
// DELETE-CART
Route::match(['get','post'],'/delete-cart/{session_id}',[
    'as'=> 'cart.delete',  
    'uses'=> 'App\Http\Controllers\home\CartController@DeleteCart'
]);         
// UPDATE-CART
Route::match(['get','post'],'/update-cart',[
    'as'=> 'cart.update',  
    'uses'=> 'App\Http\Controllers\home\CartController@UpdateCart'
]);     
// SHOW-CART
Route::match(['get','post'],'/cart',[
    'as'=> 'cart.add',  
    'uses'=> 'App\Http\Controllers\home\CartController@ShowCart'
]);    

Route::get('/show-cart', 'App\Http\Controllers\home\CartController@ShowCart');
//check_coupon
Route::post('/check-coupon', 'App\Http\Controllers\home\CartController@CheckCoupon');
// delate coupon code
Route::post('/delete-coupon', 'App\Http\Controllers\home\CartController@DeleteCoupon');
Route::get('/delete-coupon', 'App\Http\Controllers\home\CartController@DeleteCoupon');

// kiểm tra thanh toán
Route::get('/check-out', 'App\Http\Controllers\home\CartController@CheckOut')->middleware('checkLogout');

// phi ship
Route::post('/select-delivery-home', 'App\Http\Controllers\home\CartController@SelectDeliveryHome');
Route::get('/select-delivery-home', 'App\Http\Controllers\home\CartController@SelectDeliveryHome');

// check ship
Route::post('/calculate-fee', 'App\Http\Controllers\home\CartController@CalculateFee');
// xóa shipping
Route::post('/delete-fee', 'App\Http\Controllers\home\CartController@DeleteFee');
Route::get('/delete-fee', 'App\Http\Controllers\home\CartController@DeleteFee');
// thanh then 
Route::post('/confirm-order', 'App\Http\Controllers\home\CartController@ConfirmOrder');

//đổi điểm
Route::post('/change-mark', 'App\Http\Controllers\home\CartController@change_mark');
Route::get('/delete-mark-money', 'App\Http\Controllers\home\CartController@delete_mark_money');



// dang nhập khách hàng
Route::get('/login', 'App\Http\Controllers\home\LoginController@LoginUser')->middleware('checkLogin');
Route::get('/logout', 'App\Http\Controllers\home\LoginController@LogoutUser');

Route::post('/register', 'App\Http\Controllers\home\LoginController@register')->middleware('checkLogin');

// xác thực tài khoản
Route::get('/register/verify/{code}', 'App\Http\Controllers\home\LoginController@verify');

//gửi quên mật khẩu
Route::post('/sendMailForgot', 'App\Http\Controllers\home\LoginController@sendMailForgot');
Route::get('/reset-password/{token}', 'App\Http\Controllers\home\LoginController@resetPass');
Route::post('/update-password-new', 'App\Http\Controllers\home\LoginController@updatePassNew');
Route::post('/check-login-user', 'App\Http\Controllers\home\LoginController@CheckLoginUser');

Route::group(['middleware' => 'checkLogin'], function() {
    //đăng nhập google
    Route::get('/login/google', 'App\Http\Controllers\home\LoginController@redirectToGoogle');
    Route::get('/login/google/callback', 'App\Http\Controllers\home\LoginController@registerGoogle');

    //đăng nhập facebook
    Route::get('/login/facebook', 'App\Http\Controllers\home\LoginController@redirectToFacebook');
    Route::get('/login/facebook/callback', 'App\Http\Controllers\home\LoginController@registerFacebook');
});

// THích sản phẩm
Route::post('/like-product', 'App\Http\Controllers\home\HomeController@LikeProduct');
// lấy lại mật khẩu
Route::get('/forgot-password', 'App\Http\Controllers\home\LoginController@ForgotPassword');
// liên he
Route::get('/contact', 'App\Http\Controllers\home\HomeController@Contact');
// blog
Route::get('/danh-muc-bai-viet/{id}/{slug}', 'App\Http\Controllers\home\BlogController@Blogs');
// blog chi tiết
Route::get('/chi-tiet-bai-viet/{id}/{slug}', 'App\Http\Controllers\home\BlogController@BlogDetail');
// bình luận bài viết
Route::post('/chi-tiet-bai-viet/{id}/{slug}', 'App\Http\Controllers\home\BlogController@blogComment');
// Tìm kiếm sản phẩm
Route::get('/tim-kiem', 'App\Http\Controllers\home\HomeController@search');
// Tìm kiếm sản phẩm Ajax
Route::post('/timkiem-ajax', 'App\Http\Controllers\home\HomeController@search_ajax');

//profile
Route::get('/profile/{id}', [profileController::class, 'index'])->middleware('checkLogout');
Route::get('/history-cart/{id}', [profileController::class, 'history_cart']);
Route::post('/cart-cancel/{id}', [profileController::class, 'cart_cancel']);
Route::post('/update-profile/{id}', [profileController::class, 'update'])->middleware('checkLogout');
Route::post('/update-pass-user/{id}', [profileController::class, 'changePass'])->middleware('checkLogout');
//Contact
Route::post('/send-contact', [contactController::class, 'send_mail']);


//Contact
Route::post('/send-contact', [contactController::class, 'send_mail']);


//Contact
Route::get('/vnpay', [paymentVNpayController::class, 'vnpay']);
Route::get('/return-vnpay', [paymentVNpayController::class, 'vnpay_return']);


/*===============================================KẾT THÚC PHẦN NGƯỜI DÙNG================================================*/
/*=======================================================================================================================*/
/*=======================================================================================================================*/