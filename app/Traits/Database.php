<?php

namespace App\Traits;

trait Database
{

   /**
   * Save or update a model and return it
   *
   * @param Illuminate\Database\Eloquent\Model $class
   * @param array $data model data
   *
   * @return Illuminate\Database\Eloquent\Model
   *
   */
    public function persist( $class, $data){

    	$model = ( isset($data['id']) ) ? $class::find( $data['id'] ) : new $class ;

	    $model->fill( $data );

	    $model->save();

	    return $model;
    }

    public function requestResponse($code, $message, $data){

        $requestResponse['status'] = $code;
        $requestResponse['message'] = $message;
        $requestResponse['data'] = $data;
        
        return $requestResponse;
      } 
}
