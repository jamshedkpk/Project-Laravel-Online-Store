<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
public function register()
{
//
}

public function boot()
{
// For bootstrap pagination
Paginator::useBootstrap();


// To create a format for date and time
Carbon::macro('toFormattedDate',function(){
return $this->format('d-M-Y');
});

Carbon::macro('toFormattedTime',function(){
return $this->format('H:i A');
});    
}

}
