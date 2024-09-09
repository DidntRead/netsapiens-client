<?php

namespace App\Helpers\Phones\AnswerRules;

class AnswerRules
{
    private string $synchronous;

    private string $enabled;

    private ?ForwardFeature $simultaneousRing;

    private ?Feature $doNotDisturb;

    private ?ForwardFeature $forwardAlways;

    private ?ForwardFeature $forwardOnActive;

    private ?ForwardFeature $forwardOnBusy;

    private ?ForwardFeature $forwardNoAnswer;

    private ?ForwardFeature $forwardWhenUnregistered;

    private ?ForwardFeature $forwardOnDnd;

    private ?ForwardFeature $forwardOnSpamCall;

    private ?Feature $callScreening;

    private ?ForwardFeature $phoneNumbersToAllow;

    private ?ForwardFeature $phoneNumbersToReject;

    private string $timeFrame;

    private string $newPosition;

    public function __construct()
    {
        $this->synchronous = 'no';
        $this->enabled = 'no';
        $this->simultaneousRing = null;
        $this->doNotDisturb = null;
        $this->forwardAlways = null;
        $this->forwardOnActive = null;
        $this->forwardOnBusy = null;
        $this->forwardNoAnswer = null;
        $this->forwardWhenUnregistered = null;
        $this->forwardOnDnd = null;
        $this->forwardOnSpamCall = null;
        $this->callScreening = null;
        $this->phoneNumbersToAllow = null;
        $this->phoneNumbersToReject = null;
        $this->timeFrame = '*';
        $this->newPosition = '';
    }

    public function setSynchronous(string $synchronous): static
    {
        $this->synchronous = $synchronous;

        return $this;
    }

    public function setEnabled(string $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function setSimultaneousRing(ForwardFeature $simultaneousRing): static
    {
        $this->simultaneousRing = $simultaneousRing;

        return $this;
    }

    public function setDoNotDisturb(Feature $doNotDisturb): static
    {
        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    public function setForwardAlways(ForwardFeature $forwardAlways): static
    {
        $this->forwardAlways = $forwardAlways;

        return $this;
    }

    public function setForwardOnActive(ForwardFeature $forwardOnActive): static
    {
        $this->forwardOnActive = $forwardOnActive;

        return $this;
    }

    public function setForwardOnBusy(ForwardFeature $forwardOnBusy): static
    {
        $this->forwardOnBusy = $forwardOnBusy;

        return $this;
    }

    public function setForwardNoAnswer(ForwardFeature $forwardNoAnswer): static
    {
        $this->forwardNoAnswer = $forwardNoAnswer;

        return $this;
    }

    public function setForwardWhenUnregistered(ForwardFeature $forwardWhenUnregistered): static
    {
        $this->forwardWhenUnregistered = $forwardWhenUnregistered;

        return $this;
    }

    public function setForwardOnDnd(ForwardFeature $forwardOnDnd): static
    {
        $this->forwardOnDnd = $forwardOnDnd;

        return $this;
    }

    public function setForwardOnSpamCall(ForwardFeature $forwardOnSpamCall): static
    {
        $this->forwardOnSpamCall = $forwardOnSpamCall;

        return $this;
    }

    public function setCallScreening(Feature $callScreening): static
    {
        $this->callScreening = $callScreening;

        return $this;
    }

    public function setPhoneNumbersToAllow(ForwardFeature $phoneNumbersToAllow): static
    {
        $this->phoneNumbersToAllow = $phoneNumbersToAllow;

        return $this;
    }

    public function setPhoneNumbersToReject(ForwardFeature $phoneNumbersToReject): static
    {
        $this->phoneNumbersToReject = $phoneNumbersToReject;

        return $this;
    }

    public function setTimeFrame(string $timeFrame): static
    {
        $this->timeFrame = $timeFrame;

        return $this;
    }

    public function setNewPosition(string $newPosition): static
    {
        $this->newPosition = $newPosition;

        return $this;
    }

    public function toJsonArray(): array
    {
        return [
            'synchronous' => $this->synchronous,
            'enabled' => $this->enabled,
            'simultaneous-ring' => [
                'enabled' => $this->simultaneousRing ? $this->simultaneousRing->isEnabled() : 'no',
                'parameters' => $this->simultaneousRing ? $this->simultaneousRing->getParameters() : [],
            ],
            'do-not-disturb' => [
                'enabled' => $this->doNotDisturb ? $this->doNotDisturb->isEnabled() : 'no',
            ],
            'forward-always' => [
                'enabled' => $this->forwardAlways ? $this->forwardAlways->isEnabled() : 'no',
                'parameters' => $this->forwardAlways ? $this->forwardAlways->getParameters() : [],
            ],
            'forward-on-active' => [
                'enabled' => $this->forwardOnActive ? $this->forwardOnActive->isEnabled() : 'no',
                'parameters' => $this->forwardOnActive ? $this->forwardOnActive->getParameters() : [],
            ],
            'forward-on-busy' => [
                'enabled' => $this->forwardOnBusy ? $this->forwardOnBusy->isEnabled() : 'no',
                'parameters' => $this->forwardOnBusy ? $this->forwardOnBusy->getParameters() : [],
            ],
            'forward-no-answer' => [
                'enabled' => $this->forwardNoAnswer ? $this->forwardNoAnswer->isEnabled() : 'no',
                'parameters' => $this->forwardNoAnswer ? $this->forwardNoAnswer->getParameters() : [],
            ],
            'forward-when-unregistered' => [
                'enabled' => $this->forwardWhenUnregistered ? $this->forwardWhenUnregistered->isEnabled() : 'no',
                'parameters' => $this->forwardWhenUnregistered ? $this->forwardWhenUnregistered->getParameters() : [],
            ],
            'forward-on-dnd' => [
                'enabled' => $this->forwardOnDnd ? $this->forwardOnDnd->isEnabled() : 'no',
                'parameters' => $this->forwardOnDnd ? $this->forwardOnDnd->getParameters() : [],
            ],
            'forward-on-spam-call' => [
                'enabled' => $this->forwardOnSpamCall ? $this->forwardOnSpamCall->isEnabled() : 'no',
                'parameters' => $this->forwardOnSpamCall ? $this->forwardOnSpamCall->getParameters() : [],
            ],
            'call-screening' => [
                'enabled' => $this->callScreening ? $this->callScreening->isEnabled() : 'no',
            ],
            'phone-numbers-to-allow' => [
                'enabled' => $this->phoneNumbersToAllow ? $this->phoneNumbersToAllow->isEnabled() : 'no',
                'parameters' => $this->phoneNumbersToAllow ? $this->phoneNumbersToAllow->getParameters() : [],
            ],
            'phone-numbers-to-reject' => [
                'enabled' => $this->phoneNumbersToReject ? $this->phoneNumbersToReject->isEnabled() : 'no',
                'parameters' => $this->phoneNumbersToReject ? $this->phoneNumbersToReject->getParameters() : [],
            ],
            'time-frame' => $this->timeFrame,
            'new-position' => $this->newPosition,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toJsonArray());
    }
}
