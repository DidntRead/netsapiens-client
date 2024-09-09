<?php

namespace Didntread\NetSapiens\Enum;

enum SubscriptionStatus: string
{
    case Active = 'active';
    case Pending = 'pending';
    case Error = 'error';
}
