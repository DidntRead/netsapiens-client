<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\FileSource;

/**
 * @property string $filename The name of the file.
 * @property int $ordinal_order The ordinal order or sequence in which the file is positioned.
 * @property int $file_duration_seconds The duration of the file in seconds.
 * @property int $file_size_kilobytes The size of the file in kilobytes.
 * @property Carbon $created_at The date and time when the file was created.
 * @property string $file_access_url The URL to access the file.
 * @property string $file_script_text The text content or script associated with the file.
 * @property FileSource $file_source The source of the file (represented by an enum).
 * @property string $text_to_speech_voice_id The ID of the text-to-speech voice used for the file.
 * @property string $text_to_speech_language The language used for the text-to-speech conversion.
 * @property Carbon $recorded_at The date and time when the file was recorded.
 */
class VoicemailGreetingResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);
        $this->meta = [
            'filename' => $parameters['filename'],
            'id' => $parameters['ordinal-order'],
        ];

        $this->properties = [
            'filename' => $parameters['filename'],
            'ordinal_order' => $parameters['ordinal-order'],
            'file_duration_seconds' => $parameters['file-duration-seconds'],
            'file_size_kilobytes' => $parameters['file-size-kilobytes'],
            'created_at' => Carbon::parse($parameters['created-datetime']),
            'file_access_url' => $parameters['file-access-url'],
            'file_script_text' => $parameters['file-script-text'],
            'file_source' => FileSource::from($parameters['file-source']),
            'text_to_speech_voice_id' => $parameters['text-to-speech-voice-id'],
            'text_to_speech_language' => $parameters['text-to-speech-language'],
            'recorded_at' => Carbon::parse($parameters['recorded-datetime']),
        ];
    }

    public function __toString(): string
    {
        $context = [];
        foreach ($this->meta as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[VoicemailGreetingResource ' . \implode(' ', $context) . ']';
    }
}