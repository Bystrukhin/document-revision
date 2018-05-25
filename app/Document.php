<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Document extends Model
{

    public static function boot()
    {
        parent::boot();

        static::updating(function ($document){
            $document->revise();
        });
    }

    public function revisions()
    {

        return $this->belongsToMany(User::class, 'revisions')
            ->withTimestamps()
            ->withPivot(['before', 'after'])
            ->latest('pivot_updated_at');

    }

    public function revise($userId = null, $diff = null)
    {

        $userId = $userId ?: Auth::id();

        $diff = $diff ?: $this->getDiff();

        return $this->revisions()->attach($userId, $diff);

    }

    public function getDiff() {

        $changed = $this->getDirty();
        $before = json_encode(array_intersect_key($this->fresh()->toArray(), $changed));
        $after = json_encode($changed);

        return compact('before', 'after');

    }
}
