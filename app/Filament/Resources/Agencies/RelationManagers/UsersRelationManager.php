<?php

namespace App\Filament\Resources\Agencies\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $title = 'Team Members';

    protected static ?string $label = 'Member';

    protected static ?string $pluralLabel = 'Members';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('pivot.role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'employee'   => 'success',
                        'freelancer' => 'warning',
                        'accountant' => 'info',
                        default      => 'gray',
                    }),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Add team member')
                    ->icon('heroicon-o-user-plus')
                    ->preloadRecordSelect() // ← more modern way (Filament v3.1+)
                    ->recordSelect(
                        fn (Select $select) => $select
                            ->label('User')
                            ->searchable()
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} — {$record->email}")
                    )
                    ->recordSelectOptionsQuery(
                        fn (Builder $query) => $query
                            ->where('users.id', '!=', $this->getOwnerRecord()->owner_id)
                            // Optional: ->whereDoesntHave('agencies', fn($q) => $q->where('agency_id', $this->getOwnerRecord()->id))
                    )
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),

                        Select::make('role')
                            ->label('Role in agency')
                            ->required()
                            ->native(false)
                            ->options([
                                'employee'   => 'Employee',
                                'freelancer' => 'Freelancer',
                                'accountant' => 'Accountant',
                            ])
                            ->default('employee'),
                    ])
                    ->modalHeading('Add User to Agency')
                    ->modalSubmitActionLabel('Add Member'),
            ])
            ->actions([
                DetachAction::make()
                    ->label('Remove')
                    ->icon('heroicon-o-user-minus')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Remove team member?')
                    ->modalDescription(fn ($record) => "Are you sure you want to remove **{$record->name}** from this agency?")
                    ->modalSubmitActionLabel('Yes, remove')
                    // Most important: protect the owner
                    ->visible(fn ($record) => $record->id !== $this->getOwnerRecord()->owner_id),
            ])
            ->bulkActions([
                // You can add bulk detach if you want
                // DetachBulkAction::make(),
            ]);
    }
}