<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Lms extends Model
{

    public static function pr($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }
}
