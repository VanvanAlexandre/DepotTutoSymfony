<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180904121717 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card_image (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, path VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD image_id INT NOT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D33DA5256D FOREIGN KEY (image_id) REFERENCES card_image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_161498D33DA5256D ON card (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D33DA5256D');
        $this->addSql('DROP TABLE card_image');
        $this->addSql('DROP INDEX UNIQ_161498D33DA5256D ON card');
        $this->addSql('ALTER TABLE card DROP image_id');
    }
}
