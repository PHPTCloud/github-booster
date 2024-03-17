<?php
declare(strict_types=1);

namespace App\PresentationSystem\CommandLine\SubscribersFeature;

use App\ApplicationSystem\SubscribersFeature\Enums\ActionsEnum;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandlerInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryFactoryInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Exception\OutOfRangeException;
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
    private const ACTION_STRATEGY_OPTION = 'action';
    private const PAGE_OPTION = 'page';
    private const LIMIT_OPTION = 'limit';

    public function __construct(
        private readonly CheckUnsubscribedActionHandlerInterface $handler,
        private readonly CheckUnsubscribedActionQueryFactoryInterface $queryFactory,
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
            ->addOption(
                self::ACTION_STRATEGY_OPTION,
                null,
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL,
                'Действия, которые нужно выполнить с теми, кто не подписан на целевого пользователя.'
                    . ' Доступные действия: ' . ActionsEnum::getCasesAsString(),
            )
            ->addOption(
                self::PAGE_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'Страница, с которой нужно начать поиск.',
                1,
            )
            ->addOption(
                self::LIMIT_OPTION,
                null,
                InputOption::VALUE_REQUIRED,
                'Количество пользователей, проверяемых за одну итерацию',
                30,
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $targetUserToken = $input->getOption(self::GITHUB_PERSONAL_TOKEN_OPTION);
        $targetUsername = $input->getOption(self::GITHUB_TARGET_USERNAME_OPTION);
        $actions = $input->getOption(self::ACTION_STRATEGY_OPTION);
        $page = filter_var($input->getOption(self::PAGE_OPTION), FILTER_VALIDATE_INT) ?: 1;
        $limit = filter_var($input->getOption(self::LIMIT_OPTION), FILTER_VALIDATE_INT) ?: 30;

        $totalCount = 0;
        $isEmpty = false;

        while ($isEmpty === false) {
            try {
                $unfollowingUsers = $this->handler->handle($this->queryFactory->create($targetUserToken, $targetUsername, $actions, $page, $limit))
                    ->getItems();

                if (!empty($unfollowingUsers)) {
                    $page = 1;
                    $totalCount += count($unfollowingUsers);
                    continue;
                }

                $page += 1;
            } catch (OutOfRangeException $exception) {
                $isEmpty = true;
            }
        }

        $table = new Table($output);
        $table->setHeaders(['Количество не подписавшихся пользователей']);
        $table->addRow([$totalCount]);

        $table->render();

        return self::SUCCESS;
    }
}
