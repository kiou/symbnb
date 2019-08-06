<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class FrenchToDateTimeTransformer implements DataTransformerInterface{

    /**
     * retour de la base de donnée au champs
     *
     * @param [type] $date
     * @return void
     */
    public function transform($date)
    {
        if($date === null){
            return '';
        }
        
        return $date->format('d/m/Y');
    }

    /**
     * Du formulaire à la base de donnée
     *
     * @param [type] $frenchDate
     * @return void
     */
    public function reverseTransform($frenchDate)
    {
       return \DateTime::createFromFormat('d/m/Y', $frenchDate);
    }

}

?>