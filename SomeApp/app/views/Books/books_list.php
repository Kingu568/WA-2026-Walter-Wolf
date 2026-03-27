<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna - Seznam knih</title>
</head>
<body>
    <header>
        <h1>Aplikace Knihovna</h1>

        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Seznam knih (Domů)</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">Přidat novou knihu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <main>
    <h2>Dostupné knihy</h2>

    <?php if (!empty($books)): ?>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <strong><?= htmlspecialchars($book['title']) ?></strong>
                    — <?= htmlspecialchars($book['author']) ?>
                    <?php if (!empty($book['year'])): ?>
                        (<?= htmlspecialchars($book['year']) ?>)
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>V databázi zatím nejsou žádné knihy.</p>
    <?php endif; ?>
</main>
    </main>

    <footer>
        <p>&copy; WA 2026 - Walter Wolf</p>
    </footer>
</body>
</html>