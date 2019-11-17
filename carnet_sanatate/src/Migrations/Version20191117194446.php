<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191117194446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_animal (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, animal_id INT NOT NULL, INDEX IDX_FF93822A76ED395 (user_id), INDEX IDX_FF938228E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_animal ADD CONSTRAINT FK_FF93822A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_animal ADD CONSTRAINT FK_FF938228E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE animal CHANGE weight weight INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examination CHANGE health_card_id health_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_details CHANGE birth_date birth_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_animal');
        $this->addSql('ALTER TABLE animal CHANGE weight weight INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examination CHANGE health_card_id health_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_details CHANGE birth_date birth_date DATE DEFAULT \'NULL\'');
    }
}
