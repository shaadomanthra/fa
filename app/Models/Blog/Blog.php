<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Label;
use App\Models\Blog\Collection;

class Blog extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'image',
        'body',
        'test',
        'conlusion',
        'schedule',
        'status',
        'user_id',
        'meta_title',
        'meta_description',
        'created_at',
        'updated_at'

        // add all other fields
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\Label');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Models\Blog\Label');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Models\Blog\Collection');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\Blog\Collection');
    }

    public function related()
    {
        $items=[];
        if($this->categories->first()){
          $coll = $this->categories->first();
          $items = $coll->blogs()->where('id','!=',$this->id)->limit(3)->get(); 
        }

        if(count($items)<4 && $this->tags->first()){
            $tag= $this->tags->first();
            $items = $tag->blogs()->where('id','!=',$this->id)->limit(3)->get(); 
        }

        if(count($items)<4){
          $items = $this->where('id','!=',$this->id)->limit(3)->get();
        }

        foreach($items as $item){
            if($item->categories->first())
            $item->categories = $item->categories->first();
            else
                $item->categories = [];
        }


        return $items;

    }
}
