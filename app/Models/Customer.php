<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;
use Illuminate\Support\Str;
use DB;

class Customer extends Model
{
    //
    use Database;

    protected $fillable = [
        'doc_num', 
        'name', 
        'lastname',
        'email',    
        'cellphone',
    ];

    public function saveOrUpdate(array $data)
    {        
        return $this->persist( Customer::class, $data);
    }
    public function createCustomer($request){
        $data=[
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email'     => strtolower($request['email']),
            'cellphone' => $request['cellphone'],
            'doc_num' => $request['doc_num']  
        ];
        $customer = $this->persist( Customer::class, $data);
        if ($customer) {
           return response()->json([
               'status' => true,
               'message' => 'customer create succes',
                'data'=> $customer,
           ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'customer not created',
                 'data'=> [],
            ]);
        }
    }

}
