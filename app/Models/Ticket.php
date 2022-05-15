<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const PENDING = 0;
    const VIEW = 1;
    const REPLY = 2;

    protected $fillable = [
        'customer_name',
        'description',
        'email',
        'phone_no',
        'reference_no'
    ];

    public function reply(){
        return $this->hasMany(Reply::class);
    }
}
