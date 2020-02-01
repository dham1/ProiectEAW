<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106210550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE animal CHANGE weight weight INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examination CHANGE health_card_id health_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_details CHANGE birth_date birth_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE animal CHANGE weight weight INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examination CHANGE health_card_id health_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP username');
        $this->addSql('ALTER TABLE user_details CHANGE birth_date birth_date DATE DEFAULT \'NULL\'');
    }
}
