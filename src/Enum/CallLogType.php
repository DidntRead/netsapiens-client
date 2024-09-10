<?php

namespace Didntread\NetSapiens\Enum;

enum CallLogType: string
{
    case Outbound = 'Outbound';
    case Inbound = 'Inbound';
    case OnNet = 'On-net';
    case OffNet = 'Off-net';
    case Missed = 'Missed';
    case Received = 'Received';
}