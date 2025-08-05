<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Pages extends Model
{
    //
    protected $table = "pages";
    protected $fillable = [
        'title',
        'slug',
        'option',
        'details',
        'showapp_menu',
        'status'
    ];

    // Automatically generate unique slug
    protected static function boot()
    {
        parent::boot();

        // On create
        static::creating(function ($page) {
            $page->slug = self::generateUniqueSlug($page->title);
        });

        // On update (only if title changes)
        static::updating(function ($page) {
            if ($page->isDirty('title')) {
                $page->slug = self::generateUniqueSlug($page->title, $page->id);
            }
        });
    }

    // Slug generation logic
    public static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (
            self::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    return $query->where('id', '!=', $ignoreId);
                })->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }

}