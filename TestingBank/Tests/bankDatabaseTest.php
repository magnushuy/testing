<?php
    include_once '../Model/domeneModell.php';
    include_once '../DAL/bankDatabaseStub.php';
    include_once '../BLL/bankLogikk.php';
    class bankDatabaseTest extends PHPUnit\Framework\TestCase{
        function test_sjekkLoggInn_OK() {
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $kunde = new kunde();
        $kunde->personnummer = "21107698233";
        $kunde->passord = "Petter1212";
        $kunde->passordFeil = "Petter121200";
        //Act
        $OK = $bankLogikk->sjekkLoggInn($kunde->personnummer, $kunde->passord);
        $Feil = $bankLogikk->sjekkLoggInn($kunde->personnummer, $kunde->passordFeil);
        //Assert
        $this->assertEquals("OK", $OK);
        $this->assertEquals("Feil", $Feil);

    }
    
    //Funksjonen som gir godkjentmelding når man tester hentBetalinger
    function test_hentBetalinger_OK(){
        $Bank = new Bank(new BankDBStub());
        $konto = new konto;
        $konto->personnumer="12525232142";
        $personnummer=$konto->personnumer;
        $hentBetalinger = $Bank->hentBetalinger($personnummer);
        $this->assertEquals("20102012345-105010123456",$hentBetalinger[0]->fraTilKontonummer);
        $this->assertEquals("100.5",$hentBetalinger[0]->transaksjonBelop);
        $this->assertEquals("200", $hentBetalinger[0]->belop);
        $this->assertEquals("150315",$hentBetalinger[0]->dato);
        $this->assertEquals("1", $hentBetalinger[0]->avventer);
    }
    
    //Funksjonen som gir feilmelding når man tester hentBetalinger
    function test_hentBetalinger_Feil() {
        $Bank = new Bank(new BankDBStub());
        $konto = new konto;
        $konto->personnummer = "-1";
        $personnummer=$konto->personnummer;
        $hentBetalinger = $Bank->hentBetalinger($personnummer);
        $this->assertEquals(array(), $hentBetalinger);
    }

    function test_utforBetaling_OK(){
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $TxID = 1001;
        //Act
        $result = $bankLogikk->utforBetaling($TxID);
        //Assert
        $this->assertEquals("OK", $result);
    }
    
    function test_utforBetaling_Feil(){
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $TxID = 10011;
        //Act
        $result = $bankLogikk->utforBetaling($TxID);
        //Assert
        $this->assertEquals("Feil", $result);
    }
    
    
    function test_endreKundeInfo_OK(){
         //Arrange
        $adminLogikk = new Bank(new bankDBStub());
        $kunde = new kunde();
        $kunde->personnummer = "330943829993";
        $kunde->fornavn = "Kristian";
        $kunde->etternavn = "Karlsen";
        $kunde->adresse = "Kongsving 23";
        $kunde->postnr = "1812"; //Legger inn riktig postnr som i bankDatabaseStuben.
        $kunde->poststed = "Spydeberg"; //Legger inn riktig poststed som i bankDatabaseStuben.
        $kunde->telefonnr = "98762391";
        $kunde->passord = "KristianErOK";
        //Act
        $OK = $adminLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("OK", $OK);   
    }
    
    function test_endreKundeInfo_Feil(){
         //Arrange
        $adminLogikk = new Bank(new bankDBStub());
        $kunde = new kunde();
        $kunde->personnummer = "330943829993";
        $kunde->fornavn = "Kristian";
        $kunde->etternavn = "Karlsen";
        $kunde->adresse = "Kongsving 23";
        $kunde->postnr = "1834"; //Legger inn feil postnr som i bankDatabaseStuben.
        $kunde->poststed = "Spydeberg"; //Legger inn feil poststed som i bankDatabaseStuben.
        $kunde->telefonnr = "98762391";
        $kunde->passord = "KristianErOK";
        //Act
        $Feil = $adminLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("Feil", $Feil);   
    }   
    
    
}
