<?php
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
?>
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