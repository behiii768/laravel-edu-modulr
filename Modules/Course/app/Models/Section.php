<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['title' , 'description' , 'file' , 'chapter_id' , 'video'] ;

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
