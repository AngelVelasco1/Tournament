<?php
class Tournament
{
    public $MP = []; // Matches played
    public $W = []; // Won
    public $D = []; // Draw
    public $L = []; // Lost
    public $P = []; // Points
    public $teams = [];
    public function __construct($score)
    {
        $this->teams = explode(';', $score);
    }

    public function getScores()
    {
        foreach ($this->teams as $index => $team) {
            if ($index % 3 == 2) {
                $index_team = $this->teams[$index];

                switch ($index_team) {
                    case "win":
                        $team1 = $this->teams[$index - 2];
                        $team2 = $this->teams[$index - 1];

                        ($this->W[$team1] ?? null) ? $this->W[$team1] += 1 : $this->W[$team1] = 1;
                        ($this->L[$team2] ?? null) ? $this->L[$team2] += 1 : $this->L[$team2] = 1;

                        ($this->P[$team1] ?? null) ? $this->P[$team1] += 3 : $this->P[$team1] = 3;
                        break;
                    case "draw":
                        $team1 = $this->teams[$index - 2];
                        $team2 = $this->teams[$index - 1];

                        ($this->D[$team1] ?? null) ? $this->D[$team1] += 1 : $this->D[$team1] = 1;
                        ($this->D[$team2] ?? null) ? $this->D[$team2] += 1 : $this->D[$team2] = 1;

                        ($this->P[$team1] ?? null) ? $this->P[$team1] += 1 : $this->P[$team1] = 1;
                        ($this->P[$team2] ?? null) ? $this->P[$team2] += 1 : $this->P[$team2] = 1;
                        break;

                    case "loss":
                        $team1 = $this->teams[$index - 2];
                        $team2 = $this->teams[$index - 1];

                        ($this->L[$team1] ?? null) ? $this->L[$team1] += 1 : $this->L[$team1] = 1;
                        ($this->W[$team2] ?? null) ? $this->W[$team2] += 1 : $this->L[$team2] = 1;

                        ($this->P[$team2] ?? null) ? $this->P[$team2] += 3 : $this->P[$team2] = 3;
                        break;
                }
            } 
            else {
                ($this->MP[$this->teams[$index]] ?? null) ? $this->MP[$this->teams[$index]] += 1 : $this->MP[$this->teams[$index]] = 1;
            }

        }
    }
    public function without() {
        $withoutW = array_diff_key($this->MP, $this->W);
        foreach ($withoutW as $team => $value) {
            $this->W[$team] = 0;
        }

        $withoutD = array_diff_key($this->MP, $this->D);
        foreach ($withoutD as $team => $value) {
            $this->D[$team] = 0;
        }

        $withoutL = array_diff_key($this->MP, $this->L);
        foreach ($withoutL as $team => $value) {
            $this->L[$team] = 0;
        }

        $withoutP = array_diff_key($this->MP, $this->P);
        foreach ($withoutP as $team => $value) {
            $this->P[$team] = 0;
        }
    }
    
}
 /* Call the class */
 $tournament1 = new Tournament("Allegoric Alaskans;Blithering Badgers;win;Devastating Donkeys;Courageous Californians;draw;Devastating Donkeys;Allegoric Alaskans;win;Courageous Californians;Blithering Badgers;loss;Blithering Badgers;Devastating Donkeys;loss;Allegoric Alaskans;Courageous Californians;win");
 /* Call the functions */
 $tournament1->getScores();
 $tournament1->without();
/* Print the data as a table */
    echo '<table>';
    echo "<tr><th>Equipo</th><th>MP</th><th>W</th><th>D</th><th>L</th><th>P</th></tr>";
    $count = 0;


        foreach($tournament1->teams as $index => $team) {
            
            if($index % 3 != 2) {
                echo '<tr>';
                echo "<td>$team</td>";
                    echo "<td>{$tournament1->MP[$team]}</td>";
                    echo "<td>{$tournament1->W[$team]}</td>";
                    echo "<td>{$tournament1->D[$team]}</td>";
                    echo "<td>{$tournament1->L[$team]}</td>";
                    echo "<td>{$tournament1->P[$team]}</td>";
                    echo '</tr>';
                    $count++;
                }
                
                if ($count >= 4) {
                    break;
                }   
            }
             echo '</table>';



?>