<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail knihy</title>
</head>
<body>
    <header>
        <h1>Detail knihy</h1>

        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Seznam knih</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">Přidat novou knihu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2><?= htmlspecialchars($book['title']) ?></h2>

        <p><strong>ID:</strong> <?= htmlspecialchars($book['id']) ?></p>
        <p><strong>Název:</strong> <?= htmlspecialchars($book['title']) ?></p>
        <p><strong>Autor:</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p><strong>Kategorie:</strong> <?= htmlspecialchars($book['category'] ?? '') ?></p>
        <p><strong>Subkategorie:</strong> <?= htmlspecialchars($book['subcategory'] ?? '') ?></p>
        <p><strong>Rok vydání:</strong> <?= htmlspecialchars($book['year'] ?? '') ?></p>
        <p><strong>Cena:</strong> <?= htmlspecialchars($book['price'] ?? '') ?></p>
        <p><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn'] ?? '') ?></p>
        <p><strong>Popis:</strong> <?= nl2br(htmlspecialchars($book['description'] ?? '')) ?></p>
        <p><strong>Odkaz:</strong>
            <?php if (!empty($book['link'])): ?>
                <a href="<?= htmlspecialchars($book['link']) ?>" target="_blank" rel="noopener noreferrer">
                    <?= htmlspecialchars($book['link']) ?>
                </a>
            <?php else: ?>
                —
            <?php endif; ?>
        </p>

        <div>
            <strong>Obrázky:</strong>
            <?php
                $images = [];
                if (!empty($book['images'])) {
                    $decoded = json_decode($book['images'], true);
                    if (is_array($decoded)) {
                        $images = $decoded;
                    }
                }
            ?>

            <?php if (!empty($images)): ?>
                <ul>
                    <?php foreach ($images as $image): ?>
                        <li><?= htmlspecialchars($image) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Žádné obrázky.</p>
            <?php endif; ?>
        </div>

        <p>
            <a href="<?= BASE_URL ?>/index.php">← Zpět na seznam knih</a>
        </p>
    </main>
</body>
</html>