<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
interface CheckUnsubscribedActionHandlerInterface
{
    /**
     * Метод вернет массив объектов UserInterface, которые не подписаны на целевого пользователя.
     *
     * @param string $targetUserToken - токен для аутентификации целевого пользователя (для которого проводим проверку).
     * @param string $targetUsername  - логин целевого пользователя.
     * @param int $page
     * @param int $limit
     *
     * @return UserInterface[]
     */
    public function handle(string $targetUserToken, string $targetUsername, int $page = 1, int $limit = 100): array;
}
