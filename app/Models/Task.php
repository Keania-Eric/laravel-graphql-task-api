<?php

namespace App\Models;

use App\Models\Scopes\UserTaskScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserTaskScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwner(User $user)
    {
        return $user->id == $this->user_id;
    }
}
