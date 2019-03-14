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
    function test_endreKundeInfo_OK(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $kunde = new kunde();
        $kunde->personnummer = "21107698233";
        $kunde->fornavn = "Petter";
        $kunde->etternavn = "Hansen";
        $kunde->adresse = "Torgveien 19";
        $kunde->postnr = 1; //Legger inn riktig postnr som i adminDatabaseStuben.
        $kunde->poststed = "Asker"; 
        $kunde->telefonnr = "47651298";
        $kunde->passord = "Petter1212";
        //Act
        $OK = $adminLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("OK", $OK);   
    }
    
    
    //Funksjon som gir feilmelding når man tester om å endre kunde informasjon. 
    function test_endreKundeInfo_Feil(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $kunde = new kunde();
        $kunde->personnummer = "21107698233";
        $kunde->fornavn = "Petter";
        $kunde->etternavn = "Hansen";
        $kunde->adresse = "Torgveien 19";
        $kunde->postnr = -1;  //Legger inn annet postnr enn det i adminDatabaseStub
        $kunde->poststed = "Trondheim"; 
        $kunde->telefonnr = "47651298";
        $kunde->passord = "Petter1212";
        //Act
        $Feil = $adminLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("Feil", $Feil);
    }
    
    
    

    function test_slettKunde_OK() {
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $personnummer = 1;
        //Act
        $result = $adminLogikk->slettKunde($personnummer);
        //Assert
        $this->assertEquals("OK",$result);
               
    }
    
    function test_slettKunde_Feil() {
        //Forandrer verdier slik at testen blir feil
        $adminLogikk = new Admin(new adminDatabaseStub());
        $personnummer = -1;
        //Act
        $result = $adminLogikk->slettKunde($personnummer);
        //Assert
        $this->assertEquals("Feil",$result);
    }
    


    //Funksjon som gir godkjentmelding når man tester om å registrere kunde informasjon.
    function test_registrerKunde_OK(){
        //arrange 
        $adminLogikk = new Admin(new adminDatabaseStub());
        $kunde = new kunde();
        
        $kunde-> personnummer = 1;
        $kunde->fornavn = "Petter";
        $kunde->etternavn = "Hansen";
        $kunde->adresse = "Torgveien 19";
        $kunde->postnr = "0927";  //Legger inn annet postnr enn det i adminDatabaseStub
        $kunde->poststed = "Trondheim"; //Legger inn annet poststed enn det i adminDatabaseStub
        $kunde->telefonnr = "47651298";
        $kunde->passord = "Petter1212";
        // act
        $result = $adminLogikk->registrerKunde($kunde);
        // assert
        $this->assertEquals("OK",$result); 
    }
    
    //Funksjon som gir feilmelding når man tester om å registrere kunde informasjon.
    function test_registrerKunde_Feil(){
        //arrange 
        $adminLogikk = new Admin(new adminDatabaseStub());
        $kunde = new kunde();
        
        //Forandrer verdier slik at testen blir feil
        $kunde->personnummer = -1;
        $kunde->fornavn = "Petter";
        $kunde->etternavn = "Hansen";
        $kunde->adresse = "Torgveien 19";
        $kunde->postnr = "0927";  //Legger inn annet postnr enn det i adminDatabaseStub
        $kunde->poststed = "Trondheim"; //Legger inn annet poststed enn det i adminDatabaseStub
        $kunde->telefonnr = "47651298";
        $kunde->passord = "Petter1212";
        // act
        $result= $adminLogikk->registrerKunde($kunde);
        // assert
        $this->assertEquals("Feil",$result); 
    }

    //Funksjon som gir godkjentmelding når man tester om å registrere konto.
    function test_registrerKonto_OK(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
        $konto->kontonummer = 1;
        $konto->personnummer = "12345678901";
        $konto->saldo = "10";
        $konto->type = "Lønnskonto";
        $konto->valuta = "NOK";
        //Act
        $result = $adminLogikk->registrerKonto($konto);
        //Assert



        $this->assertEquals("OK", $result);           
    }

    //Funksjon som gir feilmelding når man tester om å registrere konto.    
    function test_registrerKonto_Feil() {

        //Forandrer verdier slik at testen blir feil
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
        $konto->kontonummer = -1;
        $konto->personnummer = "12345678901";
        $konto->saldo = "10";
        $konto->type = "Lønnskonto";
        $konto->valuta = "NOK";
        //Act
        $result = $adminLogikk->registrerKonto($konto);
        //Assert
        $this->assertEquals("Feil", $result);
    }
    

    //Funksjon som gir godkjentmelding når man tester om å endrer konto.    
    function test_endreKonto_OK(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
        $konto->kontonummer = 12345;
        $konto->personnummer = 54321;
        $konto->saldo = 100000;
        $konto->type = "Sparekonto";
        $konto->valuta = "NOK";
        //Act
        $Ok = $adminLogikk->endreKonto($konto);
        //Assert
        $this->assertEquals("OK", $Ok);
       
    }
    
     //Funksjon som gir feilmelding når man tester om å endrer konto.    
    function test_endreKonto_FeilPersonnummer(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
       
        $konto->kontonummer = 12345;
        $konto->personnummer = 54320;
        $konto->saldo = 100000;
        $konto->type = "Sparekonto";
        $konto->valuta = "NOK";
        //Act
        $Feil = $adminLogikk->endreKonto($konto);
        //Assert
        $this->assertEquals("Feil personnummer", $Feil);
    }
    
    function test_endreKonto_FeilKontonummer(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
       
        $konto->kontonummer = 12340;
        $konto->personnummer = 54321;
        $konto->saldo = 100000;
        $konto->type = "Sparekonto";
        $konto->valuta = "NOK";
        //Act
        $Feil = $adminLogikk->endreKonto($konto);
        //Assert
        $this->assertEquals("Feil kontonummer", $Feil);
    }
    
    //Funksjon som gir godkjentmelding når man tester om å slette konto.
    function test_slettKonto_OK(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
        $konto->kontonummer = 41231;
        //Act
        $result = $adminLogikk->slettKonto($konto->kontonummer);
        //Assert
        $this->assertEquals("OK", $result);       
    }

    //Funksjon som gir feilmelding når man tester om å slette konto.
    function test_slettKonto_Feil() {
        //Forandrer verdier slik at testen blir feil
        $adminLogikk = new Admin(new adminDatabaseStub());
        $konto = new konto();
        $konto->kontonummer = -1;
        //Act
        $result = $adminLogikk->slettKonto($konto->kontonummer);
        //Assert
        $this->assertEquals("Feil kontonummer", $result);
    }


    //Funksjon som tester om alle kontoene.
    function test_hentAlleKonti(){
        //Arrange
        $adminLogikk = new Admin(new adminDatabaseStub);
        //Act
        $konto = $adminLogikk->hentAlleKonti();
        
        //Assert
        //Tester første konto fra kunden.
        $this->assertEquals("123456789012",$konto[0]->kontonummer);
        $this->assertEquals("12345678901",$konto[0]->personnummer);
        $this->assertEquals("10",$konto[0]->saldo);
        $this->assertEquals("Lønnskonto",$konto[0]->type);
        $this->assertEquals("NOK",$konto[0]->valuta);
        //Tester andre konto fra kunden.
        $this->assertEquals("12987654321",$konto[1]->kontonummer);
        $this->assertEquals("31987654321",$konto[1]->personnummer);
        $this->assertEquals("1000",$konto[1]->saldo);
        $this->assertEquals("Sparekonto",$konto[1]->type);
        $this->assertEquals("NOK",$konto[1]->valuta);
        //Tester tredje konto fra kunden.
        $this->assertEquals("22987654321",$konto[2]->kontonummer);
        $this->assertEquals("11987654321",$konto[2]->personnummer);
        $this->assertEquals("100000",$konto[2]->saldo);
        $this->assertEquals("Sparekonto",$konto[2]->type);
        $this->assertEquals("NOK",$konto[2]->valuta);     
    }
  
}
