<?php

session_start();

require_once('../core/helper.php');

// REDIRECTION: NON CONNECTÉ
if (!isset($_SESSION['nom']) && !isset($_SESSION['prenom']) && !isset($_SESSION['id_user'])) {

    header('Location: /index.php');
    exit();
}


// fonction recherche les infos des acteurs dans la bdd
function searchActeurs($bdd)
{

    $req_data_acteur = $bdd->prepare('SELECT *, SUBSTR(description, 1, 135) AS firstLineDescription FROM acteur');
    $req_data_acteur->execute();

    while ($dataPartenaires = $req_data_acteur->fetch()) {

        echo '<li class="acteur_seul">';
        echo $dataPartenaires['logo'];
        echo '<h3>' . $dataPartenaires['acteur'] . '</h3>';
        echo '<div class="acteur-seul_description"><p>' . $dataPartenaires['firstLineDescription'] . ' (...)</p></div>';
        echo '<a href="/espace-membre/partenaire.php?id_acteur=' . $dataPartenaires['id_acteur'] . ' ">Lire la suite</a> ';
        echo '</li>';
    }
    $req_data_acteur->closeCursor();
}


// CONNECTÉ:
if (isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['id_user'])) {

    require_once('../layout/header.php');
    

    /* 	------------------------------------------------ HTML ACCUEIL ------------------------------------------------ */
    ?>

    <main>
    
        <!-- Section Présentation GBAF -->
        <section class="GBAF">
            <h1>GBAF (Groupement Banque Assurance Français)</h1>

            <div class="text">
                <p>
                    <strong>
                        Le Groupement Banque Assurance Français (GBAF)
                    </strong>
                    est une fédération représentant les 6 grands groupes
                    français :
                </p>
                <ul>
                    <li>BNP Paribas</li>
                    <li>BPCE</li>
                    <li>Crédit Agricole</li>
                    <li>Crédit Mutuel-CIC</li>
                    <li>Société Générale</li>
                    <li>La Banque Postale</li>
                </ul>
                <p>
                    Même s’il existe une forte concurrence entre ces
                    entités, elles vont toutes travailler de la même façon
                    pour gérer près de 80 millions de comptes sur le
                    territoire national. <br />Le GBAF est le représentant
                    de la profession bancaire et des assureurs sur tous  les
                    axes de la réglementation financière française. Sa
                    mission est de promouvoir l'activité bancaire à
                    l’échelle nationale. C’est aussi un interlocuteur
                    privilégié des pouvoirs publics.
                </p>
                <br />
                <p>
                    Les produits et services bancaires sont nombreux et très
                    variés. Afin de renseigner au mieux les clients, les
                    salariés des 340 agences des banques et assurances en
                    France (agents, chargés de clientèle, conseillers
                    financiers, etc.) recherchent sur Internet des
                    informations portant sur des produits bancaires et des
                    financeurs, entre autres. <br />Aujourd’hui, il n’existe
                    pas de base de données pour chercher ces informations
                    de manière fiable et rapide ou pour donner son avis sur
                    les partenaires et acteurs du secteur bancaire, tels que
                    les associations ou les financeurs solidaires. Pour
                    remédier à cela, le GBAF souhaite proposer aux salariés
                    des grands groupes français un point d’entrée unique,
                    répertoriant un grand nombre d’informations sur les
                    partenaires et acteurs du groupe ainsi que sur les
                    produits et services  bancaires et financiers.
                    <br />Chaque salarié pourra ainsi poster un commentaire
                    et donner son avis.
                </p>
                <p>
                    Le but du projet est donc de développer un extranet
                    donnant accès à ces  informations.
                </p>
            </div>

            <div class="GBAF-illustration">
                <img src="/images/GBAF.png" alt="Logo GBAF" />
            </div>
        </section>

        <!-- Section présentation Acteurs / Partenaires -->
        <section class="acteurs">
            <h2>Acteurs et partenaires du système bancaire français</h2>

            <p class="text">texte acteurs et partenaires</p>

            <nav class="acteurs_list">
                    <ul>
                        <!-- <li> acteur_seul-->
                        <?php searchActeurs($bdd); ?>
                    </ul>  
            </nav>
        </section>
    </main>

    <?php

    require_once('../layout/footer.php');
}
?>