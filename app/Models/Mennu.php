<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mennu extends Model
{
    use HasFactory;

    protected $table= 'menues';
    protected $guarded= ['id_menu'];
}
