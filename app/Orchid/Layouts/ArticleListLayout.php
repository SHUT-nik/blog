<?php

namespace App\Orchid\Layouts;

use App\Article;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class ArticleListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $data = 'articles';
    /**
     * @return TD[]
     */
    public function fields(): array
    {
        //dd(Article::find(3)->creator->name);
        return [

            TD::set('title','Названия')->link('platform.article.edit', 'id','title'),
            TD::set('created_at', 'Создано'),
            TD::set('updated_at', 'Последняя правка'),
            TD::set('creator.name', 'Создатель'),
            TD::set('publicator.name', 'Публикатор'),

        ];

    }
}
