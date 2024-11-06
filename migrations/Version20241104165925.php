<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104165925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE establishement (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(100) NOT NULL, postal_code VARCHAR(5) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, establishement_id INT NOT NULL, name VARCHAR(50) NOT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_C11D7DD1C65F9894 (establishement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion_staff (promotion_id INT NOT NULL, staff_id INT NOT NULL, INDEX IDX_226887CF139DF194 (promotion_id), INDEX IDX_226887CFD4D57CD (staff_id), PRIMARY KEY(promotion_id, staff_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, establishement_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) DEFAULT NULL, email VARCHAR(255) NOT NULL, position VARCHAR(50) DEFAULT NULL, INDEX IDX_426EF392C65F9894 (establishement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) DEFAULT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_B723AF33139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1C65F9894 FOREIGN KEY (establishement_id) REFERENCES establishement (id)');
        $this->addSql('ALTER TABLE promotion_staff ADD CONSTRAINT FK_226887CF139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotion_staff ADD CONSTRAINT FK_226887CFD4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392C65F9894 FOREIGN KEY (establishement_id) REFERENCES establishement (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1C65F9894');
        $this->addSql('ALTER TABLE promotion_staff DROP FOREIGN KEY FK_226887CF139DF194');
        $this->addSql('ALTER TABLE promotion_staff DROP FOREIGN KEY FK_226887CFD4D57CD');
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF392C65F9894');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33139DF194');
        $this->addSql('DROP TABLE establishement');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE promotion_staff');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
