<?php

namespace App\Entity;

class RechercheVoiture{
    private  $minAnnee;


    public function getMinAnnee()
    {
        return $this->minAnnee;
    }


    public function setMinAnnee(int $minAnnee)
    {
        $this->minAnnee = $minAnnee;
    }


    public function getMaxAnnee()
    {
        return $this->maxAnnee;
    }


    public function setMaxAnnee(int $maxAnnee)
    {
        $this->maxAnnee = $maxAnnee;
    }
    private $maxAnnee;



}