<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Piscina extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'litros',
        'cliente_id'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function lecturas(): HasMany
    {
        return $this->hasMany(LecturaPiscina::class, 'piscina_id');
    }

}
