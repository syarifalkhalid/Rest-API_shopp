<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    public function findAll(){
        $data = Products::paginate(20,
        [
            'id', 'title', 'category', 'price',
           'stock', 'free_shipping', 'rate'
        ]);

        if (count($data)==0) {
            return $this->out($data=[], $status='Kosong', $code=204);
        } else {
            return $this->out( $data = $data, $status = 'OK', $error = null, $code = 200,);
        }

    }

    public function findOne(Products $produk)
    {
        return $this->out( $data = $produk, $status = 'OK', $error = null, $code = 200,);
    }
}