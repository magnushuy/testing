<?php

function hentAlleKunder(){
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

function endreKundeInfo($kunde){
    if($kunde->postnr == 1476 or $kunde->poststed == "Rasta"){
    return "OK";
    }
    else return "FEIL";
}

function 