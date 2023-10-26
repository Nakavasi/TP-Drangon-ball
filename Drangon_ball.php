<?php
///A class with stats 
class Personage{
    //all variable are protected due of the heritage
    protected $Nom;
    protected $Vie;
    protected $VieMax;
    protected $Puissance;
    protected $Attack;
    protected $Defence;
    protected $Vitesse;
    protected $technique;

    protected function __construct($n,$vie,$vieMax,$p,$a,$d,$vitesse,$t){
        $this->Nom=$n;
        $this->Vie=$vie;
        $this->VieMax=$vieMax;
        $this->Puissance=$p;
        $this->Attack=$a;
        $this->Defence=$d;
        $this->Vitesse=$vitesse;
        $this->technique=$t;
    }

}

class hero extends Personage {

    public function __construct($n, $v,$vmax, $p, $a, $d, $vi, $t) {
        parent::__construct($n, $v,$vmax, $p, $a, $d, $vi, $t);
    }

    public function Attaque($enemy){
        //will choose a random attack
        for ($i=0; $i < count($this->technique)-random_int(1,count($this->technique)); $i++) { 
            next($this->technique);
        }
        //attack the enemy
        print("You attack the enemy with ". $this->technique[key($this->technique)] ."\n");
        print("The enemy take ".$enemy->prendredegat($this->Attack*key($this->technique))." damage.\n");
        print($enemy->mourrir());
        reset($this->technique);
    }

    public function prendredegat($attackEnemy){
        //decrease the hp
        $this->Vie= $this->Vie - $attackEnemy/($this->Defence+1);
        return ($attackEnemy/$this->Defence+1);
    }

    public function mourrir(){
        //check if is alive
        return $this->Vie>0;
    }

    public function getvit(){
        return $this->Vitesse;
    }
}
class villain extends Personage{

    public function __construct($n, $v,$vmax, $p, $a, $d, $vi, $t) {
        parent::__construct($n, $v,$vmax, $p, $a, $d, $vi, $t);
    }

    public function Attaque($enemy){
        //will choose a random attack
        for ($i=0; $i < count($this->technique)-random_int(1,count($this->technique)); $i++) { 
            next($this->technique);
        }
        //attack the enemy
        print("You attack the enemy with ". $this->technique[key($this->technique)] ."\n");
        print("The enemy take ".$enemy->prendredegat($this->Attack*key($this->technique))." damage.\n");
        print($enemy->mourrir());
        reset($this->technique);
    }

    public function prendredegat($attackEnemy){
        //decrease the hp
        $this->Vie= $this->Vie - $attackEnemy/($this->Defence+1);
        return ($attackEnemy/$this->Defence+1);
    }

    public function mourrir(){
        //check if is alive
        return $this->Vie>0;
    }
    
    public function afficherStat(){
        print("Voici les statistique de ".$this->Nom.":\n");
        print("Puissance:".$this->Puissance."\n");
        print("Attaque:".$this->Attack."\n");
        print("Defence:".$this->Defence."\n");
        print("Vitesse:".$this->Vitesse."\n");
        print("Vie:".$this->Vie."/".$this->VieMax."\n");
    }
    public function getvit(){
        return $this->Vitesse;
    }
}
function combat($attaquant, $cible){

   while ($attaquant->mourrir() && $cible->mourrir()) {
       //check who is the attacker
       if ($attaquant->getvit($attaquant)>$cible->getvit($cible)) {
           $attaquant->Attaque($cible);
           if ($cible->mourrir()) {
               $cible->Attaque($attaquant);
           }
        //if the attacker is the villain
       }
       $reponse = readline("Voulez vous attaquer ? (oui/non) :\n");
         if ($reponse === "non") {
              $reponse = readline("Voulez vous vous défendre ? (oui/non) : ");
              if ($reponse === "oui") {
                  $attaquant->Defence($cible);}
         }
       else{
           $cible->Attaque($attaquant);
           if ($attaquant->mourrir()) {
               $attaquant->Attaque($cible);
           }
       }

       $degat=$attaquant->Attaque($cible);
         print("L'ennemie prend ".$degat." de dégats.\n");
   }
   
}

$hero = new hero("Carote",100,100,10,10,10,10,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule"]);
$villain = new villain("Frigidaire",100,100,10,10,10,10,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule"]);



combat($hero,$villain);
