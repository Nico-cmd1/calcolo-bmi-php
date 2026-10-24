<?php
// 1. Inizializziamo le variabili
$nome = "";
$peso = 0;
$altezzaCm = 0;
$bmi = 0;
$classeFascia = "";
$nomeFascia = "";
$errore = "";
$mostraForm = true;

// 2. Se l'utente ha inviato il modulo con il tasto "Calcola"
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prendiamo i dati inviati dal form
    $nome = $_POST['nome'];
    $peso = $_POST['peso'];
    $altezzaCm = $_POST['altezza'];

    // 3. Controllo sui dati inseriti
    if ($nome == "") {
        $errore = "Per favore, inserisci il tuo nome.";
    } elseif ($peso <= 10 || $peso>=635) {
        $errore = "Il peso deve essere compreso tra 10 e 635";
    } elseif ($altezzaCm <= 54 || $altezzaCm>=272) {
        $errore = "L'altezza deve essere compresa tra 54 e 272";
    } else {
        
        // 4. Calcolo del BMI con la tua formula originale
        $altezzaM = $altezzaCm / 100;
        $bmi = round($peso / ($altezzaM * $altezzaM), 1);

        // 5. Determiniamo la fascia di peso
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

        // Mostriamo la schermata del risultato
        $mostraForm = false;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatore BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php if ($mostraForm) { echo 'page-form'; } else { echo 'page-result'; } ?>">

    <?php if ($mostraForm) { ?>

        <!-- SCHERMATA FORM -->
        <main>
            <h1 class="titolo-pagina">Calcolatore BMI</h1>

            <div class="card">

                <!-- Mostra l'errore solo se esiste -->
                <?php if ($errore != "") { ?>
                    <div class="messaggio-errore">
                        <?php echo $errore; ?>
                    </div>
                <?php } ?>

                <form action="index.php" method="POST">
                    <div class="rigaForm">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" placeholder="Inserisci il tuo nome" value="<?php echo $nome; ?>" required>
                    </div>

                    <div class="rigaForm">
                        <label for="peso">Peso (kg)</label>
                        <input id="peso" type="number" step="0.1" name="peso" placeholder="Es. 70" value="<?php if ($peso > 0) { echo $peso; } ?>" required>
                    </div>

                    <div class="rigaForm">
                        <label for="altezza">Altezza (cm)</label>
                        <input id="altezza" type="number" step="0.1" name="altezza" placeholder="Es. 175" value="<?php if ($altezzaCm > 0) { echo $altezzaCm; } ?>" required>
                    </div>

                    <button type="submit" class="btn-calcola">Calcola</button>
                </form>
            </div>
        </main>

    <?php } else { ?>

        <!-- SCHERMATA RISULTATO -->
        <div class="titolo-bmi">Il tuo BMI</div>

        <div class="box-risultato <?php echo $classeFascia; ?>">
            <div class="testo-nome"><?php echo $nome; ?></div>
            <div class="testo-dettagli">Peso <?php echo $peso; ?> kg | Altezza <?php echo $altezzaCm; ?> cm</div>
            <div class="testo-valore-bmi"><?php echo $bmi; ?></div>
            <div class="testo-fascia"><?php echo $nomeFascia; ?></div>
        </div>

        <a href="index.php" class="link-ricalcola">Calcola di nuovo</a>

    <?php } ?>

</body>
</html>