<?php
declare(strict_types=1);

namespace App\Service\Todoist;

use Spatie\DataTransferObject\DataTransferObject;

class TodoistTask extends DataTransferObject
{
    /** @var string */
    public $content;

    /** @var string|null */
    public $label;

    /** @var \Carbon\Carbon */
    public $due;

    /**@var bool */
    public $autoReminder;
}
