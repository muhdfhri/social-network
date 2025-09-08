<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'user_id',
        'icon',
        'thumbnail',
        'description',
        'name',
        'location',
        'type',
        'members',
        'is_private',
    ];

    /**
     * Get the user that owns the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The users that belong to the group.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id')
            ->withTimestamps();
    }

    /**
     * Get all of the posts for the Group
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the member count for the group.
     */
    public function getMembersCountAttribute()
    {
        return $this->members()->count();
    }
}
