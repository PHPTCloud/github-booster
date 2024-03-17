<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Interfaces\Manager;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface SubscribersManagerInterface
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
    public function checkUnsubscribed(
        string $targetUserToken,
        string $targetUsername,
        int $page = 1,
        int $limit = 100,
    ): array;

    /**
     * @param array $users            - неподписанные пользователи.
     * @param string $targetUserToken - токен для аутентификации целевого пользователя (для которого проводим проверку).
     * @param string $targetUsername  - логин целевого пользователя.
     * @param array $actions          - действия, которые нужно выполнить с неподписанным пользователем.
     *
     * @return void
     */
    public function handleCheckUnsubscribedHandledHook(
        array $users,
        string $targetUserToken,
        string $targetUsername,
        array $actions,
    ): void;

    public function unsubscribe(UserInterface $user, string $targetUserToken): void;
}
