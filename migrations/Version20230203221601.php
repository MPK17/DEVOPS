<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203221601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, id_rubrique INT DEFAULT NULL, id_user INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(2000) NOT NULL, photo VARCHAR(255) NOT NULL, votes INT NOT NULL, date DATETIME DEFAULT  NOT NULL, INDEX fk_id_rubrique (id_rubrique), INDEX fk_id_user (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, description_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, num VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_dtm DATE NOT NULL, tel VARCHAR(8) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, id_blog INT DEFAULT NULL, id_user INT DEFAULT NULL, description VARCHAR(2000) NOT NULL, votes INT NOT NULL, date DATETIME DEFAULT  NOT NULL, id_parent_comment INT NOT NULL, INDEX fk_id_blog (id_blog), INDEX fkid_user (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conge (IdConge INT AUTO_INCREMENT NOT NULL, DebutConge DATE NOT NULL, FinConge DATE NOT NULL, typeconge VARCHAR(255) NOT NULL, IdEmploye INT DEFAULT NULL, INDEX IdEmploye (IdEmploye), PRIMARY KEY(IdConge)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (IdEmploye INT AUTO_INCREMENT NOT NULL, nomemploye VARCHAR(255) NOT NULL, dateemploye VARCHAR(255) NOT NULL, numemploye INT NOT NULL, salaireemploye INT NOT NULL, PRIMARY KEY(IdEmploye)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning (idPlanning INT AUTO_INCREMENT NOT NULL, nomPlanning VARCHAR(255) NOT NULL, descriptionPlanning TEXT NOT NULL, datePlanning DATE NOT NULL, lieuPlanning VARCHAR(255) NOT NULL, idProgramme INT DEFAULT NULL, INDEX fkPlanning (idProgramme), PRIMARY KEY(idPlanning)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, description_produit VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, stock INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_shop (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, qt INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_85F2314DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (idProgramme INT AUTO_INCREMENT NOT NULL, nomProgramme VARCHAR(255) NOT NULL, descriptionProgramme TEXT NOT NULL, niveauProgramme INT NOT NULL, genreProgramme INT NOT NULL, typeProgramme VARCHAR(255) NOT NULL, imageProgramme VARCHAR(255) NOT NULL, idUser INT DEFAULT NULL, INDEX fkprogramme (idUser), PRIMARY KEY(idProgramme)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclammation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrique (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143DF7FE5E9 FOREIGN KEY (id_rubrique) REFERENCES rubrique (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551436B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4B354D41 FOREIGN KEY (id_blog) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED893486A4C3AE8 FOREIGN KEY (IdEmploye) REFERENCES employe (IdEmploye)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6C13692A9 FOREIGN KEY (idProgramme) REFERENCES programme (idProgramme)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE produit_shop ADD CONSTRAINT FK_85F2314DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4B354D41');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit_shop DROP FOREIGN KEY FK_85F2314DBCF5E72D');
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED893486A4C3AE8');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6C13692A9');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143DF7FE5E9');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551436B3CA4B');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A6B3CA4B');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFFE6E88D7');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_shop');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE reclammation');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE user');
    }
}
