<?php

namespace Didntread\NetSapiens\Enum;

enum EventType: string
{
    case Agent = 'agent';
    case Call = 'call';
    case CallOrig = 'call_origid';
    case CallLog = 'cdr';
    case Message = 'message';
    case MessageSession = 'messagesession';
    case Subscriber = 'subscriber';
    case Presence = 'presence';
    case Voicemail = 'voicemail';
}
