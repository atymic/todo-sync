<?php
declare(strict_types=1);

namespace App\Service\GoogleReminders;

use Carbon\Carbon;

class GoogleReminder
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var Carbon
     */
    public $remindAt;
    /**
     * @var int|null
     */
    public $createdAt;
    /**
     * @var bool
     */
    public $done;
    /**
     * @var bool
     */
    public $repeating;

    public function __construct(
        string $id,
        string $title,
        Carbon $remindAt,
        Carbon $createdAt = null,
        bool $done = false,
        bool $isRepeating = false
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->remindAt = $remindAt;
        $this->createdAt = $createdAt;
        $this->done = $done;
        $this->repeating = $isRepeating;
    }

    public function __toString()
    {
        if ($this->done) {
            return "{$this->remindAt->format("Y.m.d")} {$this->title} [Done]";
        }

        return "{$this->remindAt->format("Y.m.d")} {$this->title}";
    }
}
