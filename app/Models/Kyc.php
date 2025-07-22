<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    protected $fillable = [
        'phone', 'adddress_1', 'address_2', 'city', 
        'state', 'country', 'id_type', 'id_number', 
        'id_img', 'id_status', 'user_id', 'utility_type', 
        'utility_img', 'utility_status', 'selfie_img',
        'selfie_statu', 'postal_code',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
