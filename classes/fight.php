<?php 
    class fight{
        public $player1Attack;
        public $player2Attack;

        function setAttack($attack1, $attack2){
            $this->player1Attack = $attack1; 
            $this->player2Attack = $attack2; 
        }

        function attack($hpPlayer1, $hpPlayer2){
            $return[0] = ($hpPlayer1 - $this->player2Attack);
            $return[1] = ($hpPlayer2 - $this->player1Attack);

            return $return;
        }
    }
?>