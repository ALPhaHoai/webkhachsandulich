<?php

namespace App;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Model;

class CustomValidator extends Model
{
    function GreaterThan($attributes, $value, $parameters, $validator){
      $min_field = $parameters[0];
      $data = $validator->getData();
      $min_value = $data[$min_field];
      return $value > $min_value;
    }
}
