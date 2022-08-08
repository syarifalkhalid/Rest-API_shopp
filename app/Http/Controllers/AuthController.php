<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Customers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class AuthController extends BaseController
{
    public function auth(){
        $authheader = \request()->header('Authorization');  //basic xxxbase64encodexxx
        $keyauth = substr($authheader,6); //hilangkan text basic

        $plainauth = base64_decode($keyauth); //decode text info login 
        $tokenauth = explode(':', $plainauth); //pisahkan email:password
        
        $email  = $tokenauth[0]; //email
        $pass  = $tokenauth[1]; //password

        $data = (new Customers())->newQuery()
            ->where(['email'=>$email])
            ->get(['id', 'first_name','last_name', 'email', 'password'])->first();

           if ($data == null) { //jika data costumer tidak ditemukan
             return response()->json([

                "response" => [
                    "status" => 404,
                    "message" => "Gagal mengambil data"
                ],

                "data" => $data
            ], 404);
            
            } else {  //jika data costumer  ditemukan
                if (Hash::check($pass, $data->password)) { //cek jika password cocok maka
                    $data->token = hash('sha256', Str::random(10));  //buat token untuk dikirim ke client
                    unset($data->password); //hilangkan informasi ppassword yang akan dikirim ke client
                    $data->update(); //update token yang disimpan ke costumer

                    // return $this->out( data: $data, status: 'OK', );
                    return response()->json([

                        "response" => [
                            "status" => 200,
                            "message" => "List Data Costumers"
                        ],
        
                        "data" => $data
                    ], 200);

                } else { //jika pass tdk cocok
                    return response()->json([

                        "response" => [
                            "status" => 404,
                            "message" => "Ada Kesalahan"
                        ],
        
                        "data" => $data
                    ]);
                }
                
            }
    }
}