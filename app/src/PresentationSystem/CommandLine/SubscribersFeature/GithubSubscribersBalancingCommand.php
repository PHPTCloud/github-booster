<?php
declare(strict_types=1);

namespace App\PresentationSystem\CommandLine\SubscribersFeature;

use App\CommandQueryBusSystem\SubscribersFeature\SubscribersManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'github:subscribers:balancing',
    description: 'Подписывается на пользователей, которые подписались на целевого пользователя,'
    . ' но на которых не подписан целевой пользователь.'
)]
class GithubSubscribersBalancingCommand extends Command
{
    private const GITHUB_PERSONAL_TOKEN_OPTION = 'token';
    private const GITHUB_TARGET_USERNAME_OPTION = 'username';

    public function __construct(
        private readonly SubscribersManagerInterface $subscribersManager,
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

        $this->subscribersManager->subscribersBalancing($targetUserToken, $targetUsername);

        return self::SUCCESS;
    }
}
