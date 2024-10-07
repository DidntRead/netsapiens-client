<?php

namespace Didntread\NetSapiens\Data;

use Carbon\Carbon;
use Didntread\NetSapiens\Client;
use Didntread\NetSapiens\Enum\FileSource;

/**
 * Properties for the voicemail and file metadata.
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
 * @property string $voicemail_from_name The name of the sender of the voicemail.
 * @property string $voicemail_from_user The username of the sender of the voicemail.
 * @property string $voicemail_from_host The host from which the voicemail was sent.
 * @property string $voicemail_from_caller_id_number The caller ID number associated with the voicemail sender.
 * @property Carbon $recorded_at The date and time when the file was recorded.
 * @property Carbon $recording_started_at The date and time when the voicemail recording started.
 * @property string $timezone The timezone in which the recording occurred.
 */
class VoicemailResource extends JsonResource
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
            'file_access_url' => $parameters['file-access-url'] ?? $parameters['file-access-url '],
            'created_at' => Carbon::parse($parameters['created-datetime']),
            'file_script_text' => $parameters['file-script-text'],
            'file_source' => empty($parameters['file-source']) ? FileSource::Unknown : FileSource::from($parameters['file-source']),
            'text_to_speech_voice_id' => $parameters['text-to-speech-voice-id'],
            'text_to_speech_language' => $parameters['text-to-speech-language'],
            'voicemail_from_name' => $parameters['voicemail-from-name'],
            'voicemail_from_user' => $parameters['voicemail-from-user'],
            'voicemail_from_host' => $parameters['voicemail-from-host'],
            'voicemail_from_caller_id_number' => $parameters['voicemail-from-caller-id-number'],
            'recorded_at' => Carbon::parse($parameters['recorded-datetime']),
            'recording_started_at' => Carbon::parse($parameters['voicemail-recording-started-datetime']),
            'timezone' => $parameters['timezone'],
        ];
    }
}
