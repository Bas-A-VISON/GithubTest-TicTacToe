<?php
//update
class BKE {
public $player1;
public $player2;
public $currentPlayer;  
public $gameMessage;   
 
public $board = [
        [NULL,NULL,NULL],
        [NULL,NULL,NULL],
        [NULL,NULL,NULL]
        ];
   
function toss($players){ 
 
      $this->player1 = $players[0];
      $this->player2 = $players[1];
      $beginner = array_rand($players);
      $this->currentPlayer = $players[$beginner];

}
 
    function addMove($ver,$hor,$playername){
        $this->board[$ver][$hor] = $playername;
            return true;
    }   

    function playerTurn(){
 
        $subArrays = [];
        $subArrayPositions = [];
       //maak een selectie van de arrays die een lege positie hebben
        for($i=0;$i<3;$i++){
            if(in_array(NULL, $this->board[$i])){
            array_push($subArrays, $i);
            }         
        } 
        if(!$subArrays){
           //geen beurten meer, gelijkspel.
           $this->gameMessage = 'DRAW!';  
           return "result";
        }else{ 
            //selecteer 1 positie uit de array SubArrays     
            $selectedPositionSubArray = array_rand($subArrays);
            $verticalPosition = $subArrays[$selectedPositionSubArray];
            for($i=0;$i<3;$i++){
                if($this->board[$verticalPosition][$i] === NULL){
                  array_push($subArrayPositions, $i);
                }
            }
            $temp = array_rand($subArrayPositions);        
            $horizontalPosition = $subArrayPositions[$temp];
            $newMove = $this->addMove($verticalPosition,$horizontalPosition,$this->currentPlayer);  
            if($newMove){
                $result = $this->checkForWinner();
                return $result;
            }
        }    
    }
 
    function checkForWinner(){
       for($i=0;$i<3;$i++){
            if (($this->board[$i][0] == $this->currentPlayer) && ($this->board[$i][1] == $this->currentPlayer) && ($this->board[$i][2] === $this->currentPlayer) || ($this->board[0][$i] == $this->currentPlayer) && ($this->board[1][$i] == $this->currentPlayer) && ($this->board[2][$i] === $this->currentPlayer)){
                $this->gameMessage = $this->currentPlayer.' has won!'; 
                $result = "result"; 
                return $result;  
                exit;     
            }
         }        
        if(($this->board[0][0] == $this->currentPlayer) && ($this->board[1][1] == $this->currentPlayer) && ($this->board[2][2] == $this->currentPlayer)|| ($this->board[0][2] == $this->currentPlayer) && ($this->board[1][1] == $this->currentPlayer) && ($this->board[2][0] == $this->currentPlayer)){
            $this->gameMessage = $this->currentPlayer.' has won!'; 
            $result = "result"; 
            return $result;   
        }else{
           
        $currentPlayer = $this->changePlayer();
        return $currentPlayer;
        }
    }

    function changePlayer(){
        if($this->currentPlayer === $this->player1){
             $this->currentPlayer = $this->player2;
        }elseif($this->currentPlayer === $this->player2){
            $this->currentPlayer = $this->player1;             
        } 
        return "no result"; 
         //$this->pickPosition();
    }
    

    function startGame(){
        $result = "no result";
        $this->toss(["X", "0"]);
        while($result === "no result"){
          $result = $this->playerTurn();
          //echo $result;
        }
        return [$this->board, $this->gameMessage];
    }
} 

$BKE = new BKE();
$startGame = $BKE->startGame();  
$newGame = $startGame[0];
    echo 'The result is :'.$startGame[1].'<br><table style="boarder:3px solid black">
    <tr>
     <td style="border:3px solid black">'.$newGame[0][0].'</td>
     <td style="border:3px solid black">'.$newGame[0][1].'</td>
     <td style="border:3px solid black">'.$newGame[0][2].'</td>
    </tr>
    <tr>
    <td style="border:3px solid black">'.$newGame[1][0].'</td>
    <td style="border:3px solid black">'.$newGame[1][1].'</td>
    <td style="border:3px solid black">'.$newGame[1][2].'</td>
    </tr>
    <tr>
    <td style="border:3px solid black">'.$newGame[2][0].'</td>
    <td style="border:3px solid black">'.$newGame[2][1].'</td>
    <td style="border:3px solid black">'.$newGame[2][2].'</td>
    </tr>';
?>