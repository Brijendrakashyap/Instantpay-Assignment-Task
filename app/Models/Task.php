<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description', 'board_id', 'completed'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
