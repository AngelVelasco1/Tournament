<?php
class Tournament
{
    public $MP = []; // Matches played
    public $W = []; // Won
    public $D = []; // Draw
    public $L = []; // Lost
    public $P = []; // Points

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
                    case "Win":
                        $team1 = $this->teams[$index - 2];
                        $team2 = $this->teams[$index - 1];

                        ($this->W[$team1] ?? NULL) ? $this->W[$team1] += 1 : $this->W[$team1] = 1;
                        ($this->L[$team2] ?? NULL) ? $this->L[$team2] += 1 : $this->L[$team2] = 1;

                        ($this->P[$team1] ?? NULL) ? $this->P[$team1] += 3 : $this->P[$team1] = 3;
                        break;
                    case "Draw":
                        $team1 = $this->teams[$index - 2];
                        $team2 = $this->teams[$index - 1];

                        ($this->D[$team1] ?? NULL) ? $this->D[$team1] += 1 : $this->D[$team1] = 1;
                        ($this->D[$team2] ?? NULL) ? $this->D[$team2] += 1 : $this->D[$team2] = 1;

                        ($this->P[$team1] ?? NULL) ? $this->P[$team1] += 1 : $this->D[$team1] = 1;
                        ($this->P[$team2] ?? NULL) ? $this->P[$team2] += 1 : $this->D[$team2] = 1;
                        break;

                    case "Lose":
                        $team1 = $this->teams[$index - 2];
                        $team2 = $this->teams[$index - 1];

                        ($this->L[$team1] ?? NULL) ? $this->L[$team1] += 1 : $this->L[$team1] = 1;
                        ($this->W[$team2] ?? NULL) ? $this->W[$team2] += 1 : $this->L[$team2] = 1;

                        ($this->P[$team2] ?? NULL) ? $this->P[$team2] += 3 : $this->P[$team2] = 3;
                        break;
                    default:
                        "ERROR: Unknown team";
                }
                ;
            } 
            else {
                ($this->MP[$this->teams[$index]] ?? NULL) ? $this->MP[$this->teams[$index]] += 1 : $this->MP[$this->teams[$index]] = 1;
            }
        }
    }
}