<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Transaction;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        // $setting = Setting::where('name', 'website-title')->first();


        // if ($transaction->count()==0) {
        //     # code...
        //     $count =0;
        // }
        // else{
        //     $count 
        // }
        // View::share('jml_transaksi', $jml);

    view()->composer('*', function ($view) 
    {
        //this code will be executed when the view is composed, so session will be available
        $userid = session('userid');

        $jml = Transaction::where('id_login_member',$userid)->count();
        // echo $jml;
        $view->with('jml_transaksi', $jml);    
    });  

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
