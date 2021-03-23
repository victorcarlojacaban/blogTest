<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table ='comments';

    protected $guarded = ['id'];

    protected $appends = [
        'readable_created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replies() 
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    /**
     * Get readable created at
     * 
     * @return string
     */
    public function getReadableCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function parent()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }

    /**
     * Get parents count attribute
     * 
     * @return integer
     */
    public function getParentsCountAttribute()
    {
        $parentCount = 1;

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parent = $parent->parent;
            $parentCount += 1;
        }

        return $parentCount;
    }
}
