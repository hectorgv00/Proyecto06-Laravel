<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'party',
        'message',
        'from',
        'date',
    ];






    public function parties(){
        return $this-> hasOne(Party::class);
    }
}
