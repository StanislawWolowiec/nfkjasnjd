<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;

            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        a {
            color: blue;
            font-weight: bold;
        }

        main {
            width: 700px;
            height: 700px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 15px;
        }

        header {
            width: 100%;
            height: 30px;
            margin-bottom: 1rem;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;

            background-color: lightgray;
            border-bottom: 5px solid grey;
        }

        .panel {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

            background-color: lightgray;
            border: 5px solid grey;
            border-radius: 5px;

            padding: 10px;
        }

        .inpanel {
            height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <header>
        <a href="biblioteka.php">bibiloteka</a>
    </header>
    <?php
    if (isset($_GET["customStatus"])) {
        if ($_GET["customStatus"] !== null) {
            print ("<h1>" . $_GET["customStatus"] . "</h1>");
        } else {
            print ("<h1>Nie udało się</h1>");
        }
    }
    ?>
    <main>
        <div class="panel">
            <h1>Dodaj dane</h1>
            <div class="inpanel">
                <h2>Losowe</h2>
                <form action="skrypty/dodawanie.php" method="POST">
                    <input type="hidden" name="autoLos" value="true">
                    <span style="align-self: flex-start;"><input type="radio" name="autoLosTyp" value="zapisany"> Użyj
                        zapisanego
                        produktu</span>
                    <span style="align-self: flex-start;"><input type="radio" name="autoLosTyp" value="nowy"> Wyszukaj
                        nowego</span>
                    <span><input type="number" name="autoLosIle" value="1" style="width: 10%;"> Ile razy</span>
                    <input type="submit" value="Wyślij">
                </form>
                <h2>Manualnie</h2>
                <form action="skrypty/dodawanie.php" method="POST">
                    <input type="hidden" name="manLos" value="true">
                    <span>URL: <input type="text" name="manLosUrl" value="<?php if (isset($_GET['returnUrl'])) {
                        print ($_GET['returnUrl']);
                    } ?>"></span>
                    <span>
                        <button name="manLosTyp" value="nowy" type="submit">wylosuj nowe</button>
                        <button name="manLosTyp" value="zapisany" type="submit">wylosuj zapisane</button>
                    </span>
                    <button name="manLosTyp" type="submit" value="wyslij">Wyślij</button>
                    </form>
                    </div>
                    </div>
                    <div class="panel">
                        <h1>Wyczyść bazę</h1>
                        <div class="inpanel">
                            <form action="skrypty/dodawanie.php" method="post">
                                <button name="usunBaza" type="submit" value="zaladowane">Wyczyść Załadowane</button>
                                <button name="usunBaza" type="submit" value="zapisane">Wyczyśc Zapisane</button>
                            </form>
            </div>
        </div>
        <div class="panel">
            <h1>Wyświetl Bazę</h1>
            <div class="inpanel">

            </div>
        </div>
        <div class="panel">
            <div class="inpanel">

            </div>
        </div>
    </main>
</body>

</html>