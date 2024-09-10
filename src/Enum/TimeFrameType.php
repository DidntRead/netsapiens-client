<?php

namespace Didntread\NetSapiens\Enum;

enum TimeFrameType: string
{
    case DaysOfWeek = 'days-of-week';
    case SpecificDates = 'specific-dates';
    case Holidays = 'holidays';
    case Custom = 'custom';
    case Always = 'always';
}
