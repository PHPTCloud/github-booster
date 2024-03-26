<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240326004348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание таблицы подписчиков.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE subscribers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subscribers (id INT NOT NULL, target_username VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, internal_id BIGINT NOT NULL, url VARCHAR(255) NOT NULL, repositories_url VARCHAR(255) NOT NULL, subscriptions_url VARCHAR(255) NOT NULL, starred_url VARCHAR(255) NOT NULL, followers_url VARCHAR(255) NOT NULL, following_url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE subscribers_id_seq CASCADE');
        $this->addSql('DROP TABLE subscribers');
    }
}
