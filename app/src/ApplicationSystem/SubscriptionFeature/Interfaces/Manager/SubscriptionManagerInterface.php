<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Interfaces\Manager;

interface SubscriptionManagerInterface
{
    /**
     * Метод для синхронизации подписок. Берет абсолютно все подписки на данный момент и сохраняет в бд.
     * Синхронизация нужна, чтобы была возможность выполнять меньшее количество запросов в GitHub API и
     * не превышать rate limit.
     *
     * @param string $targetUserToken - токен для аутентификации целевого пользователя (для которого проводим проверку).
     * @param string $targetUsername  - логин целевого пользователя.
     *
     * @return void
     */
    public function syncSubscriptions(string $targetUserToken, string $targetUsername): void;

    /**
     * Удаление всех подписок целевого пользователя. Используется перед синхронизацией.
     *
     * @param string $targetUsername - логин целевого пользователя.
     *
     * @return void
     */
    public function removeSubscriptionsByTargetUsername(string $targetUsername): void;

    /**
     * Метод для отписки от пользователей, которые не подписались на целевого пользователя.
     *
     * @param string $targetUserToken - токен для аутентификации целевого пользователя (для которого проводим проверку).
     * @param string $targetUsername  - логин целевого пользователя.
     *
     * @return void
     */
    public function subscriptionsBalancing(string $targetUserToken, string $targetUsername): void;
}
