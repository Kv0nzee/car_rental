<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        try{
            return Brand::all();
        }catch(Exception $e){
            return response()->json([
                'message'=> $e->getMessage(),
                'status'=> 500
            ],500);
        }
    }
}
