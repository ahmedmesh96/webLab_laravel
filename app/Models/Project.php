<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'client_name',
        'project_url',
        'status',
        'author_id',
        'category_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function markets(): BelongsToMany
    {
        return $this->belongsToMany(Market::class);
    }

    public function relatedProjects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_related_content',
            'project_id',
            'related_project_id'
        )->withTimestamps();
    }
}
