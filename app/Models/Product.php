<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;
use DB;

class Product extends Model
{
    //
    use Database;

    protected $fillable = [
        'name', 
        'description',
        'price',    
        'stock',
    ];

    public function saveOrUpdate(array $data)
    {        
        return $this->persist( Product::class, $data);
    }
    public function createProduct($request){
        $data=[
            'name' => $request['name'],
            'description' => $request['description'],
            'stock'     => $request['stock'],
            'price' => $request['price']    
        ];
        $product = $this->persist( Product::class, $data);
        if ($product) {
           return response()->json([
               'status' => true,
               'message' => 'product create succes',
                'data'=> $product,
           ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'product not created',
                 'data'=> [],
            ]);
        }
    }
}
