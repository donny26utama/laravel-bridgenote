<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cruds';

    protected $fillable = ['user_id', 'status', 'position'];
}
