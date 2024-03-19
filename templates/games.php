<?php
/**
 * List games
 */

if ( isset( $games ) && !empty( $games ) ) : ?>

    <table>
        <tr>
            <td><b>Spelat</b></td>
            <td><b>Vinnare</b></td>
            <td><b>Radera spel</b></td>
        </tr>
        <?php foreach ( $games as $game ) : ?>
            <tr>
                <td><?php echo $game->game->timestamp; ?></td>
                <td><?php echo $game->player->name; ?></td>
                <td>
                    <?php include __DIR__ . '/components/game-form.php'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
 
<?php else : ?>
    
    <h3>Du har inte spelat några spel</h3>
 
<?php endif; ?>    