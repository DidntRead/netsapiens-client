<?php

namespace Didntread\NetSapiens\Enum;

enum UserScope: string
{
    case BasicUser = 'Basic User';
    case SimpleUser = 'Simple User';
    case AdvancedUser = 'Advanced User';
    case CallCenterAgent = 'Call Center Agent';
    case SiteManager = 'Site Manager';
    case CallCenterSupervisor = 'Call Center Supervisor';
    case OfficeManager = 'Office Manager';
    case Reseller = 'Reseller';
    case SuperUser = 'Super User';
    case NDP = 'NDP';
    case NoPortal = 'No Portal';
}
