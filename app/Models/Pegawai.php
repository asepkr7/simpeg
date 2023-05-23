<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id_pegawai'];
    public $timestamps = false;
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

     public function getRouteKeyName()
    {
        return 'nip';
    }

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->where('nama', 'like', '%'.$fillters['search'].'%')
               ->orWhere('nip', 'like', '%'.$fillters['search'].'%')
               ->orWhere('karpeg', 'like', '%'.$fillters['search'].'%');
    }

    // $query->when($fillters['search'] ?? false, function($query,$search){
    //     return $query->where('nama', 'like', '%'.$search.'%')
    //            ->orWhere('nip', 'like', '%'.$search.'%')
    //            ->orWhere('karpeg', 'like', '%'.$search.'%');
    // });
    // }
}
public function users()
{
   return $this->BelongsTo(User::class);
}
}
