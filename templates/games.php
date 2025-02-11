<?php
/**
 * List games
 */

 $i = 0;
 
 if ( isset( $_POST['winner'] ) && isset( $_POST['participants'] ) ) {
     $winner = $_POST['winner'];
     $participants = $_POST['participants'];
     $this->_api->addGame( $winner, $participants );
 }
?>

<?php if ( date('Y-m', strtotime( $month )) == date('Y-m') ) : ?>
<table>
    <h1>Lägg till spel</h1>
    <form action="/addScore" method="post">
        <div>
            <h3>Vinnare</h3>
            <div style="display:flex">
                <?php foreach ($players as $player) : ?>
                    <div>
                        <input type="radio" id="winner_<?php echo $player->id; ?>" name="winner" value="<?php echo $player->id; ?>">
                        <label for="winner_<?php echo $player->id; ?>"><?php echo $player->name; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <h3>Deltagare</h3>
            <div style="display:flex">
                <?php foreach ($players as $player) : ?>
                    <div>
                        <input type="checkbox" id="participant_<?php echo $player->id; ?>" name="participants[]" value="<?php echo $player->id; ?>">
                        <label for="participant_<?php echo $player->id; ?>"><?php echo $player->name; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div><br />
        <button type="submit">Spara</button>
    </form>
</table>
<?php endif; ?>

<?php if ( isset( $games ) && !empty( $games ) ) : ?>

    <table width=100%>
        <tr>            
            <td>
                <a href="<?php echo sprintf( '?month=%s', date( 'Y-m', strtotime( $month . ' -1 month') ) ); ?>">
                    <img src="/assets/images/previous.gif" alt="">
                </a>
            </td>
            <td colspan=4>
                <h1><?php echo sprintf( 'Spelade spel i %s: %s', date('F', strtotime( $month )), count( $games )  ); ?></h1>
            </td>
            <td>
                <a href="<?php echo sprintf( '?month=%s', date( 'Y-m', strtotime( $month . ' +1 month') ) ); ?>">
                    <img src="/assets/images/next.gif" alt="">
                </a>
            </td>
        </tr>
    </table>

    <table width=100%>
        <tr>
            <td><b>Spelat</b></td>
            <td><b>Deltagare</b></td>
            <td><b>Vinnare</b></td>
            <td><b>Radera spel</b></td>
        </tr>
        <?php foreach ( $games as $game ) : ?>
            <?php $i++; ?>
            <tr>
                <td><?php echo date( 'd M H:i', strtotime( $game->created_at ) ); ?></td>
                <td>
                    <?php foreach ( $game->participants as $participant ) : ?>
                        <?php echo $participant->name; ?>
                    <?php endforeach; ?>
                <td>
                <td>
                    <?php echo $game->winner->name; ?>
                </td>
                <td>                    
                <?php
                    if ( 1 === $i ) {
                        include __DIR__ . '/components/game-form.php';
                    }
                ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
 
<?php else : ?>
    
    <h3>Du har inte spelat n&aring;gra spel</h3>
 
<?php endif; ?>    