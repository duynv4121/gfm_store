<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Order;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Member;
use App\Models\User;
use App\Models\CategoryBlog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $min_price = Product::min('price');
            $min_price_range = $min_price - 5000;
            $max_price = Product::max('price');
            $max_price_range = $max_price + 300000;

            $total_order = Order::count();
            $total_product = Product::count();
            $total_member = Member::count();
            $total_blog = Blog::count();
            $total_customer = User::count();
            $cate_blog = CategoryBlog::all();

            $view->with('total_product',$total_product)->with('total_order',$total_order)->with('total_member',$total_member)
                ->with('total_blog',$total_blog)->with('total_customer',$total_customer)->with('cate_blog',$cate_blog)
                ->with('min_price',$min_price)->with('min_price_range',$min_price_range)->with('max_price',$max_price)
                ->with('max_price_range',$max_price_range);
        });
        Paginator::useBootstrap();
    }
}