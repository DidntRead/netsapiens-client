<?php

namespace Didntread\NetSapiens\Enum;

enum AgentAvailability: string
{
    case Automatic = 'automatic';
    case Manual = 'manual';
    case Disabled = 'disabled';
    case OffnetAutomatic = 'offnet-automatic';
}
