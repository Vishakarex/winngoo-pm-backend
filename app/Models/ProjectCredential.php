<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCredential extends Model
{
    protected $fillable = [
    'project_id',
    'type',
    'title',
    'login_url',
    'email',
    'password',
    'notes',
     'otp',
        'otp_expires_at',
];

public function project()
{
    return $this->belongsTo(Project::class);
}

  protected $casts = [
        'otp_expires_at' => 'datetime',
             'password' => 'encrypted',  
    ];
}
