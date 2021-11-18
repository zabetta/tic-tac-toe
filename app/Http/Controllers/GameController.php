<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\game;

class GameController extends Controller
{
    public function playGameTurn(Request $request){

        // validation input
        $request->validate([
            'id' => 'required|numeric',
            'player' => 'required|in:1,2',
            'position' => 'required|in:1,2,3,4,5,6,7,8,9'
        ]);

        // get game from DB
        $game = Game::findOrFail($request->id);

        // check if game is active
        if ($game->active == false)
            return response('ERROR : Game '.$game->id.' HAS BEEN FINISHED !')
                  ->header('Content-Type', 'text/plain');

        // check if is player turn to play
        if ($game->user_turn != $request->player)
            return response('Player '.$request->player.' HAS TO wait his game turn !!!', 401)
                  ->header('Content-Type', 'text/plain');

        $grid = array_values(json_decode($game->grid, true));

        // check if position selected is empty
        if ($grid[ $request->position-1 ] != null)
            return response('Grid position '.$request->position.' has already been taken!', 401)
                ->header('Content-Type', 'text/plain');

        $currentPlayerSymbol = ($request->player == 1) ? 'X' : 'O';

        $grid[ $request->position-1 ] = $currentPlayerSymbol;

        $gameEnded = true;
        for ($i=0; $i < 9; $i++) { 
            if ( $grid[$i] == null){
                $gameEnded = false;
                break;
            }                
        }

        
        // check if any combination of symbol make the player win
        $winner = 
            (
                ($grid[0] == $currentPlayerSymbol && $grid[1] == $currentPlayerSymbol && $grid[2] == $currentPlayerSymbol) ||
                ($grid[3] == $currentPlayerSymbol && $grid[4] == $currentPlayerSymbol && $grid[5] == $currentPlayerSymbol) ||
                ($grid[6] == $currentPlayerSymbol && $grid[7] == $currentPlayerSymbol && $grid[8] == $currentPlayerSymbol)
            ) || (
                ($grid[0] == $currentPlayerSymbol && $grid[3] == $currentPlayerSymbol && $grid[6] == $currentPlayerSymbol) ||
                ($grid[1] == $currentPlayerSymbol && $grid[4] == $currentPlayerSymbol && $grid[7] == $currentPlayerSymbol) ||
                ($grid[2] == $currentPlayerSymbol && $grid[5] == $currentPlayerSymbol && $grid[8] == $currentPlayerSymbol)
            ) || (
                ($grid[0] == $currentPlayerSymbol && $grid[4] == $currentPlayerSymbol && $grid[8] == $currentPlayerSymbol) 
            ) || (
                ($grid[2] == $currentPlayerSymbol && $grid[4] == $currentPlayerSymbol && $grid[6] == $currentPlayerSymbol) 
            );


        // store updated grid to db
        $game->grid = json_encode($grid);
        
        // change player turn
        $game->user_turn = ($request->player == 1) ? 2 : 1;
        
        // keep game active or close it
        $game->active = !($winner || $gameEnded);

        $game->update();        

        return response()->json([
            'grid' => $grid,    
            'game_ended' => $winner || $gameEnded,
            'winner' => $winner == true ? $request->player : null
        ]);

    }
}
