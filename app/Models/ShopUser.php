<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Database;
use Illuminate\Support\Str;
use DB;

class ShopUser extends Model
{
    //
    use SoftDeletes;
    use Database;

    private $apiToken;
    //
    protected $fillable = [
        'name', 
        'lastname', 
        'email',
        'password',    
        'api_token',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $hidden = [
        'password'
    ];

    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(Str::random(60)));
    
    }

    /**
    * Save or update the model information
    *
    * @param array $data
    */
    public function saveOrUpdate(array $data)
    {
        if(isset($data['password']))
            $data['password'] = \Hash::make($data['password']);
        return $this->persist( ShopUser::class, $data);
    }
      public function register( $request ){
        
        $data=[
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email'     => strtolower($request['email']),
            'password' => $request['password'],
            'api_token' => null,      
        ];
        if(isset($request['id'])){
            $data['id']= $request['id'];
        }      
        if(isset($request['password']) && $request['password']!="" ){
            $data['password']= bcrypt($request['password']);
        }      
        $user = $this->persist( ShopUser::class, $data);
        if ($user) {
           return response()->json([
               'status' => true,
               'message' => 'User create succes',
                'data'=> $user,
           ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'User not created',
                 'data'=> [],
            ]);
        }
        
    }
    public function login( $request ){

        $user = ShopUser::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'message' => 'User not found',
                'status' => false,
                'data' => []
            ]);
        }

        if (\Hash::check($request->password, $user->password)) {
            $user->api_token = $this->apiToken;
            $user->save();    
            return response()->json([
                'status'       => true,
                'message'      => 'Success',
                'data'         =>  $user     
            ]);
        }else{
            return response()->json([
                'message' => 'Invalid Password',
                'status' => false,
                'data' => []
            ]);
        }
    }
    
}
