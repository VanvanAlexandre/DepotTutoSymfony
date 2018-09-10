<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180905122749 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D33DA5256D FOREIGN KEY (image_id) REFERENCES card_image (id)');
        $this->addSql('ALTER TABLE card_image CHANGE nom nom VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(80) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D33DA5256D');
        $this->addSql('ALTER TABLE card_image CHANGE nom nom VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user DROP password');
    }
}
