<?php 
    error_reporting(0);
    session_start();
    include "classes/pokemon.php";
    include "classes/fight.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Battle</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php 
        // if((!isset($_SESSION["pickachu"]) || !isset($_SESSION['charmeleon']))){
            GLOBAL $pickachu;
            GLOBAL $charmeleon;
            $pickachu = new pokemon("pickachu");
            $charmeleon = new pokemon("charmeleon");
            $pickachu->setEnergyType("Lightning", 1);
            $pickachu->setHitpoints(60);
            $pickachu->setAttacks(array("Electric Ring", "Pika Punch"), array(50, 20));
            $pickachu->setWeakness("Fire", 1.5);
            $pickachu->setResistance("Fighting", 20);
            $_SESSION['pickachu'] = array();
            $_SESSION['pickachu'] = $pickachu;
            
            $charmeleon->setEnergyType("Fire", 1);
            $charmeleon->setHitpoints(60);
            $charmeleon->setAttacks(array("Head Butt", "Flare"), array(10, 30));
            $charmeleon->setWeakness("Water", 2);
            $charmeleon->setResistance("Lightning", 10);
            $_SESSION['charmeleon'] = array();
            $_SESSION['charmeleon'] = $charmeleon;
            
            if(isset($_SESSION['newHP'][0]) && isset($_SESSION['newHP'][1])){
                if($_SESSION['newHP'][0] == 0){
                    echo "Pickachu: 60 HP";
                }else{
                    echo "Pickachu: ".$_SESSION['newHP'][0]." HP";
                }
                echo "<br>";
                if($_SESSION['newHP'][1] == 0){
                    echo "Charmeleon: 60 HP";
                }else{
                    echo "Charmeleon: ".$_SESSION['newHP'][1]." HP";
                }
            }else{
                echo "Pickachu: ".$pickachu->hitpoints." HP";
                echo "<br>";
                echo "Charmeleon: ".$charmeleon->hitpoints. "HP";

            }

        function loadAttacks($attacksPlayer1Names, $attacksPlayer1Damage, $attacksPlayer2Names, $attacksPlayer2Damage){
            $return = "<form method=\"POST\">";
            $return .= "    <select name='attack1'>";
            $return .= "        <option value\"asd\">Selecteer een aanval..</option>";
            for($j = 0; $j < count($attacksPlayer1Names); $j++){
                $return .= "    <option value=\"".$j."\">".$attacksPlayer1Names[$j]."</option>";
            }
            $return .= "    </select>";
            $return .= "     <select name='attack2'>";
            $return .= "      <option value\"asd\">Selecteer een aanval..</option>";
            for($i = 0; $i < count($attacksPlayer2Names); $i++){
                $return .= "    <option value=\"".$i."\">".$attacksPlayer2Names[$i]."</option>";
            }
            $return .= "    </select>";
            $return .= "    <button type=\"submit\">FIGHT!</button>";
            $return .= "</form>";

            return $return;
        }

        echo loadAttacks($pickachu->attackNames, $pickachu->attackDamage, $charmeleon->attackNames, $charmeleon->attackDamage);

        function newRound($id1, $id2, $pickachu, $charmeleon){
            $fight = new fight();
            $fight->setAttack($pickachu->attackDamage[$id1], $charmeleon->attackDamage[$id2]);
            $newHP = $fight->attack($pickachu->hitpoints, $charmeleon->hitpoints);
            $_SESSION['newHP'][0] = (intval($_SESSION['newHP'][0]) + intval($newHP[0]));
            $_SESSION['newHP'][1] = (intval($_SESSION['newHP'][1]) + intval($newHP[1]));
            if($_SESSION['newHP'][0] >= 60){
                echo "<h1>Game Over pickachu is dood</h1>";
                $_SESSION['newHP'] = array(0, 0);
            }else if($_SESSION['newHP'][1] >= 60){
                echo "<h1>Game Over charmeleon is dood</h1>";
                $_SESSION['newHP'] = array(0, 0);
                die;
            }
        }

        if(isset($_POST['attack1']) && isset($_POST['attack2']) && $_POST['attack1'] != "" && $_POST['attack2'] != ""){
            $attack1 = $_POST['attack1'];
            $attack2 = $_POST['attack2'];
            unset($_POST);
            newRound($attack2, $attack2, $pickachu, $charmeleon);
        }
    ?>
</body>
</html>