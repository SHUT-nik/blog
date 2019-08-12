<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use PhpParser\Node\Stmt\Return_;

class Article extends Model
{
    use AsSource;
    protected $fillable =[
        'title',
        'text',
        'announce',
        'is_publicated'

    ];

    public function creator()
    {
        return $this->hasOne(\App\User::class, 'id', 'created_user_id');
    }


    public function publicator(){
        return $this->hasOne(\App\User::class, 'id', 'publicated_user//_id');

    }
}
