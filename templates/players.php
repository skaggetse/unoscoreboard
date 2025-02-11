<?php
/**
 * Render scoreboard
 * 
 */

$i = 0;
if ( isset( $players ) && !empty( $players ) ) : ?>

    <table width="100%" id="players">
        <tr>
            <td><b>L&auml;gg till</b></td>
            <td><b>Namn</b></td>
        </tr>
        
        <?php foreach ( $players as $player ) : ?>
            <tr>
                <td>
                    <?php include __DIR__ . '/components/player-form.php'; ?>
                </td>
                <td><?php echo str_replace(array('å', 'ä', 'ö', 'Å', 'Ä', 'Ö'), array('&aring;', '&auml;', '&ouml;', '&Aring;', '&Auml;', '&Ouml;'), $player->name); ?></td>
            </tr>

        <?php endforeach; ?>
        
        
    </table>
    
<?php else : ?>

    <h3>Det finns inga spelare tillagda &auml;n.</h3>

<?php endif;