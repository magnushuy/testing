<?php
    include_once '../Model/domeneModell.php';
    
    
 class adminDatabaseStub{
     
    //Funksjonen henter kunder
    function hentAlleKunder(){
        $alleKunder = array();
        $kunde1 = new kunde();
        //Henter første kunden
        $kunde1->personnummer = "21107698233";
        $kunde1->fornavn = "Petter";
        $kunde1->etternavn = "Hansen";
        $kunde1->adresse = "Torgveien 19";
        $kunde1->postnr = "0580";
        $kunde1->poststed = "Asker";
        $kunde1->telefonnr = "47651298";
        $kunde1->passord = "Petter1212";
        $alleKunder[] = $kunde1;
        //Henter andre kunden
        $kunde2 = new kunde();
        $kunde2->personnummer = "31099212872";
        $kunde2->fornavn = "Lisa";
        $kunde2->etternavn = "Solberg";
        $kunde2->adresse = "Solsikker 2A";
        $kunde2->postnr = "1806";
        $kunde2->poststed = "Hobøl";
        $kunde2->telefonnr = "90082173";
        $kunde2->passord = "ketchupertomat";
        $alleKunder[] = $kunde2;
        //Henter tredje kunden
        $kunde3 = new kunde();
        $kunde3->personnummer = "1201545678";
        $kunde3->fornavn = "Thomas";
        $kunde3->etternavn = "Skogstad";
        $kunde3->adresse = "Buesvingen 32";
        $kunde3->postnr = "0143";
        $kunde3->poststed = "Drammen";
        $kunde3->telefonnr = "45238719";
        $kunde3->passord = "densterkethomas";
        $alleKunder[] = $kunde3;
        
        return $alleKunder;
    } 
     
    //Funksjon som endrer informasjoner til kundene.
    function endreKundeInfo($kunde){
        if($kunde->postnr =="1" && $kunde->poststed == "1"){
            return "OK";
        }
         return "Feil";
    }
    
    
    //Funksjon som sjekker registrering av kunde
    function registrerKunde($kunde){
        if($kunde->personnummer == -1){
            return "Feil";
        }
        return "OK";
    }
    
    
    //Funksjon som sjekker om kunden er slettet.
    function slettKunde($personnummer){
        if($kunde->personnummer == -1){
            return "Feil";
        }
        return "OK";
    }
    
     
       
 }   
    

?>