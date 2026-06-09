<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    protected $fillable = [
        'code',
        'title',
        'MHP',
        'MHS',
    ];

    /**
     * Get the stagiaires enrolled in this module.
     */
    public function stagiaires(): BelongsToMany
    {
        return $this->belongsToMany(Stagiaire::class, 'module_stagiaire');
    }
}
