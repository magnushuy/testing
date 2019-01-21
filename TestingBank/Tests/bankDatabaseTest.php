<?php
include_once '../Model/domeneModell.php';
include_once '../DAL/bankDatabaseStub.php';
include_once '../BLL/bankLogikk.php';

class bankDatabaseTest extends PHPunit\Framework\Testcase{
    function test_hentKonti(){
        $bankLogikk = new Bank(new BankDBStub());
        $personnummer = 111;
        $result = count($bankLogikk->hentKonti($personnummer));
        $this->assertEquals(2,$result);
    }
}