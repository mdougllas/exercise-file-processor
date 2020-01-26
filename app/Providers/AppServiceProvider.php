<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Inserting monetary output to blade templates
use Illuminate\Support\Facades\Blade;

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
        //Inserting monetary output to blade templates
        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        //Inserting currency conversion (USD to CAD) output to blade templates
        //Configure your API key in the .env file accordingly
        Blade::directive('convert', function($amount){
            $apiKey = env('CURR_CONVERSION_API', false);
            $query =  "USD_CAD";

            $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apiKey}");
            $obj = json_decode($json, true);
            $val = floatval($obj[$query]);

            return "<?php echo '$' . number_format($val * $amount, 2);?>";
        });
    }
}
