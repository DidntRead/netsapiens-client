<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\FileSource;

/**
 * Properties for the music on hold and file metadata.
 *
 * @property string $filename The name of the file.
 * @property int $file_duration_seconds The duration of the file in seconds.
 * @property int $file_size_kilobytes The size of the file in kilobytes.
 * @property string $file_access_url The URL for accessing the file.
 * @property Carbon $created_at The date and time when the file was created.
 * @property string $file_script_text The text or script content associated with the file.
 * @property FileSource $file_source The source of the file (or `FileSource::Unknown` if the source is empty).
 * @property string $text_to_speech_voice_id The ID of the text-to-speech voice used for the file.
 * @property string $text_to_speech_language The language used in the text-to-speech file.
 * @property Carbon $recorded_at The date and time when the file was recorded.
 * @property int $ordinal_order The order of the file in the list of music on holds.
 */
class MOHResource extends JsonResource
{
    public function __construct(Client $client, array $parameters)
    {
        parent::__construct($client);

        $this->meta = [
            'id' => $parameters['filename'],
        ];

        $this->properties = [
            'filename' => $parameters['filename'],
            'file_duration_seconds' => $parameters['file-duration-seconds'],
            'file_size_kilobytes' => $parameters['file-size-kilobytes'],
            'file_access_url' => $parameters['file-access-url'],
            'created_at' => Carbon::parse($parameters['created-datetime']),
            'file_script_text' => $parameters['file-script-text'],
            'file_source' => empty($parameters['file-source']) ? FileSource::from($parameters['file-source']) : FileSource::Unknown,
            'recorded_at' => Carbon::parse($parameters['recorded-datetime']),
            'text_to_speech_voice_id' => $parameters['text-to-speech-voice-id'],
            'text_to_speech_language' => $parameters['text-to-speech-language'],
            'ordinal_order' => $parameters['ordinal-order'],
        ];
    }
}
