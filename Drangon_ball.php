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
    protected $nbrdevictoire=0;

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
        print("Tu attaque l'enemy avec ". $this->technique[key($this->technique)] ."\n");
        print("L'enemy prend ".$enemy->prendredegat($this->Attack*key($this->technique))." de degats.\n");
        sleep(2);
        popen('cls','w');
        $enemy->arreterdesedeffendre();
        reset($this->technique);
        return $this->Attack*key($this->technique);
    }

    public function arreterdesedeffendre(){
        if ($this->sedefendre==true){
            $this->Defence= $this->Defence/2;
            $this->sedefendre=false;
        }
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
        print("Vous vous dÃ©fendez!\n");
        print("Defence X2!\n");
        sleep(2);
        popen('cls','w');
    }
    public function afficherStat(){
        print("Voici les statistique de ".$this->Nom.":\n");
        print("Puissance:".$this->Puissance."\n");
        print("Attaque:".$this->Attack."\n");
        print("Defence:".$this->Defence."\n");
        print("Vitesse:".$this->Vitesse."\n");
        print("Vie Max: ".$this->VieMax."\n");
        print("Barre de vie :[");
        for ($i=0; $i <round($this->Vie/$this->VieMax*20) ; $i++) { 
            print("|");
        }
        for ($i=0; $i <20-round($this->Vie/$this->VieMax*20) ; $i++) { 
            print(".");
        }
        print("]\n");
    }

    public function getnbrdevictoire(){
        return $this->nbrdevictoire;
    }

    public function Victoire(){
        $this->nbrdevictoire= $this->nbrdevictoire+1;
        $this->Attack= $this->Attack+5;
        $this->Defence= $this->Defence+5;
        $this->Vitesse= $this->Vitesse+5;
        $this->VieMax= $this->VieMax+25;
        print("+5 attack, defence et vitesse\n +25 Vie max\n");
    }

    public function addtechnique($technique){
        $this->technique[key($technique)]= $technique[key($technique)];
    }
    public function Fullvie(){
        $this->Vie= $this->VieMax;
    }

}

// A class with stats for the villain.
class villain extends Personage{
    //the constructor of the class villain.
    public function __construct($n, $v,$vmax, $p, $a, $d, $vi, $t) {
        //the constructor of the class Personage is called.
        parent::__construct($n, $v,$vmax, $p, $a, $d, $vi, $t);
    }
    public function getnom(){
        return $this->Nom;
    }

    public function Attaque($enemy){
        //will choose a random attack
        for ($i=0; $i < count($this->technique)-random_int(1,count($this->technique)); $i++) { 
            next($this->technique);
        }
        //attack the enemy
        print("L'enemy t'attaque avec ". $this->technique[key($this->technique)] ."\n");
        print("Tu prend ".$enemy->prendredegat($this->Attack*key($this->technique))." de degats.\n");
        sleep(2);
        popen('cls','w');
        $enemy->arreterdesedeffendre();
        reset($this->technique);
    }

    //stop defending
    public function arreterdesedeffendre(){
        if ($this->sedefendre==true){
            $this->Defence= $this->Defence/2;
            $this->sedefendre=false;
        }
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
        print("L'enemi se defend.\n");
        print("Defence X2!\n");
        sleep(2);
        popen('cls','w');
    }
    public function afficherStat(){
        print("Voici les statistique de ".$this->Nom.":\n");
        print("Puissance:".$this->Puissance."\n");
        print("Attaque:".$this->Attack."\n");
        print("Defence:".$this->Defence."\n");
        print("Vitesse:".$this->Vitesse."\n");
        print("Vie Max: ".$this->VieMax."\n");
        print("Barre de vie :[");
        for ($i=0; $i <round($this->Vie/$this->VieMax*20) ; $i++) { 
            print("|");
        }
        for ($i=0; $i <20-round($this->Vie/$this->VieMax*20) ; $i++) { 
            print(".");
        }
        print("]\n");
    }
    public function getnbrdevictoire(){
        return $this->nbrdevictoire;
    }

    public function Fullvie(){
        $this->Vie= $this->VieMax;
    }
}

function combat($attaquant, $cible){
    print("Vous tomber sur ".$cible->getnom().".\n");
    sleep(2);
    popen('cls','w');
    while ($attaquant->mourrir() && $cible->mourrir()) {
       $attaquant->afficherStat();
       $cible->afficherStat();
       $reponse = readline("Que souhaiter vous faire :\n 1-attacker\n 2-Defendre\n");
       $choixEnemy=random_int(1,4);
       popen('cls','w');
       //Check if attack or defend
       if ($reponse == 1){
           //check who attack first
           if ($attaquant->getvit($attaquant)>$cible->getvit($cible)) {
               $attaquant->Attaque($cible);
               if ($cible->mourrir()) {
                   $cible->Attaque($attaquant);
                }
            }
            else{               
                if($choixEnemy!=4){
                    $cible->Attaque($attaquant);
                }
                else{
                    $cible->Defendre();
                }
                if ($attaquant->mourrir()) {
                   $attaquant->Attaque($cible);
               }
            }
        }
        else if ($reponse == 2){
            $attaquant->Defendre();
            $cible->Attaque($attaquant);
        }
        else{
            print("Tu n'as pas reussit a choisir.\n");
            $cible->Attaque($attaquant);
        }
        //check who win
    }
}
popen('cls','w');
// Vie,Viemax,Puissance,attack,defence,vitesse,technique
$hero = new hero("Goku",100,100,140,25,10,10,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule"]);
$villain1 = new villain("raditz",105,105,150,25,10,10,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule"]);
$villain2 = new villain("Freezer",150,150,150,20,9,15,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule",4=>"Lazer"]);
$villain3 = new villain("Super Buu",180,180,160,40,30,18,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule",9=>"transformation en bonbon"]);
$villain4 = new villain("Kid Buu",200,200,200,45,25,27,[1=>"coup de poing",2=>"coup de pied",3=>"coup de boule",10=>"boule d'energie"]);
$villains=[$villain1,$villain2,$villain3,$villain4];
print("Vous vous balader tranquilement quand tout d'un coup...\n");
sleep(2);
popen('cls','w');
while($hero->getnbrdevictoire()<4){
    combat($hero,$villains[$hero->getnbrdevictoire()]);
    if ($hero->mourrir()){
        print("Vous avez vaincu l'enemy bravo!\n");
        $hero->victoire();
        sleep(2);
        if($hero->getnbrdevictoire()==1){
            $hero->addtechnique([5=>"Kamehameha"]);
            print("Nouvel attack appris -> Kamehameha!\n");
            sleep(2);
            popen('cls','w');
        }
        if($hero->getnbrdevictoire()==3){
            $hero->addtechnique([8=>"makankosappo"]);
            print("Nouvel attack appris ->makankosappo!\n");
            sleep(2);
            popen('cls','w');
        }
    }
    else{
        print("Vous avez perdu...\n");
        sleep(2);
        popen('cls','w');
    }
    $hero->Fullvie();
    $villains[$hero->getnbrdevictoire()]->Fullvie();
}
