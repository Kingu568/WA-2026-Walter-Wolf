<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <title>Přidej mi poradnou knihu do databaze twin</title>
</head>
<body>
    <div>
        <h1>
           přidej knihu twin
        </h1>
        <p>
            Twin please... Vyplň údaje a ulož to
        </p>
    </div>
    <div>
        <form action="post">
            <div>
                <div>
                    <label for="_title">Jméno knihy<span>*</span></label>
                    <input placeholder="hiii" id="_title" name="title" type="text" required>
                </div>
                <div>
                    <label for="_author">Autor<span>*</span></label>
                    <input placeholder="Shakespeare twin" type="text" id="_author" name="author" required>
                </div>
                <div>
                    <label for="_category">Kategorie</label>
                    <input placeholder="Banger ig" type="text" id="_category" name="category">
                </div>
                <div>
                    <label for="_s_category">Sub-Kategorie</label>
                    <input placeholder="His writing is fire ?" type="text" id="_s_category" name="s_category">
                </div>
                <div>
                    <label for="_year">Rok vydání</label>
                    <input placeholder="1967" type="number" id="_year" name="year">
                </div>
            </div>
            <div>
                <p>If you wanna save then click me ig, its not like i want you to anyway... baka</p>
                <button type="submit">Uložit twin-kun</button>
            </div>
        </form>
    </div>
</body>
</html>