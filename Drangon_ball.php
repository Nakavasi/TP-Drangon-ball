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
    protected $sedefendre;

    protected function __construct($n,$vie,$vieMax,$p,$a,$d,$vitesse,$t){
        $this->Nom=$n;
        $this->Vie=$vie;
        $this->VieMax=$vieMax;
        $this->Puissance=$p;
        $this->Attack=$a;
        $this->Defence=$d;
        $this->Vitesse=$vitesse;
        $this->technique=$t;
        $this->sedefendre=false;
    }

}
// A class with stats for the hero.
class hero extends Personage {
    //the constructor of the class hero.
    public function __construct($n, $v,$vmax, $p, $a, $d, $vi, $t) {
        //the constructor of the class Personage is called.
        parent::__construct($n, $v,$vmax, $p, $a, $d, $vi, $t);
    }

    public function Attaque($enemy){
        //will choose a random attack.
        for ($i=0; $i < count($this->technique)-random_int(1,count($this->technique)); $i++) { 
            next($this->technique);
        }
        //attack the enemy
        print("You attack the enemy with ". $this->technique[key($this->technique)] ."\n");
        print("The enemy take ".$enemy->prendredegat($this->Attack*key($this->technique))." damage.\n");
        $enemy->arreterdesedeffendre();
        reset($this->technique);
        return $this->Attack*key($this->technique);
    }

    public function arreterdesedeffendre(){
        $this->sedefendre=false;
    }

    public function prendredegat($attackEnemy){
        //decrease the hp
        $this->Vie= $this->Vie - round($attackEnemy/($this->Defence+1),2);
        return round($attackEnemy/($this->Defence+1),2);
    }

    public function mourrir(){
        //check if is alive
        return $this->Vie>0;
    }

    public function getvit(){
        //return the speed
        return $this->Vitesse;
    }

    public function getsedefendre(){
        //return if the hero is defending
        return $this->sedefendre;
    }

    public function Defendre(){
        //increase the defence
        $this->Defence=$this->Defence*2;
        $this->sedefendre=true;
    }
    public function afficherStat(){
        print("Voici les statistique de ".$this->Nom.":\n");
        print("Puissance:".$this->Puissance."\n");
        print("Attaque:".$this->Attack."\n");
        print("Defence:".$this->Defence."\n");
        print("Vitesse:".$this->Vitesse."\n");
        print("Vie:".$this->Vie."/".$this->VieMax."\n");
    }
}

// A class with stats for the villain.
class villain extends Personage{
    //the constructor of the class villain.
    public function __construct($n, $v,$vmax, $p, $a, $d, $vi, $t) {
        //the constructor of the class Personage is called.
        parent::__construct($n, $v,$vmax, $p, $a, $d, $vi, $t);
    }

    public function Attaque($enemy){
        //will choose a random attack
        for ($i=0; $i < count($this->technique)-random_int(1,count($this->technique)); $i++) { 
            next($this->technique);
        }
        //attack the enemy
        print("The enemy attack you with ". $this->technique[key($this->technique)] ."\n");
        print("You take ".$enemy->prendredegat($this->Attack*key($this->technique))." damage.\n");
        print($enemy->mourrir());
        reset($this->technique);
    }

    //stop defending
    public function arreterdesedeffendre(){
        $this->sedefendre=false;
    }

    public function prendredegat($attackEnemy){
        //decrease the hp
        $this->Vie= $this->Vie - round($attackEnemy/($this->Defence+1),2);
        return round($attackEnemy/($this->Defence+1),2);
    }

    public function mourrir(){
        //check if is alive
        return $this->Vie>0;
    }

    public function getvit(){
        //return the speed
        return $this->Vitesse;
    }

    
    public function getsedefendre(){
        //return if the hero is defending
        return $this->sedefendre;
    }
    
    public function Defendre(){
        //increase the defence
        $this->Defence=$this->Defence*2;
    }
    public function afficherStat(){
        print("Voici les statistique de ".$this->Nom.":\n");
        print("Puissance:".$this->Puissance."\n");
        print("Attaque:".$this->Attack."\n");
        print("Defence:".$this->Defence."\n");
        print("Vitesse:".$this->Vitesse."\n");
        print("Vie:".$this->Vie."/".$this->VieMax."\n");
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
       $reponse = readline("Que souhaiter vous faire :\n 1-attacker\n 2-Defendre\n");
       popen('cls','w');
       if ($reponse == 1){
            $attaquant->Attaque($cible);
        }
        else if ($reponse == 2){
            $attaquant->Defendre();
       }
       $cible->Attaque($attaquant);
       $attaquant->afficherStat();
       $cible->afficherStat();
   }
   
}

$hero = new hero ("hero",100,100,10,10,10,10,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule"]);
$villain = new villain ("villain",100,100,10,10,10,10,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule"]);


combat($hero,$villain);
