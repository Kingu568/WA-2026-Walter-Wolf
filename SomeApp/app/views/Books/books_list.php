<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto px-6 pb-10 pt-6 flex-grow">
    <div class="flex justify-between items-end mb-6">
        <h2 class="text-3xl font-semibold text-sky-500">
            Dostupné knihy
        </h2>
    </div>

    <div class="bg-white/80 backdrop-blur-sm border border-sky-100 rounded-3xl overflow-hidden shadow-lg">
        <?php if (empty($books)): ?>
            <div class="p-10 text-center text-sky-400">
                V databázi se zatím nenachází žádné knihy.
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-sky-100 text-sky-700 text-sm">
                        <tr>
                            <th class="px-5 py-4">ID</th>
                            <th class="px-5 py-4">Název</th>
                            <th class="px-5 py-4">Autor</th>
                            <th class="px-5 py-4">Kategorie</th>
                            <th class="px-5 py-4">Cena</th>
                            <th class="px-5 py-4">Akce</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sky-100">
                        <?php foreach ($books as $book): ?>
                            <tr class="hover:bg-sky-50 transition">
                                <td class="px-5 py-4"><?= htmlspecialchars($book['id']) ?></td>
                                <td class="px-5 py-4 font-semibold text-sky-600"><?= htmlspecialchars($book['title']) ?></td>
                                <td class="px-5 py-4"><?= htmlspecialchars($book['author']) ?></td>
                                <td class="px-5 py-4"><?= htmlspecialchars($book['category'] ?? '—') ?></td>
                                <td class="px-5 py-4"><?= htmlspecialchars($book['price'] ?? '—') ?> czk</td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>"
                                           class="px-3 py-2 rounded-full bg-sky-100 hover:bg-sky-200 text-sky-700 text-sm font-medium transition">
                                            Detail
                                        </a>

                                        <?php if (isset($_SESSION['user_id']) &&((int) $_SESSION['user_id'] === (int) $book['created_by'] || !empty($_SESSION['is_admin']))): ?>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>"
                                               class="px-3 py-2 rounded-full bg-amber-100 hover:bg-amber-200 text-amber-700 text-sm font-medium transition">
                                                Upravit
                                            </a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>"
                                               onclick="return confirm('Opravdu chcete tuto knihu smazat?')"
                                               class="px-3 py-2 rounded-full bg-rose-100 hover:bg-rose-200 text-rose-700 text-sm font-medium transition">
                                                Smazat
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>