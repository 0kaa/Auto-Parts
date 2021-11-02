<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\HindAlmujaghedMail;

    /*
    |--------------------------------------------------------------------------
    | Detect Active Route Function
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    function isActiveRoute($route, $output = "active"){
        if(Route::currentRouteName() === $route) return $output;
    }

    function getSetting($key){
        return \App\Models\Setting::where('key',$key)->first();
    }

    function getSettings($keys){
        return \App\Models\Setting::whereIn('key',$keys)->get();
    }




    /*
    |--------------------------------------------------------------------------
    | Detect Active Routes Function
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    function areActiveRoutes(Array $routes, $output = "active open-sub-menu"){
        foreach($routes as $route){
            if(Route::currentRouteName() === $route) return $output;
        }
    }

function sendEmail($title, $message, $to){

    Mail::to($to)->send(new \App\Mail\Kuco($title, $message));


}

function send_activation_code($numbers, $msg, $timeSend = 0, $dateSend = 0, $deleteKey = 0, $viewResult = 1)
{
    $client = new \GuzzleHttp\Client();
    $url = "http://api.yamamah.com/SendSMSV2?Username=966595070182&Password=Jq5NE7n^3u9X&Tagname=muhtarf&RecepientNumber=$numbers&Message=$msg&SendDateTime=0&EnableDR=true&SentMessageID=true";

    $request = $client->get($url, [
        'form_params' => [
            '_token' => csrf_field()
        ]
    ]);
}



