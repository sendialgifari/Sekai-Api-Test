<?php

namespace App\Http\Controllers\Api;

//import model ShopType
use App\Models\ShopType;

use App\Http\Controllers\Controller;

//import resource ProductResource
use App\Http\Resources\ProductResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class ShopTypeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data = ShopType::orderBy('name','ASC')->get();
        return new ProductResource(true, 'List Shop Types', $data);
    }
}