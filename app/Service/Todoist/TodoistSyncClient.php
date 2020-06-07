<?php
declare(strict_types=1);

namespace App\Service\Todoist;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TodoistSyncClient
{
    private const API_ENDPOINT = 'https://api.todoist.com/sync/v8/sync';

    /** @var string */
    private $apiToken;

    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function createTasks(array $tasks): array
    {
        $commands = array_values(array_map([$this, 'mapTaskToCommand'], $tasks));

        $res = Http::post(self::API_ENDPOINT, [
            'token' => $this->apiToken,
            'commands' => json_encode($commands),
        ]);

        if ($res->failed()) {
            throw new \Exception(sprintf('Todoist Sync failed, %s', $res->body()));
        }

        return $res->json();
    }

    private function mapTaskToCommand(TodoistTask $task)
    {
        return [
            'type' => 'item_add',
            'temp_id' => Str::uuid(),
            'uuid' => Str::uuid(),
            'args' => [
                'content' => $task->label ? sprintf('%s @%s', $task->content, $task->label) : $task->content,
                'due' => [
                    'date' => $task->due->toIso8601ZuluString()
                ],
                'auto_reminder' => $task->autoReminder,
                'auto_parse_labels' => $task->label !== null,
            ],
        ];
    }


}
