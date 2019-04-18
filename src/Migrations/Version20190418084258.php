<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418084258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE planes_cargo (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, diaInicial1 INT NOT NULL, diaFinal1 INT NOT NULL, diaCargo1 INT NOT NULL, incrementoMes1 INT NOT NULL, diaInicial2 INT DEFAULT NULL, diaFinal2 INT DEFAULT NULL, diaCargo2 INT DEFAULT NULL, incrementoMes2 INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE meses (id INT AUTO_INCREMENT NOT NULL, mes VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_2C492ABD6EC83E05 (mes), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE clases (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE subclases (id INT AUTO_INCREMENT NOT NULL, clase_id INT DEFAULT NULL, cuenta_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_1B737359F720353 (clase_id), INDEX IDX_1B737359AEFF118 (cuenta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE versiones (id INT AUTO_INCREMENT NOT NULL, Descripcion VARCHAR(24) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE anyos (id INT AUTO_INCREMENT NOT NULL, anyo VARCHAR(4) NOT NULL, anyoCorto VARCHAR(2) NOT NULL, abierto TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C9C02DE1C3671726 (anyo), UNIQUE INDEX UNIQ_C9C02DE1551FA27E (anyoCorto), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE importaciones (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, numero_registros INT DEFAULT NULL, fecha_carga DATE NOT NULL, UNIQUE INDEX UNIQ_DF671367A02A2F00 (descripcion), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE presupuestos (id INT AUTO_INCREMENT NOT NULL, mes INT DEFAULT NULL, subclase_id INT DEFAULT NULL, anyo VARCHAR(4) NOT NULL, importe DOUBLE PRECISION NOT NULL, unico TINYINT(1) NOT NULL, INDEX IDX_4CF2F0D6EC83E05 (mes), INDEX IDX_4CF2F0D94E2BEDA (subclase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE anotaciones (id INT AUTO_INCREMENT NOT NULL, clase INT DEFAULT NULL, subclase INT DEFAULT NULL, agrupacion INT DEFAULT NULL, version INT NOT NULL, cuenta INT NOT NULL, importacion INT DEFAULT NULL, concepto VARCHAR(255) NOT NULL, concepto_banco VARCHAR(255) DEFAULT NULL, importe DOUBLE PRECISION NOT NULL, saldo_bancario DOUBLE PRECISION DEFAULT NULL, fecha_gasto DATE NOT NULL, fecha_cargo DATE NOT NULL, borrado TINYINT(1) NOT NULL, formaPago INT DEFAULT NULL, INDEX IDX_593A8C4A199FACCE (clase), INDEX IDX_593A8C4A632C4314 (subclase), INDEX IDX_593A8C4A3C02427D (agrupacion), INDEX IDX_593A8C4ABF1CD3C3 (version), INDEX IDX_593A8C4ADEDDF2F0 (formaPago), INDEX IDX_593A8C4A31C7BFCF (cuenta), INDEX IDX_593A8C4AF483A40E (importacion), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE tipos_forma_pago (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE formas_pago (id INT AUTO_INCREMENT NOT NULL, tipo_id INT DEFAULT NULL, cuenta_id INT DEFAULT NULL, plancargo_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_A91E0C55A9276E6C (tipo_id), INDEX IDX_A91E0C559AEFF118 (cuenta_id), INDEX IDX_A91E0C554BCD6AF5 (plancargo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE agrupaciones (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, fecha_desde DATE DEFAULT NULL, fecha_hasta DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, usuario VARCHAR(30) NOT NULL, password VARCHAR(100) NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, role VARCHAR(30) NOT NULL, email VARCHAR(255) DEFAULT NULL, activo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE cuentas (id INT AUTO_INCREMENT NOT NULL, Descripcion VARCHAR(24) NOT NULL, iban VARCHAR(80) NOT NULL, cuenta_ahorro TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('CREATE TABLE esquemas_importacion (id INT AUTO_INCREMENT NOT NULL, cuenta_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, lineasCabecera INT NOT NULL, separadorCampos VARCHAR(255) NOT NULL, puntoDecimal VARCHAR(255) NOT NULL, separadorMiles VARCHAR(255) NOT NULL, formatoFecha VARCHAR(255) NOT NULL, inversionSigno TINYINT(1) NOT NULL, Campo1 VARCHAR(255) DEFAULT NULL, Campo2 VARCHAR(255) DEFAULT NULL, Campo3 VARCHAR(255) DEFAULT NULL, Campo4 VARCHAR(255) DEFAULT NULL, Campo5 VARCHAR(255) DEFAULT NULL, Campo6 VARCHAR(255) DEFAULT NULL, Campo7 VARCHAR(255) DEFAULT NULL, Campo8 VARCHAR(255) DEFAULT NULL, Campo9 VARCHAR(255) DEFAULT NULL, Campo10 VARCHAR(255) DEFAULT NULL, INDEX IDX_5CCC55B29AEFF118 (cuenta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM');
        $this->addSql('ALTER TABLE subclases ADD CONSTRAINT FK_1B737359F720353 FOREIGN KEY (clase_id) REFERENCES clases (id)');
        $this->addSql('ALTER TABLE subclases ADD CONSTRAINT FK_1B737359AEFF118 FOREIGN KEY (cuenta_id) REFERENCES cuentas (id)');
        $this->addSql('ALTER TABLE presupuestos ADD CONSTRAINT FK_4CF2F0D6EC83E05 FOREIGN KEY (mes) REFERENCES meses (id)');
        $this->addSql('ALTER TABLE presupuestos ADD CONSTRAINT FK_4CF2F0D94E2BEDA FOREIGN KEY (subclase_id) REFERENCES subclases (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4A199FACCE FOREIGN KEY (clase) REFERENCES clases (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4A632C4314 FOREIGN KEY (subclase) REFERENCES subclases (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4A3C02427D FOREIGN KEY (agrupacion) REFERENCES agrupaciones (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4ABF1CD3C3 FOREIGN KEY (version) REFERENCES versiones (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4ADEDDF2F0 FOREIGN KEY (formaPago) REFERENCES formas_pago (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4A31C7BFCF FOREIGN KEY (cuenta) REFERENCES cuentas (id)');
        $this->addSql('ALTER TABLE anotaciones ADD CONSTRAINT FK_593A8C4AF483A40E FOREIGN KEY (importacion) REFERENCES importaciones (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formas_pago ADD CONSTRAINT FK_A91E0C55A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipos_forma_pago (id)');
        $this->addSql('ALTER TABLE formas_pago ADD CONSTRAINT FK_A91E0C559AEFF118 FOREIGN KEY (cuenta_id) REFERENCES cuentas (id)');
        $this->addSql('ALTER TABLE formas_pago ADD CONSTRAINT FK_A91E0C554BCD6AF5 FOREIGN KEY (plancargo_id) REFERENCES planes_cargo (id)');
        $this->addSql('ALTER TABLE esquemas_importacion ADD CONSTRAINT FK_5CCC55B29AEFF118 FOREIGN KEY (cuenta_id) REFERENCES cuentas (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE formas_pago DROP FOREIGN KEY FK_A91E0C554BCD6AF5');
        $this->addSql('ALTER TABLE presupuestos DROP FOREIGN KEY FK_4CF2F0D6EC83E05');
        $this->addSql('ALTER TABLE subclases DROP FOREIGN KEY FK_1B737359F720353');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4A199FACCE');
        $this->addSql('ALTER TABLE presupuestos DROP FOREIGN KEY FK_4CF2F0D94E2BEDA');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4A632C4314');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4ABF1CD3C3');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4AF483A40E');
        $this->addSql('ALTER TABLE formas_pago DROP FOREIGN KEY FK_A91E0C55A9276E6C');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4ADEDDF2F0');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4A3C02427D');
        $this->addSql('ALTER TABLE subclases DROP FOREIGN KEY FK_1B737359AEFF118');
        $this->addSql('ALTER TABLE anotaciones DROP FOREIGN KEY FK_593A8C4A31C7BFCF');
        $this->addSql('ALTER TABLE formas_pago DROP FOREIGN KEY FK_A91E0C559AEFF118');
        $this->addSql('ALTER TABLE esquemas_importacion DROP FOREIGN KEY FK_5CCC55B29AEFF118');
        $this->addSql('DROP TABLE planes_cargo');
        $this->addSql('DROP TABLE meses');
        $this->addSql('DROP TABLE clases');
        $this->addSql('DROP TABLE subclases');
        $this->addSql('DROP TABLE versiones');
        $this->addSql('DROP TABLE anyos');
        $this->addSql('DROP TABLE importaciones');
        $this->addSql('DROP TABLE presupuestos');
        $this->addSql('DROP TABLE anotaciones');
        $this->addSql('DROP TABLE tipos_forma_pago');
        $this->addSql('DROP TABLE formas_pago');
        $this->addSql('DROP TABLE agrupaciones');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE cuentas');
        $this->addSql('DROP TABLE esquemas_importacion');
    }
}
