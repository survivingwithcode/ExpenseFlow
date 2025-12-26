<?php

namespace App\Filament\Resources\Agencies\Pages;


use App\Filament\Resources\Agencies\AgencyResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAgency extends CreateRecord
{
    protected static string $resource = AgencyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['owner_id'] = Auth::id();

        return $data;
    }


}
