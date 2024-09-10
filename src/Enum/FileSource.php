<?php

namespace Didntread\NetSapiens\Enum;

enum FileSource: string
{
    case Unknown = 'unknown';
    case TextToSpeech = 'tts';
    case Upload = 'upload';
}
