<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum NewsCategory: string implements HasColor, HasLabel
{
    case Announcement = 'announcement';
    case Education = 'education';
    case Activity = 'activity';
    case DataUpdate = 'data_update';

    public function getLabel(): string
    {
        return match ($this) {
            self::Announcement => 'Pengumuman',
            self::Education => 'Edukasi',
            self::Activity => 'Kegiatan',
            self::DataUpdate => 'Pembaruan Data',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Announcement => 'warning',
            self::Education => 'info',
            self::Activity => 'success',
            self::DataUpdate => 'primary',
        };
    }

    /** Tone used by the public design system (see docs/DESIGN_SYSTEM.md). */
    public function tone(): string
    {
        return match ($this) {
            self::Announcement => 'sun',
            self::Education => 'sky',
            self::Activity => 'mint',
            self::DataUpdate => 'coral',
        };
    }
}
