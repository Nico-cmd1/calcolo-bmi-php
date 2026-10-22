<?php

$nome='';
$peso=0;
$altezzaCm=0;

$altezzaM=0;
$bmi=0;

$classeFascia='';
$nomeFascia='';




if($_SERVER["REQUEST_METHOD"] == "POST"){
    // 1. Recupero dati inviati dal form
$nome = $_POST['nome'];
$peso = $_POST['peso'];
$altezzaCm = $_POST['altezza'];


// 2. Calcolo del BMI
$altezzaM = $altezzaCm / 100;
$bmi = round($peso / ($altezzaM * $altezzaM), 1);
//round è una funzione che taglia in questo caso i decimali dopo la virgla
//lasciandone 1 arrotondando per eccesso

// 3. Selezione della fascia e della classe CSS
// nomeFascia è la scritta che apparre nel box
// classeFascia è la classe css relativa alla fascia (sottopeso\normopeso\sovrappeso\obesita)
if ($bmi < 18.5) {
    $classeFascia = "sottopeso";
    $nomeFascia = "Sottopeso";
} elseif ($bmi <= 24.9) {
    $classeFascia = "normopeso";
    $nomeFascia = "Normopeso";
} elseif ($bmi <= 29.9) {
    $classeFascia = "sovrappeso";
    $nomeFascia = "Sovrappeso";
} else {
    $classeFascia = "obesita";
    $nomeFascia = "Obesità";
}
}else{

}

?>




<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatore BMI</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f1f3f5;
            color: #1f2328;
            font-family: sans-serif;
            min-height: 100vh;
            display: flex;
            /*Attiva la scatola intelligente e permette di usare altri comandi*/
            align-items: center;
            justify-content: center;
        }

        main {
            margin-top: 175px;
            margin-bottom: 114px;
            margin-left: 60px;
            margin-right: 60px;
        }

        .titolo-pagina {
            text-align: center;
            /* Centra il testo all'interno della sua scatola */
            margin-bottom: 24px;
            /* Esattamente 24px di distanza sopra la card */
            margin-top: 0;
            /* Rimuove lo spazio bianco di default in alto */
            width: 100%;
            /* Occupa tutta la larghezza a disposizione */

            /* Stile del testo */
            font-size: 28px;
            color: #1f2328;
        }

        .card {
            background-color: #ffffff;
            width: 360px;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            /*spost. lat obrma/spost. vert ombra/raggio sfumatura/0 0 0 nero/opacita*/
            text-align: center;
        }

        .card form {
            display: flex;
            flex-direction: column;
            gap: 16px;
            /*Definisce lo spazio vuoto tra gli elementi*/
        }

        .rigaForm {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .rigaForm label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #1f2328;
        }

        .rigaForm input[type="text"],
        .rigaForm input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        .btn-calcola {
            width: 100%;
            background-color: #1f2328;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }
    </style>
</head>

<body>

<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
?>




    <main>

        <h1 class="titolo-pagina">Calcolatore BMI</h1>

        <div class="card">
            <form action="calcolo-bmi.php" method="POST">
                <div class="rigaForm">
                    <label for="nome">Nome</label>
                    <input id="nome" type="text" name="nome" placeholder="Inserisci il tuo nome" required>
                </div>

                <div class="rigaForm">
                    <label for="peso">Peso (kg)</label>
                    <input id="peso" type="number" step="0.1" name="peso" placeholder="Es. 70" required>
                </div>

                <div class="rigaForm">
                    <label for="altezza">Altezza (cm)</label>
                    <input id="altezza" type="number" step="0.1" name="altezza" placeholder="Es. 175" required>
                </div>

                <button type="submit" class="btn-calcola">Calcola</button>
            </form>
        </div>
    </main>



    <?php
    }else{

    ?>

    <div class="titolo-bmi">Il tuo BMI</div>

    <div class="box-risultato <?php echo $classeFascia; ?>">
        <div class="testo-nome"><?php echo $nome; ?></div>
        <div class="testo-dettagli">Peso <?php echo $peso; ?> kg Altezza <?php echo $altezzaCm; ?> cm</div>
        <div class="testo-valore-bmi"><?php echo $bmi; ?></div>
        <div class="testo-fascia"><?php echo $nomeFascia; ?></div>
    </div>

    <a href="index.html" class="link-ricalcola">Calcola di nuovo</a>



    <?php

    }
    ?>



</body>

</html>










<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato BMI</title>
    <style>
        * {
            box-sizing: border-box; 
            /*Il box mantiene la sua grandezza amche aggiungrendo bordi e padding*/
            margin: 0; /*Da distanza tra l'elemento e gli altri elementi*/
            padding: 0; /*Da disatanza dall'interno dell'elemento*/
        }

        body {
            background-color: #f1f3f5;
            color: #1f2328;
            font-family: sans-serif;
            min-height: 100vh; /*Prende tutta l'altezza visibile della pagina*/
            display: flex; /*Abilita il centramento automatico  */
            flex-direction: column; /*Dispone gli elementi in colonna */
            align-items: center; /*Centra la card da sinistra e destra */
            justify-content: center; /*Centra la card dall'alto e dal basso */
        }

        /* Titolo sopra la box */
        .titolo-bmi {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 24px; /* 24px di distacco verso la box sottostante */
            text-align: center;
        }

        /* Box contenitore dei risultati */
        .box-risultato {
            width: 360px;
            border-style: solid;
            border-width: 3px;
            border-radius: 12px;
            text-align: center;
            padding-left: 60px;
            padding-right: 60px;
            padding-top: 27px;  /* Distanza dal bordo superiore della box per il nome */
            padding-bottom: 27px;
            margin-bottom: 24px; /* 24px di distacco verso il link sottostante */
        }

        /* Classi delle 4 fasce di peso */
        .sottopeso {
            background-color: #e3eef9;
            border-color: #2f6fb3;
        }
        .sottopeso .testo-fascia {
            color: #2f6fb3;
        }

        .normopeso {
            background-color: #e3f4e6;
            border-color: #256d34;
        }
        .normopeso .testo-fascia {
            color: #256d34;
        }

        .sovrappeso {
            background-color: #fcebd7;
            border-color: #9a4f06;
        }
        .sovrappeso .testo-fascia {
            color: #9a4f06;
        }

        .obesita {
            background-color: #fbe2e2;
            border-color: #b32d2d;
        }
        .obesita .testo-fascia {
            color: #b32d2d;
        }

        /* Elementi interni alla box */
        .testo-nome {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px; /* 8px dal nome al peso/altezza */
        }

        .testo-dettagli {
            font-size: 14px;
            margin-bottom: 16px; /* 16px dai dettagli al BMI */
        }

        .testo-valore-bmi {
            font-size: 32px; /* Scritta in grande */
            font-weight: bold;
            margin-bottom: 16px; /* 16px dal BMI alla scritta della fascia */
        }

        .testo-fascia {
            font-size: 18px;
            font-weight: bold;
        }

        /* Link sottostante */
        .link-ricalcola {
            text-decoration: underline;
            font-weight: 500;
            color: #1f2328;
        }
    </style>
</head>
<body>

    <div class="titolo-bmi">Il tuo BMI</div>

    <div class="box-risultato <?php echo $classeFascia; ?>">
        <div class="testo-nome"><?php echo $nome; ?></div>
        <div class="testo-dettagli">Peso <?php echo $peso; ?> kg Altezza <?php echo $altezzaCm; ?> cm</div>
        <div class="testo-valore-bmi"><?php echo $bmi; ?></div>
        <div class="testo-fascia"><?php echo $nomeFascia; ?></div>
    </div>

    <a href="index.html" class="link-ricalcola">Calcola di nuovo</a>

</body>
</html>