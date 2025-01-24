<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;

    protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = true;

    // protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'title',
        'slug',
        'content',
        'active',
        'comments_enabled',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            $page->user_id = auth()->user()->id;
        });
    }

    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    public function getPageLink()
    {
        return url($this->slug);
    }

    public function getOpenButton()
    {
        return '<a class="btn btn-sm btn-link" href="' . $this->getPageLink() . '" target="_blank">' .
            '<i class="la la-eye"></i> ' . trans('backpack::pagemanager.open') . '</a>';
    }

}
