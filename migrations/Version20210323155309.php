<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323155309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, themes_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, nb_places_maxi INT NOT NULL, INDEX IDX_E1BB182394F4A9D2 (themes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_chambre (id INT AUTO_INCREMENT NOT NULL, tarifs_id INT NOT NULL, libelle_categorie VARCHAR(255) NOT NULL, INDEX IDX_9A8A4A5DF5F3287F (tarifs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, licencies_id INT NOT NULL, nom VARCHAR(255) NOT NULL, adresse1 VARCHAR(255) NOT NULL, adresse2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, INDEX IDX_B8EE3872B0AC65CD (licencies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, num_licence VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF65260D8A9FCA1 (num_licence), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, tarifs_id INT NOT NULL, code_hotel VARCHAR(255) NOT NULL, nom_hotel VARCHAR(255) NOT NULL, adresse_hotel1 VARCHAR(255) NOT NULL, adresse_hotel2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, INDEX IDX_3535ED9F5F3287F (tarifs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, nuites_id INT DEFAULT NULL, date_inscription DATETIME NOT NULL, INDEX IDX_5E90F6D6A9DD7CE0 (nuites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licencie (id INT AUTO_INCREMENT NOT NULL, qualite_id INT NOT NULL, club_id INT NOT NULL, num_licence VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse_licencie1 VARCHAR(255) NOT NULL, adresse_licencie2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, date_inscrit DATETIME NOT NULL, date_enregistrement VARCHAR(255) DEFAULT NULL, cle_wifi VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3B755612A6338570 (qualite_id), UNIQUE INDEX UNIQ_3B75561261190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nuite (id INT AUTO_INCREMENT NOT NULL, date_nuite DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposer (id INT AUTO_INCREMENT NOT NULL, tarif_nuite NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualite (id INT AUTO_INCREMENT NOT NULL, licencies_id INT NOT NULL, libelle_qualite VARCHAR(255) NOT NULL, INDEX IDX_68B3575FB0AC65CD (licencies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, ateliers_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_9775E708B1409BC9 (ateliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation (id INT AUTO_INCREMENT NOT NULL, date_heure_debut DATETIME NOT NULL, date_heure_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182394F4A9D2 FOREIGN KEY (themes_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE categorie_chambre ADD CONSTRAINT FK_9A8A4A5DF5F3287F FOREIGN KEY (tarifs_id) REFERENCES proposer (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872B0AC65CD FOREIGN KEY (licencies_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9F5F3287F FOREIGN KEY (tarifs_id) REFERENCES proposer (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A9DD7CE0 FOREIGN KEY (nuites_id) REFERENCES nuite (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612A6338570 FOREIGN KEY (qualite_id) REFERENCES qualite (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B75561261190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE qualite ADD CONSTRAINT FK_68B3575FB0AC65CD FOREIGN KEY (licencies_id) REFERENCES licencie (id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708B1409BC9 FOREIGN KEY (ateliers_id) REFERENCES atelier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708B1409BC9');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B75561261190A32');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872B0AC65CD');
        $this->addSql('ALTER TABLE qualite DROP FOREIGN KEY FK_68B3575FB0AC65CD');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A9DD7CE0');
        $this->addSql('ALTER TABLE categorie_chambre DROP FOREIGN KEY FK_9A8A4A5DF5F3287F');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9F5F3287F');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612A6338570');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182394F4A9D2');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE categorie_chambre');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE nuite');
        $this->addSql('DROP TABLE proposer');
        $this->addSql('DROP TABLE qualite');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE vacation');
    }
}
