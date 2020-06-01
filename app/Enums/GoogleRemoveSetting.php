<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class GoogleRemoveSetting extends Enum
{
    public const IMMEDIATE = 'immediately';
    public const AFTER_TIME = 'after_time';
    public const NEVER = 'never';
}
