<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */

final class Version20220120164951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_sous_categorie (categorie_id INT NOT NULL, sous_categorie_id INT NOT NULL, INDEX IDX_C47E5A14BCF5E72D (categorie_id), INDEX IDX_C47E5A14365BF48 (sous_categorie_id), PRIMARY KEY(categorie_id, sous_categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece_categorie (piece_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_79FC5BB2C40FCFA8 (piece_id), INDEX IDX_79FC5BB2BCF5E72D (categorie_id), PRIMARY KEY(piece_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, informations LONGTEXT DEFAULT NULL, marque VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie_produit (sous_categorie_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_B7039772365BF48 (sous_categorie_id), INDEX IDX_B7039772F347EFB (produit_id), PRIMARY KEY(sous_categorie_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_sous_categorie ADD CONSTRAINT FK_C47E5A14BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_sous_categorie ADD CONSTRAINT FK_C47E5A14365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_categorie ADD CONSTRAINT FK_79FC5BB2C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_categorie ADD CONSTRAINT FK_79FC5BB2BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_categorie_produit ADD CONSTRAINT FK_B7039772365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_categorie_produit ADD CONSTRAINT FK_B7039772F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_sous_categorie DROP FOREIGN KEY FK_C47E5A14BCF5E72D');
        $this->addSql('ALTER TABLE piece_categorie DROP FOREIGN KEY FK_79FC5BB2BCF5E72D');
        $this->addSql('ALTER TABLE piece_categorie DROP FOREIGN KEY FK_79FC5BB2C40FCFA8');
        $this->addSql('ALTER TABLE sous_categorie_produit DROP FOREIGN KEY FK_B7039772F347EFB');
        $this->addSql('ALTER TABLE categorie_sous_categorie DROP FOREIGN KEY FK_C47E5A14365BF48');
        $this->addSql('ALTER TABLE sous_categorie_produit DROP FOREIGN KEY FK_B7039772365BF48');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_sous_categorie');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE piece_categorie');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE sous_categorie_produit');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
