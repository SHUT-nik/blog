<?php

namespace App\Orchid\Screens;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ArticleEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Напишите новую статью';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Article $article): array
    {
        $this->exists = $article->exists;

        if ($this->exists){
            $this->name = 'Редактируйте статью';
        }
        return [
            'article' => $article
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::name('Сохраните статью')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Link::name('Сохранить статью')
                ->icon('icon-note')
                ->method('CreateOrUpdate')
                ->canSee($this->exists),
            Link::name('Удалить')
                ->icon('icon-trash')
                ->method('remove')
                ->canSee($this->exists)
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('article.title')
                    ->title('Заголовок')
                    ->maxlength(250)
                    ->help('Максимум - 250 символов'),

                TextArea::make('article.announce')
                    ->title('Анонс')
                    ->rows(3),

                TextArea::make('article.text')
                    ->title('Текст статьи'),

                CheckBox::make('article.is_publicated')
                    ->placeholder('Опубликовано')
                    ->sendTrueOrFalse(),

            ])
        ];
    }
    public function createOrUpdate(Article $article, Request $request){
        $article->fill($request->get('article'));
        if (!$this->exists){
            $article->created_user_id = Auth::user()->id;
        }
        if ($article->is_publicated){
            $article->publicated_user_id = Auth::user()->id;
        }
        $article->save();
        Alert::info('Ваша статья сохранена');
        return redirect()->route('platform.article.list');
    }

    public function remove(Article $article){
        if ($article->delete()){
            Alert::info('Вы удалили статью');
        } else {
            Alert::warning('Все сломалось, попробуй еще раз');
        }
        return redirect()->route('platform.article.list');
    }
}
