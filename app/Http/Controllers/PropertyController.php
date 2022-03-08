<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
class PropertyController extends Controller
{

    public function index(){
      //...
    }

    public function all(){

        $property = DB::table('properties')->get();

        dd(response()->json($property)->content());
        return view('property', [
            "properties" => response()->json($property) ,
        ]);

    }

    public function getOne($id){

     $property =  Property::find($id);

    //  dd(response()->json($property));
     return response()->json($property);

    }

}
