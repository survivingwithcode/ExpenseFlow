<?php

namespace App\Filament\Resources\Agencies\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class AgencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->required()
                ->label('Agency Name'),

            FileUpload::make('logo')
                ->label('Agency Logo')
                ->image()
                ->directory('agency-logos')
                ->nullable(),
            ]);
    }
}
