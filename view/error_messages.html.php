<?php
/** Vérifies que $error_messages existe. Si il existe, c'est qu'il y a des messages d'erreurs à afficher */
if (isset($error_messages)) :
    ?>
    <ul>
        <?php
        /**
         * Parcours le tableau de messages d'erreurs
         *
         * @var string $message Un message d'erreur à afficher
         */
        foreach ($error_messages as $message) :
            ?>
            <li><?= $message ?></li>
        <?php
        endforeach; ?>
    </ul>
<?php
endif; ?>