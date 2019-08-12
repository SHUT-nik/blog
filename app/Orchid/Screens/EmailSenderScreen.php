<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EmailSenderScreen extends Screen
{
    public $name = 'Mail';
    public $description = 'Eto php';

    public function query(): array
    {
        return [];
    }

    public function commandBar(): array
    {
        return [
            Link::name('Отправить сообщение')
            ->icon('icon-paper-plane')
            ->method('sendMessage')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('subject')
                    ->title('Subject')
                    ->required()
                    ->placeholder('Message subject line')
                    ->help('Enter the subject line for your message'),

                Relation::make('users.')
                    ->title('Recipients')
                    ->multiple()
                    ->required()
                    ->placeholder('Email addresses')
                    ->help('Enter the users that you would like to send this message to.')
                    ->fromModel(User::class,'name','email'),

                Quill::make('content')
                    ->title('Content')
                    ->required()
                    ->placeholder('Insert text here ...')
                    ->help('Add the content for the message that you would like to send.')

            ])->with(70)
        ];
    }
    public function sendMessage(Request $reques)
    {
        Alert::info('Your email message has been sent successfully.');
        return back();
    }
}
