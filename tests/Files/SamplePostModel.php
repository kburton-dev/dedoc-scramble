<?php

namespace Dedoc\Scramble\Tests\Files;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SamplePostModel extends Model
{
    public $timestamps = true;

    protected $guarded = [];

    protected $table = 'posts';

    protected $with = ['parent', 'children', 'user'];

    protected $casts = [
        'status' => Status::class,
        'settings' => 'array',
    ];

    public function getReadTimeAttribute()
    {
        return 123;
    }

    public function getViewsAttribute(): int
    {
        return 50;
    }

    public function userEmail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user->email
        );
    }

    /**
     * @return Attribute<string>
     */
    public function userName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user->name,
        );
    }

    public function parent()
    {
        return $this->belongsTo(SamplePostModel::class);
    }

    public function children()
    {
        return $this->hasMany(SamplePostModel::class);
    }

    public function user()
    {
        return $this->belongsTo(SampleUserModel::class, 'user_id');
    }
}
