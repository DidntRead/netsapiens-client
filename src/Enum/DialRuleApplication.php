<?php

namespace Didntread\NetSapiens\Enum;

enum DialRuleApplication: string
{
    case AvailableNumber = 'available-number';
    case ToVoicemailResidential = 'to-voicemail-residential';
    case ToCallQueue = 'to-callqueue';
    case ToCallQueueAnnounceCountCallersAhead = 'to-callqueue-announce-count-callers-ahead';
    case ToCallQueueAnnounceExpectedWaitTime = 'to-callqueue-announce-expected-wait-time';
    case ToConnection = 'to-connection';
    case ToConnectionOrUserNoFailover = 'to-connection-or-user-no-failover';
    case ToSingleDevice = 'to-single-device';
    case ToUser = 'to-user';
    case ToUserResidential = 'to-user-residential';
    case ToVoicemail = 'to-voicemail';
    case SpamScreening = 'spam-screening';
    case ToConnectionBlockCallerId = 'to-connection-block-caller-id';
    case ToConnectionNoTimeout = 'to-connection-no-timeout';
    case ToConnectionAddHeaderForceCallerId = 'to-connection-add-header-force-caller-id';
    case ToConnectionAddHeaderNoTimeout = 'to-connection-add-header-no-timeout';
    case ToConnectionAddHeader = 'to-connection-add-header';
    case ToSingleDeviceAddHeaderAllowVoicemail = 'to-single-device-add-header-allow-voicemail';
    case ToSingleDeviceAddHeaderAllowVoicemailResidential = 'to-single-device-add-header-allow-voicemail-residential';
    case ToSingleDeviceAddHeader = 'to-single-device-add-header';
    case ToUserAddHeader = 'to-user-add-header';
    case ToUserResidentialAddHeader = 'to-user-residential-add-header';
    case ToUserNotifyOfRecording = 'to-user-notify-of-recording';
    case Hangup = 'hangup';
    case ToUserAnswerAndFakeRingback = 'to-user-answer-and-fake-ringback';
}
