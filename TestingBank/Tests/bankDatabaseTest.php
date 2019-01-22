<?php
include_once '../Model/domeneModell.php';
include_once '../DAL/bankDatabaseStub.php';
include_once '../BLL/bankLogikk.php';

class bankDatabaseTest extends PHPunit\Framework\Testcase{
    function test_hentKonti(){
        $bankLogikk = new Bank(new BankDBStub());
        $personnummer = 111;
        $result = $bankLogikk->hentKonti($personnummer);
        $this->assertEquals(2,count($result)); //Tester antall kontoer returnert
        $this->assertEquals(13131313,$result[0]);
        $this->assertEquals(14141414,$result[1]);
    }   
    
    function test_registrerBetaling(){
        $bankLogikk = new Bank(new BankDBStub());
        $transaksjon = new transaksjon();
        $kontoNr = new konto();
        $transaksjon->fraTilKontonummer = 123;
        $transaksjon->belop = 500;
        $transaksjon->dato = "0101";
        $transaksjon->melding = "hei";
        $result = $bankLogikk->registrerBetaling($kontoNr, $transaksjon);
        
        $this->assertEquals("OK", $result); //Forventer OK
        
        $transaksjon->belop = 501; //Forandrer på verdi for å få feil i test
        $result = $bankLogikk->registrerBetaling($kontoNr, $transaksjon);
        $this->assertEquals("Feil", $result); //Forventer OK
        
        
    }
}