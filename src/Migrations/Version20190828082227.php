<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190828082227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commandes ADD membre_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C6A99F74A FOREIGN KEY (membre_id) REFERENCES membres (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C6A99F74A ON commandes (membre_id)');
        $this->addSql('ALTER TABLE produits_commandes ADD produit_id INT NOT NULL, ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits_commandes ADD CONSTRAINT FK_5DF6AD2CF347EFB FOREIGN KEY (produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE produits_commandes ADD CONSTRAINT FK_5DF6AD2C82EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_5DF6AD2CF347EFB ON produits_commandes (produit_id)');
        $this->addSql('CREATE INDEX IDX_5DF6AD2C82EA2E54 ON produits_commandes (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C6A99F74A');
        $this->addSql('DROP INDEX IDX_35D4282C6A99F74A ON commandes');
        $this->addSql('ALTER TABLE commandes DROP membre_id');
        $this->addSql('ALTER TABLE produits_commandes DROP FOREIGN KEY FK_5DF6AD2CF347EFB');
        $this->addSql('ALTER TABLE produits_commandes DROP FOREIGN KEY FK_5DF6AD2C82EA2E54');
        $this->addSql('DROP INDEX IDX_5DF6AD2CF347EFB ON produits_commandes');
        $this->addSql('DROP INDEX IDX_5DF6AD2C82EA2E54 ON produits_commandes');
        $this->addSql('ALTER TABLE produits_commandes DROP produit_id, DROP commande_id');
    }
}
