<?php
declare(strict_types=1);

namespace App\PresentationSystem\CommandLine\SubscribersFeature;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionHandlerInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryFactoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'github:check:unfollowing',
    description: 'Выводит пользователей, которые не подписались на аккаунт после подписки на них.'
)]
class GithubCheckUnfollowingCommand extends Command
{
    private const GITHUB_PERSONAL_TOKEN_OPTION = 'token';
    private const GITHUB_TARGET_USERNAME_OPTION = 'username';

    public function __construct(
        private readonly CheckUnfollowingActionHandlerInterface $handler,
        private readonly CheckUnfollowingActionQueryFactoryInterface $queryFactory,
    ) {
        parent::__construct();
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

        $unfollowingUsers = $this->handler->handle($this->queryFactory->create($targetUserToken, $targetUsername))
            ->getItems();

        $table = new Table($output);
        $table->setHeaderTitle('Total count: ' . count($unfollowingUsers));
        $table->setHeaders(['Login', 'Is subscribed']);

        foreach ($unfollowingUsers as $unfollowingUser) {
            $table->addRow([$unfollowingUser->getLogin(), $unfollowingUser->isSubscribed() ? 'yes' : 'no']);
        }

        $table->render();

        return self::SUCCESS;
    }
}
