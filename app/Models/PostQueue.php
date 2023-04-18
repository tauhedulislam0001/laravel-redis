<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostQueue extends Model
{
    use HasFactory;

    protected $table = 'post_queues';
    protected $fillable = ['post_data'];
}
