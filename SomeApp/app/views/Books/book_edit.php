<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto px-6 pb-10 pt-6 flex-grow">
    <div class="max-w-4xl mx-auto bg-white/85 backdrop-blur-sm border border-sky-100 rounded-3xl shadow-lg p-8">

        <h2 class="text-3xl font-semibold text-sky-500 mb-2">
            Upravit knihu
        </h2>

        <p class="text-sky-400 mb-8">
            Upravujete knihu:
            <strong class="text-sky-600"><?= htmlspecialchars($book['title']) ?></strong>
        </p>

        <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post" enctype="multipart/form-data" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">ID v databázi</label>
                    <input type="text" value="<?= htmlspecialchars($book['id']) ?>" readonly
                           class="w-full rounded-2xl bg-slate-100 border border-sky-100 px-4 py-3 text-slate-500">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">Název knihy *</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">Autor *</label>
                    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">ISBN</label>
                    <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">Kategorie</label>
                    <input type="text" name="category" value="<?= htmlspecialchars($book['category'] ?? '') ?>"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">Podkategorie</label>
                    <input type="text" name="subcategory" value="<?= htmlspecialchars($book['subcategory'] ?? '') ?>"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">Rok vydání</label>
                    <input type="number" name="year" value="<?= htmlspecialchars($book['year'] ?? '') ?>"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-sky-700">Cena</label>
                    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($book['price'] ?? '') ?>"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-sky-700">Odkaz</label>
                    <input type="text" name="link" value="<?= htmlspecialchars($book['link'] ?? '') ?>"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3">
                </div>

            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-sky-700">Popis</label>
                <textarea name="description" rows="5"
                          class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3"><?= htmlspecialchars($book['description'] ?? '') ?></textarea>
            </div>

            <?php
                $existingImages = [];

                if (!empty($book['images'])) {
                    $decoded = json_decode($book['images'], true);
                    if (is_array($decoded)) {
                        $existingImages = $decoded;
                    }
                }
            ?>

            <div>
                <label class="block mb-2 text-sm font-medium text-sky-700">Obrázky</label>

                <?php if (!empty($existingImages)): ?>
                    <div class="mb-4 bg-sky-50 border border-sky-100 rounded-2xl p-4">

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <?php foreach ($existingImages as $image): ?>
                                <div class="relative group bg-white rounded-2xl p-2 border border-sky-100">

                                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($image) ?>"
                                         class="w-full h-32 object-cover rounded-xl">

                                    <a href="<?= BASE_URL ?>/index.php?url=book/deleteImage/<?= $book['id'] ?>/<?= urlencode($image) ?>"
                                       onclick="return confirm('Smazat obrázek?')"
                                       class="absolute top-2 right-2 bg-rose-400 text-white text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition">
                                        ✕
                                    </a>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-sky-200 bg-sky-50 rounded-3xl cursor-pointer hover:bg-sky-100 transition">
                    <span id="file-title" class="text-sm text-sky-600 font-semibold">
                        Klikni pro výběr souborů
                    </span>
                    <span id="file-info" class="text-xs text-sky-400">
                        Žádné soubory
                    </span>

                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-cyan-300 hover:bg-cyan-400 text-white px-5 py-3 rounded-full">
                    Uložit
                </button>

                <a href="<?= BASE_URL ?>/index.php"
                   class="bg-sky-100 hover:bg-sky-200 px-5 py-3 rounded-full">
                    Zrušit
                </a>
            </div>

        </form>

    </div>
</main>

<script>
const input = document.getElementById('images');
const title = document.getElementById('file-title');
const info = document.getElementById('file-info');

input.addEventListener('change', (e) => {
    const files = e.target.files;

    if (files.length === 0) {
        title.textContent = 'Klikni pro výběr souborů';
        info.textContent = 'Žádné soubory';
    } else if (files.length === 1) {
        title.textContent = 'Soubor připraven';
        info.textContent = files[0].name;
    } else {
        title.textContent = 'Soubory připraveny';
        info.textContent = files.length + ' souborů';
    }
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>