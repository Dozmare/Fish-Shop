<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120113854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F252D75F');
        $this->addSql('DROP INDEX IDX_29A5EC27F252D75F ON produit');
        $this->addSql('ALTER TABLE produit CHANGE id_sous_categorie_id sous_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27365BF48 ON produit (sous_categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27365BF48');
        $this->addSql('DROP INDEX IDX_29A5EC27365BF48 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE sous_categorie_id id_sous_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F252D75F FOREIGN KEY (id_sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27F252D75F ON produit (id_sous_categorie_id)');
    }
}
