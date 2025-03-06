<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;
    protected $table ="issues";
    protected $fillable =[
      'module',
      'issue_type',
      'priority',
      'description',
      'img'
    ];
}
