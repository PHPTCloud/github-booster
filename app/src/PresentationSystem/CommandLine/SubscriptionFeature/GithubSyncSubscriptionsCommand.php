<?php
declare(strict_types=1);

namespace App\PresentationSystem\CommandLine\SubscriptionFeature;

use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'github:subscriptions:sync',
    description: 'Синхронизирует список подписок целевого пользователя.'
)]
class GithubSyncSubscriptionsCommand extends Command
{
    private const GITHUB_PERSONAL_TOKEN_OPTION = 'token';
    private const GITHUB_TARGET_USERNAME_OPTION = 'username';

    public function __construct(
        private readonly SubscriptionManagerInterface $subscriptionManager,
        ?string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                self::GITHUB_PERSONAL_TOKEN_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'Персональный токен Github.',
            )
            ->addOption(
                self::GITHUB_TARGET_USERNAME_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'Пользователь, для которого надо проверить подписчиков и подписки.',
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $targetUserToken = $input->getOption(self::GITHUB_PERSONAL_TOKEN_OPTION);
        $targetUsername = $input->getOption(self::GITHUB_TARGET_USERNAME_OPTION);

        $this->subscriptionManager->syncSubscriptions($targetUserToken, $targetUsername);

        return self::SUCCESS;
    }
}
