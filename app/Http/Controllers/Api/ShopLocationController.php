<?php

namespace App\Http\Controllers\Api;

//import model ShopLocation
use App\Models\ShopLocation;

use App\Http\Controllers\Controller;

//import resource ProductResource
use App\Http\Resources\ProductResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class ShopLocationController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data = ShopLocation::orderBy('name','ASC')->get();
        return new ProductResource(true, 'List Shop Types', $data);
    }
}