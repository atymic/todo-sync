<?php
declare(strict_types=1);

namespace App\Service\GoogleReminders;

use Carbon\Carbon;
use Google_Client;
use Illuminate\Support\Collection;

class GoogleReminderClient
{
    /**
     * @var Google_Client
     */
    private $client;

    public function __construct(string $accessToken, Carbon $accessTokenExpires, string $refreshToken)
    {
        $client = new Google_Client([
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
        ]);
        $client->setScopes('https://www.googleapis.com/auth/reminders');
        $client->setAccessToken([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expires_in' => $accessTokenExpires->getTimestamp(),
            'created' => 0,
        ]);

        $this->client = $client;
    }

    public function listReminders(?string $timezone = null, int $limit = 500): ?Collection
    {
        $httpClient = $this->client->authorize();

        /*
        returns a list of the last num_reminders created reminders, or
        None if an error occurred
        */
        $response = $httpClient->request(
            'POST',
            'https://reminders-pa.clients6.google.com/v1internalOP/reminders/list',
            [
                'headers' => ['content-type' => 'application/json+protobuf'],
                'body' => $this->listReminderRequestBody($limit),
            ]
        );

        if ($response->getStatusCode() !== 200) {
            \Log::debug('ERR fetching reminders', ['code' => $response->getStatusCode(), 'expired' => $this->client->isAccessTokenExpired()]);
            return null;
        }

        $content = $response->getBody();
        $content_dict = json_decode((string) $content, true);

        if (!array_key_exists('1', $content_dict)) {
            return collect([]);
        }

        $reminders_dict_list = $content_dict['1'];
        $reminders = [];

        foreach ($reminders_dict_list as $reminder) {
            $reminders[] = $this->buildReminder($reminder, $timezone);
        }

        return collect($reminders);
    }

    public function deleteReminder(string $reminderId): bool
    {
        $response = $this->client->authorize()->request(
            'POST',
            'https://reminders-pa.clients6.google.com/v1internalOP/reminders/delete',
            [
                'headers' => ['content-type' => 'application/json+protobuf'],
                'body' => json_encode((object) ['2' => [(object) ['2' => $reminderId]]]),
            ]
        );

        return $response->getStatusCode() === 200;
    }


    private function listReminderRequestBody(
        int $maxReminders,
        ?int $maxTimeStampMillis = null,
        $excludeRecurrent = true
    ) {
        /*
        The body corresponds to a request that retrieves a maximum of num_reminders reminders,
        whose creation timestamp is less than max_timestamp_msec.
        max_timestamp_msec is a unix timestamp in milliseconds.
        if its value is 0, treat it as current time.
        */
        $body = [
            '5' => 1,  // boolean field: 0 or 1. 0 doesn't work ¯\_(ツ)_/¯
            '6' => $maxReminders,  // number of reminders to retrieve
        ];

        if ($excludeRecurrent) {
            $body['13'] = [
                '1' => 1,
            ];
        }

        if ($maxTimeStampMillis) {
            $maxTimeStampMillis += (int) (15 * 3600 * 1000);
            $body['16'] = $maxTimeStampMillis;
            /*
            Empirically, when requesting with a certain timestamp, reminders with the given timestamp
            or even a bit smaller timestamp are not returned.
            Therefore we increase the timestamp by 15 hours, which seems to solve this...  ~~voodoo~~
            (I wish Google had a normal API for reminders)
            */
        }

        return json_encode($body);
    }

    private function buildReminder(array $r, ?string $timezone): ?GoogleReminder
    {
        try {
            $id = $r['1']['2'];
            $title = $r['3'];

            $year = $r['5']['1'];
            $month = $r['5']['2'];
            $day = $r['5']['3'];

            $remindAt = new Carbon();

            if ($timezone) {
                $remindAt->setTimezone($timezone);
            }

            $remindAt->setDate($year, $month, $day);

            if (array_key_exists('4', $r['5'])) {
                $hour = $r['5']['4']['1'];
                $minute = $r['5']['4']['2'];
                $second = $r['5']['4']['3'];

                $remindAt->setTime($hour, $minute, $second);
            }

            $createdAt = Carbon::createFromTimestampMs($r['18']);
            $done = array_key_exists('8', $r) && $r['8'] === 1;
            $repeating = array_key_exists('16', $r);

            return new GoogleReminder(
                $id,
                $title,
                $remindAt,
                $createdAt,
                $done,
                $repeating
            );
        } catch (\Exception $KeyError) {
            echo('build_reminder failed: unrecognized reminder dictionary format');

            return null;
        }
    }
}
