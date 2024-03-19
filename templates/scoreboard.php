<?php
/**
 * Render scoreboard
 * 
 */

$i = 0;
if ( isset( $scores ) && !empty( $scores ) ) : ?>

    <table width="100%">

        <tr>
            <td></td>
            <td><b>Namn</b></td>
            <td><b>Poäng</b></td>
            <td><b>Lägg till vinst</b></td>
        </tr>

        <?php foreach ( $scores as $score ) : ?>
            <?php $i++; ?>
            <tr>
                <td>
                    <?php if ( 1 == $i ) : ?>
                        <img src="/assets/images/star.gif" height="30px">
                    <?php endif; ?>
                </td>
                <td><?php echo $score[ 'name' ]; ?></td>
                <td>
                    <img src="/assets/images/<?php echo $score[ 'points' ]; ?>.gif" height="25px"></td>
                <td>
                    <?php include __DIR__ . '/components/score-form.php'; ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

<?php else : ?>

    <h3>Du måste spela några spel först.</h3>

<?php endif;