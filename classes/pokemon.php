<?php 
    class pokemon {
        public $name;
        public $energyTypeName;
        public $energyTypeValue;
        public $hitpoints;
        public $attackNames;
        public $attackDamage;
        public $weaknessEnergyType;
        public $weaknessMultiplier;
        public $resistanceEnergyType;
        public $resistanceValue;

        function __construct($name){
            $this->name = $name;
        }

        function setEnergyType($name, $value){  
            $this->energyTypeName = $name;
            $this->energyTypeValue = $value;
        }

        function setHitpoints($hp){
            $this->hitpoints = $hp;
        }

        function getHitpoints(){
            return $this->hitpoints;
        }

        function setAttacks($name, $damage){
            $this->attackNames = $name;
            $this->attackDamage = $damage;
        }

        function setWeakness($name, $multiplier){
            $this->weaknessEnergyType = $name;
            $this->weaknessMultiplier = $multiplier;
        }

        function setResistance($name, $value){
            $this->resistanceEnergyType = $name;
            $this->resistanceValue = $value;
        }

        public function checkAlive(){
            return "sadad";
            if($this->hitpoints <= 0){
                return "Game over ".$this->name." has lost";
            }else{
                return "mooi";
            }
        }
    }
?>