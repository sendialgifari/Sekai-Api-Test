<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role_id != 1){
            Auth::logout();
            return redirect('/');
        }
        return view('home');
    }

    public function get_products()
    {
        $query = Product::orderBy('name', 'ASC')->get();
        return datatables()->of($query)
            ->editColumn('user_id', function ($data) {
                return $data->user->shop_name;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->toDateTime()->format('Y-m-d H:i:s');
            })
            ->rawColumns(['user_id', 'created_at'])
            ->make(true);
    }

    public function index_users()
    {
        return view('home_users');
    }

    public function get_users()
    {
        $query = User::orderBy('name', 'ASC')->where('role_id', '2')->get();
        return datatables()->of($query)
            ->editColumn('created_at', function ($data) {
                return $data->created_at->toDateTime()->format('Y-m-d H:i:s');
            })
            ->rawColumns(['created_at'])
            ->make(true);
    }
}
