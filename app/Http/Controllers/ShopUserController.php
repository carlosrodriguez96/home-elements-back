<?php

namespace App\Http\Controllers;

use Facades\App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules=[
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=> false,
                'message'=>$validator->messages(),
                'data'=>[]
            ]);
        }
        return ShopUser::register($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moldels\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function show(ShopUser $shopUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moldels\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopUser $shopUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moldels\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopUser $shopUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moldels\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopUser $shopUser)
    {
        //
    }

    public function login(Request $request){
        // Validations
        $rules = [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
        // $ip = Request()->ip();
        // validation rules 
        $validator = Validator::make($request->all(), $rules);
        // validation  fails 
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages(),
                'data' => []
            ]);
        }
        else
        {
            return ShopUser::login( $request );
        }
    }
}
