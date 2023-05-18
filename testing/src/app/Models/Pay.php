<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pay extends Model
{
    use HasFactory;

    protected $table = 'pays';
    protected $primaryKey = 'pays_id';

    //data table yang bisa diisi (fillable)
    protected $fillable = [
        'account',
        'account_number',
        'value',
    ];
}