<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Spatie\ArrayToXml\ArrayToXml;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/json', function () use ($router) {

//     $filename = storage_path('csv/samplecsv.csv');
//     if($filename) {
//         $rows = array_map('str_getcsv', file($filename));
//         $header = array_shift($rows);
//         $csv = array();
//         foreach ($rows as $row) {
//             $csv[] = array_combine($header, $row);
//         }

//         if(!empty($csv)){
//             $createJson = Storage::disk('public')->put('items.json', json_encode($csv));
//             if($createJson === true){
//                 return "Json file created/updated.";
//             } else {
//                 return "Json creation/updation failed!";
//             }
//         }
//     } else {
//         return "Invalid File!";
//     }

// });

// response in json format
$router->get('/getItems', function () use ($router) {
    $filename = storage_path('app/public/items.json');
    if(file_exists($filename)){
        $str = file_get_contents($filename);
        $json = json_decode($str, true);
        return response()->json($json);
    } else {
        return "Json file does not exist.";
    }
});

// response in xml format
$router->get('/getItemsxml', function () use ($router) {
    $filename = storage_path('app/public/items.json');
    if(file_exists($filename)){
        $str = file_get_contents($filename);
        if(!empty($str)) {
            $json['item'] = json_decode($str, true);
            return response()->xml($json);
        } else {
            return "No data";
        }

    } else {
        return "Json file does not exist.";
    }
});

$router->get('/getItems/name/{name}', function ($name = '') use ($router) {
    $filename = storage_path('app/public/items.json');
    if(file_exists($filename)){
        $str = file_get_contents($filename);
        $json = json_decode($str, true);
        $result = filter($name, $json, 'Name');
        return response()->json($result);
    } else {
        return "Json file does not exist.";
    }
});

$router->get('/getItemsxml/name/{name}', function ($name = '') use ($router) {
    $filename = storage_path('app/public/items.json');
    if(file_exists($filename)){
        $str = file_get_contents($filename);
        $json = json_decode($str, true);
        if(!empty($json)) {
            $result['item'] = filter($name, $json, 'Name');
            return response()->xml($result);
        } else {
            return "No data";
        }
       
    } else {
        return "Json file does not exist.";
    }
});

$router->get('/getItems/pvp/{pvp}', function ($pvp = '') use ($router) {
    $filename = storage_path('app/public/items.json');
    if(file_exists($filename)){
        $str = file_get_contents($filename);
        $json = json_decode($str, true);
        $result = filter($pvp, $json, 'pvp');
        return response()->json($result);
    } else {
        return "Json file does not exist.";
    }
});

$router->get('/getItemsxml/pvp/{pvp}', function ($pvp = '') use ($router) {
    $filename = storage_path('app/public/items.json');
    if(file_exists($filename)){
        $str = file_get_contents($filename);
        $json = json_decode($str, true);
        if(!empty($json)) {
            $result['item'] = filter($pvp, $json, 'pvp');
            return response()->xml($result);
        } else {
            return "No data";
        }
    } else {
        return "Json file does not exist.";
    }
});

function filter($filter, $array, $type = ''){
    $filtered_array = array();
    for($i = 0; $i < count($array); $i++){
        // Equality Check
        if($array[$i][$type] == $filter){
            $filtered_array[] = $array[$i];
        }
    }
    return $filtered_array;
}