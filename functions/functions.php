<?php
    function dateFormater($dateIn){
        $year = substr($dateIn,0,4);
        $month = substr($dateIn,5,2);
        $day = substr($dateIn,8,2);

        $dateOut = $day."/".$month."/".$year;

        return $dateOut;
    }
    function cpfFormater($cpfIn){
        $cpf1 = substr($cpfIn,0,3);
        $cpf2 = substr($cpfIn,3,3);
        $cpf3 = substr($cpfIn,6,3);
        $cpf4 = substr($cpfIn,9,2);

        $cpfOut = $cpf1.".".$cpf2.".".$cpf3."-".$cpf4;

        return $cpfOut;
    }
    function phoneFormater($phoneIn){
        $ddd = "(".substr($phoneIn,0,2).") ";
        if(strlen($phoneIn)==11){
            $phone1 = substr($phoneIn,2,5);
            $phone2 = substr($phoneIn,7,4);
        }else{
            $phone1 = substr($phoneIn,2,4);
            $phone2 = substr($phoneIn,6,4);
        }
        $phoneOut = $ddd.$phone1."-".$phone2;
        
        return $phoneOut;
    }
    function cepFormater($cepIn){
        $cep1 = substr($cepIn,0,2);
        $cep2 = substr($cepIn,2,3);
        $cep3 = substr($cepIn,5,3);

        $cepOut = $cep1.".".$cep2."-".$cep3;

        return $cepOut;
    }
?>