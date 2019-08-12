<?php

namespace App\Orchid\Screens;

use App\Article;
use App\Orchid\Layouts\ArticleListLayout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class ArticleListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Статьи';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Список статей';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        return [
            'articles'=>Article::paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::name('Создать новую статью')
                ->icon('icon-pencil')
                ->link(route('platform.article.edit'))
        ];
    }

    public function layout(): array
    {
        return [
            ArticleListLayout::class
        ];
    }
}
