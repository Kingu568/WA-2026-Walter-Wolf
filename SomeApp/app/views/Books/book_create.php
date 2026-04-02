<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidání knihy</title>
</head>
<body>
    <header>
        <h1>Přidej knihu</h1>

        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Seznam knih (Domů)</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">Přidat novou knihu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div>
            <p>Vyplň údaje a ulož knihu do databáze.</p>
        </div>

        <div>
            <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data">
                <div>

                    <div>
                        <label for="_title">Jméno knihy <span>*</span></label>
                        <input placeholder="Např. Hamlet" id="_title" name="title" type="text" required>
                    </div>

                    <div>
                        <label for="_author">Autor <span>*</span></label>
                        <input placeholder="Např. William Shakespeare" type="text" id="_author" name="author" required>
                    </div>

                    <div>
                        <label for="_category">Kategorie</label>
                        <input placeholder="Např. Drama" type="text" id="_category" name="category">
                    </div>

                    <div>
                        <label for="_subcategory">Sub-kategorie</label>
                        <input placeholder="Např. Tragédie" type="text" id="_subcategory" name="subcategory">
                    </div>

                    <div>
                        <label for="_year">Rok vydání</label>
                        <input placeholder="1603" type="number" id="_year" name="year">
                    </div>

                    <div>
                        <label for="_price">Cena</label>
                        <input placeholder="299.90" type="number" step="0.01" id="_price" name="price">
                    </div>

                    <div>
                        <label for="_isbn">ISBN</label>
                        <input placeholder="978-80-123456-7" type="text" id="_isbn" name="isbn">
                    </div>

                    <div>
                        <label for="_link">Odkaz</label>
                        <input placeholder="https://..." type="text" id="_link" name="link">
                    </div>

                    <div>
                        <label for="_description">Popis</label>
                        <textarea id="_description" name="description" rows="4"></textarea>
                    </div>

                    <div>
                        <label for="_images">Obrázky (zatím neřešíme)</label>
                        <input type="file" id="_images" name="images[]" multiple>
                    </div>

                </div>

                <div>
                    <p>Po vyplnění formulář odešli tlačítkem níže.</p>
                    <button type="submit">Uložit knihu</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>