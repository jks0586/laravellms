<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table='tax';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
    ];
}
