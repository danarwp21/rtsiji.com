<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidate extends Model
{
    protected $table = 'kandidates';
    protected $fillable = [
        'nama',
        'visi',
        'misi',
        'foto',
    ];
    
}
