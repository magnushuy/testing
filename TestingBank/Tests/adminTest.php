<?php
include_once '../Model/domeneModell.php';
include_once '../DAL/adminDatabaseStub.php';
include_once '../BLL/adminLogikk.php';

class adminTest extends PHPUnit\Framework\TestCase{
    
    //Funksjon som tester alle kundene som er registrert.
    function test_hentAlleKunder(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        //Act
        $kunde = $adminLogikk->hentAlleKunder();
        
        //Tester første kunden
        //Assert
        $this->assertEquals("21107698233", $kunde[0]->personnummer);
        $this->assertEquals("Petter", $kunde[0]->fornavn);
        $this->assertEquals("Hansen", $kunde[0]->etternavn);
        $this->assertEquals("Torgveien 19", $kunde[0]->adresse);
        $this->assertEquals("0580", $kunde[0]->postnr);
        $this->assertEquals("Asker", $kunde[0]->poststed);
        $this->assertEquals("47651298", $kunde[0]->telefonnr);
        $this->assertEquals("Petter1212", $kunde[0]->passord);
        //Tester andre kunden
        $this->assertEquals("31099212872", $kunde[1]->personnummer);
        $this->assertEquals("Lisa", $kunde[1]->fornavn);
        $this->assertEquals("Solberg", $kunde[1]->etternavn);
        $this->assertEquals("Solsikker 2A", $kunde[1]->adresse);
        $this->assertEquals("1806", $kunde[1]->postnr);
        $this->assertEquals("Hobøl", $kunde[1]->poststed);
        $this->assertEquals("90082173", $kunde[1]->telefonnr);
        $this->assertEquals("ketchupertomat", $kunde[1]->passord);
        //Tester tredje kunden
        $this->assertEquals("1201545678", $kunde[2]->personnummer);
        $this->assertEquals("Thomas", $kunde[2]->fornavn);
        $this->assertEquals("Skogstad", $kunde[2]->etternavn);
        $this->assertEquals("Buesvingen 32", $kunde[2]->adresse);
        $this->assertEquals("0143", $kunde[2]->postnr);
        $this->assertEquals("Drammen", $kunde[2]->poststed);
        $this->assertEquals("45238719", $kunde[2]->telefonnr);
        $this->assertEquals("densterkethomas", $kunde[2]->passord);
        
    }
    
    //Funksjon som gir godkjentmelding når man tester om å endre kunde informasjon.
    function test_endreKontoInfo_OK(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $kunde = new kunde();
        $kunde->personnummer = "21107698233";
        $kunde->fornavn = "Petter";
        $kunde->etternavn = "Hansen";
        $kunde->adresse = "Torgveien 19";
        $kunde->postnr = "0580"; //Legger inn riktig postnr som i adminDatabaseStuben.
        $kunde->poststed = "Asker"; //Legger inn riktig poststed som i adminDatabaseStuben.
        $kunde->telefonnr = "47651298";
        $kunde->passord = "Petter1212";
        //Act
        $OK = $adminLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("OK", $OK);   
    }
    
    
    //Funksjon som gir feilmelding når man tester om å endre kunde informasjon. 
    function test_endreKontoInfo_Feil(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $kunde = new kunde();
        $kunde->personnummer = "21107698233";
        $kunde->fornavn = "Petter";
        $kunde->etternavn = "Hansen";
        $kunde->adresse = "Torgveien 19";
        $kunde->postnr = "0927";  //Legger inn annet postnr enn det i adminDatabaseStub
        $kunde->poststed = "Trondheim"; //Legger inn annet poststed enn det i adminDatabaseStub
        $kunde->telefonnr = "47651298";
        $kunde->passord = "Petter1212";
        //Act
        $Feil = $adminLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("Feil", $Feil);
    }
    
    
    
}


?>