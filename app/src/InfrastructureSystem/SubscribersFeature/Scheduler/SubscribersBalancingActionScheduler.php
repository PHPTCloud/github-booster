<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscribersFeature\Scheduler;

use App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionMessageFactoryInterface;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;

#[AsSchedule('subscribers.balancing')]
class SubscribersBalancingActionScheduler implements ScheduleProviderInterface
{
    public function __construct(
        private readonly string $githubPersonalAccessToken,
        private readonly string $githubTargetUsername,
        private readonly string $subscribersBalancingSchedule,
        private readonly SubscribersBalancingActionMessageFactoryInterface $messageFactory,
    ) {}

    public function getSchedule(): Schedule
    {
        return (new Schedule())->add(RecurringMessage::cron(
            $this->subscribersBalancingSchedule,
            $this->messageFactory->create(
                $this->githubPersonalAccessToken,
                $this->githubTargetUsername,
            ),
        ));
    }
}
