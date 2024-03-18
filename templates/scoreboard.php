<?php
/**
 * Render scoreboard
 * 
 */

if ( isset( $scores ) && !empty( $scores ) ) : ?>

    <table>

        <tr>
            <td><b>Namn</b></td>
            <td><b>Poäng</b></td>
        </tr>

        <?php foreach ( $scores as $score ) : ?>

            <tr>
                <td><?php echo $score[ 'name' ]; ?></td>
                <td><?php echo $score['points']; ?></td>
            </tr>

        <?php endforeach; ?>

    </table>

<?php else : ?>

    <h3>Du måste spela några spel först.</h3>

<?php endif;