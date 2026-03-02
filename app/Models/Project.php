<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
        protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'description',
        'logo_url',
        'country',
        'phone_number',
        'company_name',
        'address',
        'website_url',
        'android_url',
        'ios_url',
        'icon_letter',
        'color',
        'notes',
        'is_favorite'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function credentials()
{
    return $this->hasMany(ProjectCredential::class);
}
}
