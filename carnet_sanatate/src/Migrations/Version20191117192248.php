<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191117192248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, type VARCHAR(255) NOT NULL, breed VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, allergies VARCHAR(255) NOT NULL, weight INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examination (id INT AUTO_INCREMENT NOT NULL, health_card_id INT DEFAULT NULL, date DATE NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_CCDAABC5D7650767 (health_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE health_card (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, card_number VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B914F6C8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE examination ADD CONSTRAINT FK_CCDAABC5D7650767 FOREIGN KEY (health_card_id) REFERENCES health_card (id)');
        $this->addSql('ALTER TABLE health_card ADD CONSTRAINT FK_B914F6C8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE user_details CHANGE birth_date birth_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE health_card DROP FOREIGN KEY FK_B914F6C8E962C16');
        $this->addSql('ALTER TABLE examination DROP FOREIGN KEY FK_CCDAABC5D7650767');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE examination');
        $this->addSql('DROP TABLE health_card');
        $this->addSql('ALTER TABLE user_details CHANGE birth_date birth_date DATE DEFAULT \'NULL\'');
    }
}
