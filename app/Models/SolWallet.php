<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolWallet extends Model
{
    protected $fillable = ['name', 'privateKey', 'address', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
