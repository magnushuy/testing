<?php
    include_once '../Model/domeneModell.php';
    class BankDBStub
    {
        function hentEnKunde($personnummer)
        {
           $enKunde = new kunde();
           $enKunde->personnummer =$personnummer;
           $enKunde->navn = "Per Olsen";
           $enKunde->adresse = "Osloveien 82, 0270 Oslo";
           $enKunde->telefonnr="12345678";
           return $enKunde;
        }
        function hentAlleKunder()
        {
           $alleKunder = array();
           $kunde1 = new kunde();
           $kunde1->personnummer ="01010122344";
           $kunde1->navn = "Per Olsen";
           $kunde1->adresse = "Osloveien 82 0270 Oslo";
           $kunde1->telefonnr="12345678";
           $alleKunder[]=$kunde1;
           $kunde2 = new kunde();
           $kunde2->personnummer ="01010122344";
           $kunde2->navn = "Line Jensen";
           $kunde2->adresse = "Askerveien 100, 1379 Asker";
           $kunde2->telefonnr="92876789";
           $alleKunder[]=$kunde2;
           $kunde3 = new kunde();
           $kunde3->personnummer ="02020233455";
           $kunde3->navn = "Ole Olsen";
           $kunde3->adresse = "Bærumsveien 23, 1234 Bærum";
           $kunde3->telefonnr="99889988";
           $alleKunder[]=$kunde3;
           return $alleKunder;
        }
        function hentTransaksjoner($kontoNr,$fraDato,$tilDato)
        {
            date_default_timezone_set("Europe/Oslo");
            $fraDato = strtotime($fraDato);
            $tilDato = strtotime($tilDato);
            if($fraDato>$tilDato)
            {
                return "Fra dato må være større enn tildato";
            }
            $konto = new konto();
            $konto->personnummer="010101234567";
            $konto->kontonummer=$kontoNr;
            $konto->type="Sparekonto";
            $konto->saldo =2300.34;
            $konto->valuta="NOK";
            if($tilDato < strtotime('2015-03-26'))
            {
                return $konto;
            }
            $dato = $fraDato;
            while ($dato<=$tilDato)
            {
                switch($dato)
                {
                    case strtotime('2015-03-26') :
                        $transaksjon1 = new transaksjon();
                        $transaksjon1->dato='2015-03-26';
                        $transaksjon1->transaksjonBelop=134.4;
                        $transaksjon1->fraTilKontonummer="22342344556";
                        $transaksjon1->melding="Meny Holtet";
                        $konto->transaksjoner[]=$transaksjon1;
                        break;
                    case strtotime('2015-03-27') :
                        $transaksjon2 = new transaksjon();
                        $transaksjon2->dato='2015-03-27';
                        $transaksjon2->transaksjonBelop=-2056.45;
                        $transaksjon2->fraTilKontonummer="114342344556";
                        $transaksjon2->melding="Husleie";
                        $konto->transaksjoner[]=$transaksjon2; 
                        break;
                    case strtotime('2015-03-29') :
                        $transaksjon3 = new transaksjon();
                        $transaksjon3->dato = '2015-03-29';
                        $transaksjon3->transaksjonBelop=1454.45;
                        $transaksjon3->fraTilKontonummer="114342344511";
                        $transaksjon3->melding="Lekeland";
                        $konto->transaksjoner[]=$transaksjon3;
                        break;
                }
                $dato +=(60*60*24); // en dag i tillegg i sekunder
            }
            return $konto;
        } 
        
        function hentKonti($personnummer){
            $konti = new konto();
            $konti->personnummer = 1234567890;
            $konti->saldo = 100;
            if($personnummer == $konti->personnummer){
                return $konti;
            }
            else{
                return null;
            }
        }

        
        function hentSaldi($personnummer) {
            $konto = new konto();
            $konto->personnummer = 1234567890;
            $konto->saldo = 500;
            if($personnummer == $konto->personnummer){
                return $konto->saldo;
            }
            else{
                return null;
            }
        }    


        //Funksjonen sjekker om personnumemer og passord stemmer              
        function sjekkLoggInn($personnumer, $passord){
            if($personnumer == "21107698233" && $passord == "Petter1212"){
                return "OK";
            }
            else {
                return "Feil";
            }
        }

    
        

        
        function registrerBetaling($kontoNr, $transaksjon){
            if($transaksjon->fraTilKontonummer == 123 &&
                    $transaksjon->belop == 500 &&
                    $transaksjon->dato == "0101" &&
                    $transaksjon->melding == "hei"){
                return "OK";
            }
            else return "Feil";
        }
        
        function hentBetalinger($personnummer) {
            $betalinger = array();
            if ($personnummer ==-1){
                return $betalinger;
            }
            else {
                $betaling1 = new transaksjon();
                $betaling1->fraTilKontonummer="20102012345-105010123456";
                $betaling1->transaksjonBelop="100.5";
                $betaling1->belop="200";
                $betaling1->dato="150315";
                $betaling1->melding="Meny Storo";
                $betaling1->avventer="1";
                $betalinger[]=$betaling1;
                
                return $betalinger;               
            }
        }

        function utforBetaling($TxID){
            $transaksjon = new transaksjon();
            if($TxID == 1001){
                return "OK";
            }
            return "Feil";
        }
        
        
        //Funksjon som sjekker om endre kunde informasjon
        function endreKundeInfo($kunde){
            if($kunde->postnr =="1812" && $kunde->poststed == "Spydeberg"){
            return "OK";
        }
         return "Feil";
            
        }
        
       
        
        function hentKundeInfo($personnummer){
            $kunde = new kunde();
            $kunde->personnummer = 21097635882;
            $kunde->fornavn = "Petter";
            $kunde->etternavn = "Hansen";
            $kunde->adresse = "Torgveien 19";
            $kunde->postnr = "0580";
            $kunde->telefonnr = "47651298";
            if($personnummer != $kunde->personnummer){
                return "Feil";
            }
            else return $kunde;
        }

    }
    
    
?>

        
        
    
    
    


