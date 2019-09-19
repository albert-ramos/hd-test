<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'content', 'background_color', 'template'
    ];

    /**
     * RELATIONSHIPS
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
