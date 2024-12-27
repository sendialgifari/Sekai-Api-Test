<?php

namespace App\Http\Controllers\Api;

use Auth;

use Hash;

//import model User
use App\Models\User;

use App\Http\Controllers\Controller;

//import resource UserResource
use App\Http\Resources\UserResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all users
        $users = User::latest()->paginate(5);

        //return collection of users as a resource
        return new UserResource(true, 'List Data Users', $users);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'   => 'required|email|unique:users',
            'password'   => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'shop_name'   => 'required',
            'shop_type_id'   => 'required',
            'shop_location_id'   => 'required',
            'ktp_number'   => 'required',
            'shop_address'   => 'required',
            'postal_code'   => 'required',
            'phone_number'   => 'required',
            'role_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return new UserResource(false, 'error', $validator->errors());
        }

        //create user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->shop_name = $request->shop_name;
        $user->shop_type_id = $request->shop_type_id;
        $user->shop_location_id = $request->shop_location_id;
        $user->ktp_number = $request->ktp_number;
        $user->shop_address = $request->shop_address;
        $user->postal_code = $request->postal_code;
        $user->phone_number = $request->phone_number;
        $user->role_id = $request->role_id;
        $user->save();

        $user->token =  $user->createToken('sekai-api')->plainTextToken;

        //return response
        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $user);
    }

    public function show($id)
    {
        //find user by ID
        $user = User::find($id);

        //return single user as a resource
        return new UserResource(true, 'Detail Data User!', $user);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'shop_name'   => 'required',
            'shop_type_id'   => 'required',
            'shop_location_id'   => 'required',
            'ktp_number'   => 'required',
            'shop_address'   => 'required',
            'postal_code'   => 'required',
            'phone_number'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return new UserResource(false, 'error', $validator->errors());
        }

        //find user by ID
        $user = User::find($id);
        $user->name = $request->name;
        $user->shop_name = $request->shop_name;
        $user->shop_type_id = $request->shop_type_id;
        $user->shop_location_id = $request->shop_location_id;
        $user->ktp_number = $request->ktp_number;
        $user->shop_address = $request->shop_address;
        $user->postal_code = $request->postal_code;
        $user->phone_number = $request->phone_number;
        $user->save();

        //return response
        return new UserResource(true, 'Data User Berhasil Diubah!', $user);
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
            'user_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return new UserResource(false, 'error', $validator->errors());
        }

        $user = User::where('id', $request->input('user_id'))->first();
        if (Hash::check($request->input('old_password'), $user->password)) {

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return new UserResource(true, 'Password User Berhasil Diubah!', $user);

        } else {
            return new UserResource(false, 'error. Password lama tidak sesuai!', null);
        }
    }

    public function destroy($id)
    {

        //find user by ID
        $user = User::find($id);

        $user->products()->delete();
        $user->delete();

        //return response
        return new UserResource(true, 'Data User Berhasil Dihapus!', null);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('sekai-api')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['id'] =  $user->id;
            return new UserResource(true, 'User Berhasil Login.', $success);
        } 
        else{ 
            return new UserResource(false, 'error Unauthorised', false);
        } 
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete(); 
        return new UserResource(true, 'User Berhasil Logout.', null);
    }
}