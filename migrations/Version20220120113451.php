<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120113451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7B9F34925F');
        $this->addSql('DROP INDEX IDX_52743D7B9F34925F ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie CHANGE id_categorie_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_52743D7BBCF5E72D ON sous_categorie (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('DROP INDEX IDX_52743D7BBCF5E72D ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie CHANGE categorie_id id_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7B9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_52743D7B9F34925F ON sous_categorie (id_categorie_id)');
    }
}
