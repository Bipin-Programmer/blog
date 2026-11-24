<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('author_id')
                ->relationship('author', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

            Textarea::make('excerpt')
                ->rows(3)
                ->maxLength(500),

            FileUpload::make('featured_image')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->directory('blog-thumbnails')
                ->visibility('public'),

            RichEditor::make('content')
                ->required()
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsDirectory('blog-content')
                ->fileAttachmentsVisibility('public')
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Published')
                ->default(false),

            DateTimePicker::make('published_at')
                ->default(now()),
        ]);
    }
}
