# Github booster

## Описание

Идея приложения в том, чтобы иметь под рукой функционал для автоматизированных действий на Github. Также с его помощью планируется сбор метрик и сегментация пользователей, с которыми можно взаимодействовать для достижения конечной цели.

Для системы выделяются следующие задачи:

1. Автоматизировать балансировку подписчиков/подписок. Необходимо отписываться от людей, на которых ранее был подписан пользователь, но которые не подписались в ответ.
2. Собрать метрики, по которым можно сегментировать пользователей. Например, тех кто охотно подписывается в ответ или ставит звезды.
3. Автоматизировать длительный процесс выполнения стратегии "Зуб за Зуб". Принцип стратегии в контексте Github состоит из набора подписчиков за счет взаимной подписки, а также получении звезд за счет взаимного обмена.

## Зависимости проекта

Для работы с проектом требуется наличие на используемой машине следующих инструментов:

1. Docker
2. Docker Compose
3. Bash / Shell
4. Make*

* Необязательные инструменты.

## Установка

При установленном сборщике проектов Make:
```bash
make init
```

Запуск через Docker Compose:
```bash
docker compose build \
  && docker compose up -d --remove-orphans \
  && docker compose exec app composer i
```

## Использование

### Создание Personal Access Token

Перед использованием команд создайте Personal Access Token с [помощью инструкции](https://docs.github.com/ru/enterprise-cloud@latest/authentication/authenticating-with-saml-single-sign-on/authorizing-a-personal-access-token-for-use-with-saml-single-sign-on).

`TODO: Описать минимальный набор доступов для токена.`

### github:subscribers:check-unfollowing

Проверка пользователей, которые не подписались в ответ

```bash
docker compose exec app php bin/console github:subscribers:check-unfollowing \   
  --token='your github personal access token' \
  --username='your username'
```

### github:subscribers:sync

Синхронизирует список подписчиков целевого пользователя.

(!) ВАЖНО: метод перед работой очищает таблицу базы данных, чтобы данные всегда были актуальны.

```bash
docker compose exec app php bin/console github:subscribers:sync \ 
--token='<your personal token>' \
--username='<your user name>'
```

### github:subscriptions:sync

Синхронизирует список подписок целевого пользователя.

(!) ВАЖНО: метод перед работой очищает таблицу базы данных, чтобы данные всегда были актуальны.

```bash
docker compose exec app php bin/console github:subscriptions:sync \ 
--token='<your personal token>' \
--username='<your user name>'
```

### github:subscriptions:balancing

(!) ВАЖНО: метод перед работой очищает таблицу базы данных, чтобы данные всегда были актуальны.

```bash
docker compose exec app php bin/console github:subscriptions:balancing \
--token='<your personal token>' \
--username='<your user name>'
```

### github:subscribers:balancing

(!) ВАЖНО: метод перед работой очищает таблицу базы данных, чтобы данные всегда были актуальны.

```bash
docker compose exec app php bin/console github:subscribers:balancing \
--token='<your personal token>' \
--username='<your user name>'
```
