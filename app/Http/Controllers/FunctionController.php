<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class FunctionController extends Controller
{   

    // First page to visit
    public function questionPage(Request $request)
    {
        return Inertia::render('Questions');
    }

    // Process Input
    public function proceesQuestion(Request $request)
    {   
        // Prevent wrong input and validation
        if(!$request->total_players || !is_numeric($request->total_players) ||$request->total_players <= 0 ){
            return back()->withErrors("Input value does not exist or value is invalid");
        }

        // Range to generate
        $card_label = [ 'S', 'H', 'D', 'C' ];
        $card_range = [ 'A', 2, 3, 4, 5, 6, 7, 8, 9, 'X', 'J', 'Q', 'K' ];
        $total_cards = [];
        
        foreach($card_label as $label)
        {
            foreach($card_range as $range){
                $total_cards[] = $label.$range;
            }
        }
        
        // Shuffle card list
        shuffle($total_cards);
                
        $total_player = $request->total_players;
        
        // Count current exist players
        $total_cards_counting = count($total_cards);
        
        $each_player = floor($total_cards_counting / $total_player);

        // Distribute to current users even over card range
        if($each_player == 0){
            $each_player = 1;
        }

        $player_card_list = [];
        
        // Using cutpoint to distribute card to each player
        $cutpoint = 0;
        for($i=0; $i < $total_player; $i++)
        {
            $current_distribute = array_slice($total_cards, $cutpoint, $each_player);
            if(count($current_distribute) == 0){
                $current_distribute = "No card available";
            }
            else {
                $current_distribute = implode(", ", $current_distribute);
            }
            $player_card_list[] = $current_distribute;
            $cutpoint += $each_player;
        }
        
        // Record remain card list if got leftover
        $remaining_list = [];
        if(($total_player * $each_player) != $total_cards_counting){
            $remaining_list = implode(", ", array_slice($total_cards, $cutpoint));
        }

        return Inertia::render('Answer', compact('total_player', 'player_card_list', 'remaining_list'));
    }

}
