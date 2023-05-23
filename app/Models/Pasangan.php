<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasangan extends Model
{
    use HasFactory;
    protected $guarded = ['id_pasangan'];
    public $timestamps = false;
    protected $table = 'pasangan';
}
