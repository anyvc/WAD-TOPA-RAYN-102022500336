<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teknisi extends Model
{
    public const SPESIALISASI = ['Network', 'DB', 'Hardware'];

    public const STATUS = ['tersedia', 'sibuk', 'libur'];

    protected $fillable = ['user_id', 'nama', 'spesialisasi', 'email', 'telepon', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}