<?php
if ( ! isset( $games ) ) return;

$days = date('t', strtotime( $month ));

$scores = array();

$matrix = array();

$player_points = array();

foreach ( $players as $player ) {
    $player_points[ $player->id ] = 0;
}

// dump($games);

foreach ( array_reverse( $games ) as $game ) {
    $day = date('j', strtotime( $game->game->timestamp ) );
    
    $matrix[ $day ][ $player_points[ $game->game->winner ] + 1 ] = array( $game->game->winner,  );
    
    $player_points[ $game->game->winner ] = $player_points[ $game->game->winner ] + 1;
}

// dump( $matrix );

?>

<table>
    
<?php 

// foreach ( $player_points as $progress ) {
    
//     // foreach ( $progress as ) {
        
//     // }
    
// }

?>

</table>