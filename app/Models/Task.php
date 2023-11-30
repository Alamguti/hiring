<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['nombre', 'usuario_id','completada'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
