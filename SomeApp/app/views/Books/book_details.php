<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto px-6 pb-10 pt-6 flex-grow">
    <div class="max-w-4xl mx-auto bg-white/85 backdrop-blur-sm border border-sky-100 rounded-3xl shadow-lg p-8">
        <div class="flex flex-wrap gap-3 mb-6">
            <a href="<?= BASE_URL ?>/index.php"
               class="bg-sky-100 hover:bg-sky-200 text-sky-700 px-4 py-2 rounded-full font-medium transition">
                ← Zpět
            </a>

            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>"
               class="bg-amber-100 hover:bg-amber-200 text-amber-700 px-4 py-2 rounded-full font-medium transition">
                Upravit
            </a>
        </div>

        <div class="border-b border-sky-100 pb-6 mb-6">
            <h2 class="text-3xl font-semibold text-sky-500">
                <?= htmlspecialchars($book['title']) ?>
            </h2>
            <p class="text-sky-400 mt-2"><?= htmlspecialchars($book['author']) ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-sky-50 rounded-2xl p-4"><strong>ID:</strong> <?= htmlspecialchars($book['id']) ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>Název:</strong> <?= htmlspecialchars($book['title']) ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>Autor:</strong> <?= htmlspecialchars($book['author']) ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>Kategorie:</strong> <?= htmlspecialchars($book['category'] ?? '—') ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>Subkategorie:</strong> <?= htmlspecialchars($book['subcategory'] ?? '—') ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>Rok vydání:</strong> <?= htmlspecialchars($book['year'] ?? '—') ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>Cena:</strong> <?= htmlspecialchars($book['price'] ?? '—') ?></div>
            <div class="bg-sky-50 rounded-2xl p-4"><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn'] ?? '—') ?></div>
        </div>

        <div class="mt-6 bg-sky-50 rounded-2xl p-4">
            <strong class="block mb-2 text-sky-700">Popis:</strong>
            <div class="text-slate-700">
                <?= !empty($book['description']) ? nl2br(htmlspecialchars($book['description'])) : 'Bez popisu.' ?>
            </div>
        </div>

        <div class="mt-6 bg-sky-50 rounded-2xl p-4">
            <strong class="block mb-2 text-sky-700">Odkaz:</strong>
            <?php if (!empty($book['link'])): ?>
                <a href="<?= htmlspecialchars($book['link']) ?>" target="_blank" rel="noopener noreferrer"
                   class="text-cyan-500 hover:underline break-all">
                    <?= htmlspecialchars($book['link']) ?>
                </a>
            <?php else: ?>
                <span class="text-slate-400">—</span>
            <?php endif; ?>
        </div>

        <div class="mt-6 bg-sky-50 rounded-2xl p-4">
            <strong class="block mb-3 text-sky-700">Obrázky:</strong>

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
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($images as $image): ?>
                        <button
                            type="button"
                            class="lightbox-trigger bg-white rounded-2xl p-2 shadow-sm border border-sky-100 cursor-pointer"
                            data-image="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($image) ?>"
                            data-alt="<?= htmlspecialchars($book['title']) ?>"
                        >
                            <img
                                src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($image) ?>"
                                alt="<?= htmlspecialchars($book['title']) ?>"
                                class="w-full h-48 object-cover rounded-xl hover:scale-[1.02] transition"
                            >
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-slate-400">Žádné obrázky.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
    <div
        id="lightbox"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/80 backdrop-blur-sm px-4"
    >
        <div class="relative max-w-5xl w-full flex items-center justify-center">
            <button
                type="button"
                id="lightbox-close"
                class="absolute top-2 right-2 sm:top-4 sm:right-4 bg-white text-slate-700 w-10 h-10 rounded-full text-xl shadow hover:bg-slate-100"
            >×</button>

            <img
                id="lightbox-image"
                src=""
                alt=""
                class="max-h-[85vh] max-w-full rounded-2xl shadow-2xl border border-white/30"
            >
        </div>
    </div>

    <script>
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxClose = document.getElementById('lightbox-close');
        const triggers = document.querySelectorAll('.lightbox-trigger');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const imageSrc = trigger.dataset.image;
                const imageAlt = trigger.dataset.alt || 'Obrázek';

                lightboxImage.src = imageSrc;
                lightboxImage.alt = imageAlt;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            });
        });

        function closeLightbox() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            lightboxImage.src = '';
            lightboxImage.alt = '';
            document.body.classList.remove('overflow-hidden');
        }

        lightboxClose.addEventListener('click', closeLightbox);

        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !lightbox.classList.contains('hidden')) {
                closeLightbox();
            }
        });
    </script>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>