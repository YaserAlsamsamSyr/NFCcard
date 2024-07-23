<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'img',
        'age',
        'address',
        'numUsedCard',
        'password'
    ];
    protected $hidden=['created_at','updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
