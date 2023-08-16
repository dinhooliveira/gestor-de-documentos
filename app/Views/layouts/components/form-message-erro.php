<?php
if (!empty($erros)) {
    echo '<div class="message-error">';
    foreach ($erros as $erro) {
        echo $erro . "<br/>";
    }
    echo '</div>';
}
