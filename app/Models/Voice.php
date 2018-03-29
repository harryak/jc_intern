<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Voice extends \Eloquent {
    protected $casts = [
        'child_group' => 'boolean'
    ];

    public function users() {
        return $this->hasMany('App\Models\User');
    }

    public function super_group() {
        return $this->belongsTo('App\Models\Voice', 'super_group', 'id');
    }

    public function children() {
        return $this->hasMany('App\Models\Voice', 'super_group', 'id');
    }

    public function rehearsals() {
        return $this->hasMany('App\Models\Rehearsal');
    }

    public static function getChildVoices() {
        return Voice::all()->where('child_group', true);
    }

    public static function getRoot(){
        return Voice::whereNull('super_group' )->first();
    }

    /**
     * Get the distinct parent voices of the given set of voices.
     *
     * @param Voice $voices
     * @return Collection
     */
    public static function getParentVoices($voices) {
        $parents = new Collection();

        $voices->load('super_group');

        foreach ($voices as $voice) {
            $super_group = $voice->super_group()->first(); // Should only be one, but to be on the safe site we use first().
            $parents->put($super_group->id, $super_group); // Put in collection of parents.
        }

        return $parents;
    }
}