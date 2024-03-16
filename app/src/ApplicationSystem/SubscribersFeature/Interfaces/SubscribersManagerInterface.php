<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface SubscribersManagerInterface
{
    /**
     * Метод вернет массив объектов UserInterface, которые не подписаны на целевого пользователя.
     *
     * @param string $targetUserToken - токен для аутентификации целевого пользователя (для которого проводим проверку).
     * @param string $targetUsername  - логин целевого пользователя.
     *
     * @return UserInterface[]
     */
    public function checkUnfollowing(string $targetUserToken, string $targetUsername): array;
}
