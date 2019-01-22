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
            //Act
            $OK = $bankLogikk->sjekkLoggInn($kunde->personnummer, $kunde->passord);
            //Assert
            $this->assertEquals("OK", $OK);
        }
        
        function test_sjekkLoggInn_Feil(){
            //Arrange
            $bankLogikk = new Bank(new BankDBStub());
            $kunde = new kunde();
            $kunde->personnummer = "211076982331";
            $kunde->passord = "Petter12121";
            //Act
            $Feil = $bankLogikk->sjekkLoggInn($kunde->personnummer, $kunde->passord);
            //Assert
            $this->assertEquals("Feil", $Feil);
        }
        
        function test_sjekkLoggInn_FeilPassord(){
            //Arrange
            $bankLogikk = new Bank(new BankDBStub());
            $kunde = new kunde();
            $kunde->personnummer = "21107698233";
            $kunde->passord = "P";
            //Act
            $FeilPass = $bankLogikk->sjekkLoggInn($kunde->personnummer, $kunde->passord);
            //Assert
            $this->assertEquals("Feil i passord", $FeilPass);
        }
        
        function test_sjekkLoggInn_FeilPersonNr(){
            //Arrange
            $bankLogikk = new Bank(new BankDBStub());
            $kunde = new kunde();
            $kunde->personnummer = "abcdefg";
            $kunde->passord = "Petter1212";
            //Act
            $FeilPersonNr = $bankLogikk->sjekkLoggInn($kunde->personnummer, $kunde->passord);
            //Assert
            $this->assertEquals("Feil i personnummer", $FeilPersonNr);
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
    
    function test_registrerBetaling_OK(){
        //Arrange
        $banklogikk = new Bank(new BankDBStub());
        $transaksjon = new transaksjon();
        $konto = new konto();
        $konto->kontonummer = 111;
        $transaksjon->fraTilKontonummer = 123;
        $transaksjon->belop = 500;
        $transaksjon->dato = "0101";
        $transaksjon->melding = "hei";
        //Act
        $result = $banklogikk->registrerBetaling($konto->kontonummer, $transaksjon);
        //Assert
        $this->assertEquals("OK", $result); //Forventer OK

    }
    
    function test_registrerBetaling_Feil(){
        //Arrange
        $banklogikk = new Bank(new BankDBStub());
        $transaksjon = new transaksjon();
        $konto = new konto();
        $konto->kontonummer = 1111;
        $transaksjon->fraTilKontonummer = 123;
        $transaksjon->belop = 50;
        $transaksjon->dato = "0101";
        $transaksjon->melding = "hei";
        //Act
        $result = $banklogikk->registrerBetaling($konto->kontonummer, $transaksjon);
        //Assert
        $this->assertEquals("Feil", $result); //Forventer OK

    }
    
    function test_endreKundeInfo_OK(){
         //Arrange
        $bankLogikk = new Bank(new bankDBStub());
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
        $OK = $bankLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("OK", $OK);   
    }
    
    function test_endreKundeInfo_Feil(){
         //Arrange
        $bankLogikk = new Bank(new bankDBStub());
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
        $Feil = $bankLogikk->endreKundeInfo($kunde);
        //Assert
        $this->assertEquals("Feil", $Feil);   
    }   
    
    function test_hentSaldi_OK(){
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $personnummer = 1234567890;
        
        //Act
        $result = $bankLogikk->hentSaldi($personnummer);
        
        //Assert
        $this->assertEquals("OK",$result);
    }
    
    function test_hentSaldi_Feil(){
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $personnummer = 12345678901;
        
        //Act
        $result = $bankLogikk->hentSaldi($personnummer);
        
        //Assert
        $this->assertEquals("Feil",$result);
    }
    
    function test_hentKonti_OK(){
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $personnummer = 1234567890;
        
        //Act
        $result = $bankLogikk->hentKonti($personnummer);
        
        //Assert
        $this->assertEquals("OK",$result);
    }
    
    function test_hentKonti_Feil(){
        //Arrange
        $bankLogikk = new Bank(new BankDBStub());
        $personnummer = 12345678901;
        
        //Act
        $result = $bankLogikk->hentKonti($personnummer);
        
        //Assert
        $this->assertEquals("Feil",$result);
    }
    
}
