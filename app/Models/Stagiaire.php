<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stagiaire extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'cef',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'city',
        'photo',
    ];

    /**
     * Get the modules associated with the stagiaire.
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'module_stagiaire');
    }
}
