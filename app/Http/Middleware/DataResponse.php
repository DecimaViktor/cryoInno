<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DataResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function getDate($request){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=1ca5bf4913774f95b124958dde97dcf6&page=1&pageSize=12",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "pageSize: 12",
                "page"=>$request->pageNo,
                "Cookie: __cfduid=d6f1129b4e6cedb27858593d5c874da921600641672"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_encode($response)["articles"];
    }
}
