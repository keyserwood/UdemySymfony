<?php

namespace App\Entity;

class Armes
{
    public $nom;
    public $desc;
    public $degat;

    public static $armes=[];

    public function __construct($nom, $desc, $degat)
    {
        $this->nom = $nom;
        $this->desc = $desc;
        $this->degat = $degat;
        self::$armes[] = $this;
    }
    public static function creerArmes()
    {
        $a1 = new Armes("Arc", "Jeune Arc", 4);
        $a2 = new Armes("Hache", "Jeune Hache", 5);
        $a3 = new Armes("Epee", "Jeune Epee", 7);
    }
    public static function getArmesParNom($nom){
        foreach(self::$armes as $arme)
        {
            if (strtolower($arme->nom) ==$nom ){
                return $arme;
            }
        }

    }
}

?>




