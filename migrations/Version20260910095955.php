<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260910095955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE purchase_lesson (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, price_paid NUMERIC(10, 2) NOT NULL, purchase_type VARCHAR(20) NOT NULL, user_id INT NOT NULL, lesson_pack_id INT DEFAULT NULL, lesson_id INT DEFAULT NULL, INDEX IDX_231B76A6A76ED395 (user_id), INDEX IDX_231B76A6EC65E0B0 (lesson_pack_id), INDEX IDX_231B76A6CDF80196 (lesson_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE purchase_lesson ADD CONSTRAINT FK_231B76A6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE purchase_lesson ADD CONSTRAINT FK_231B76A6EC65E0B0 FOREIGN KEY (lesson_pack_id) REFERENCES lesson_pack (id)');
        $this->addSql('ALTER TABLE purchase_lesson ADD CONSTRAINT FK_231B76A6CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase_lesson DROP FOREIGN KEY FK_231B76A6A76ED395');
        $this->addSql('ALTER TABLE purchase_lesson DROP FOREIGN KEY FK_231B76A6EC65E0B0');
        $this->addSql('ALTER TABLE purchase_lesson DROP FOREIGN KEY FK_231B76A6CDF80196');
        $this->addSql('DROP TABLE purchase_lesson');
    }
}
