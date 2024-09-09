<?php

namespace Didntread\NetSapiens\Enum;

enum CallQueueType: string
{
    case RoundRobin = 'Round-robin';
    case TieredRoundRobin = 'Tiered Round-robin';
    case RingAll = 'Ring All';
    case LinearCascade = 'Linear Cascade';
    case LinearHunt = 'Linear Hunt';
    case CallPark = 'Call Park';
}