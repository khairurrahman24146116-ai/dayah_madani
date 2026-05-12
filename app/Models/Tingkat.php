<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tingkat extends Model
{
    protected $table = 'tingkats';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
    ];

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    public function mapel(): HasMany
    {
        return $this->hasMany(Mapel::class);
    }

    public function santri(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
}
