<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto px-6 pb-10 pt-6 flex-grow">
    <div class="max-w-4xl mx-auto bg-white/85 backdrop-blur-sm border border-sky-100 rounded-3xl shadow-lg p-8">
        <h2 class="text-3xl font-semibold text-sky-500 mb-8">
            Přidat knihu
        </h2>

        <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="_title" class="block mb-2 text-sm font-medium text-sky-700">Jméno knihy *</label>
                    <input placeholder="Např. Hamlet" id="_title" name="title" type="text" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_author" class="block mb-2 text-sm font-medium text-sky-700">Autor *</label>
                    <input placeholder="Např. William Shakespeare" type="text" id="_author" name="author" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_category" class="block mb-2 text-sm font-medium text-sky-700">Kategorie</label>
                    <input placeholder="Např. Drama" type="text" id="_category" name="category"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_subcategory" class="block mb-2 text-sm font-medium text-sky-700">Sub-kategorie</label>
                    <input placeholder="Např. Tragédie" type="text" id="_subcategory" name="subcategory"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_year" class="block mb-2 text-sm font-medium text-sky-700">Rok vydání</label>
                    <input placeholder="1603" type="number" id="_year" name="year"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_price" class="block mb-2 text-sm font-medium text-sky-700">Cena</label>
                    <input placeholder="299.90" type="number" step="0.01" id="_price" name="price"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_isbn" class="block mb-2 text-sm font-medium text-sky-700">ISBN</label>
                    <input placeholder="978-80-123456-7" type="text" id="_isbn" name="isbn"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="_link" class="block mb-2 text-sm font-medium text-sky-700">Odkaz</label>
                    <input placeholder="https://..." type="text" id="_link" name="link"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>

            <div>
                <label for="_description" class="block mb-2 text-sm font-medium text-sky-700">Popis</label>
                <textarea id="_description" name="description" rows="5"
                          class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300"></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-sky-700">Obrázky knihy</label>

                <div class="w-full">
                    <label for="images"
                        class="flex flex-col items-center justify-center w-full h-28 rounded-3xl border-2 border-dashed border-sky-200 bg-sky-50 cursor-pointer hover:bg-sky-100 transition">
                        <div class="flex flex-col items-center justify-center px-4 text-center">
                            <span id="file-title" class="text-sm font-semibold text-sky-600">
                                Klikni pro výběr souborů
                            </span>
                            <span id="file-info" class="text-xs text-sky-400 mt-1">
                                Žádné soubory nebyly vybrány
                            </span>
                        </div>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                    </label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-cyan-300 hover:bg-cyan-400 text-white px-5 py-3 rounded-full shadow-sm font-medium transition">
                    Uložit knihu
                </button>

                <a href="<?= BASE_URL ?>/index.php"
                   class="bg-sky-100 hover:bg-sky-200 text-sky-700 px-5 py-3 rounded-full shadow-sm font-medium transition">
                    Zrušit
                </a>
            </div>
        </form>
            <script>
                const fileInput = document.getElementById('images');
                const fileTitle = document.getElementById('file-title');
                const fileInfo = document.getElementById('file-info');

                if (fileInput && fileTitle && fileInfo) {
                    fileInput.addEventListener('change', function(event) {
                        const files = event.target.files;

                        if (files.length === 0) {
                            fileTitle.textContent = 'Klikni pro výběr souborů';
                            fileTitle.className = 'text-sm font-semibold text-sky-600';
                            fileInfo.textContent = 'Žádné soubory nebyly vybrány';
                        } else if (files.length === 1) {
                            fileTitle.textContent = 'Soubor připraven';
                            fileTitle.className = 'text-sm font-semibold text-cyan-500';
                            fileInfo.textContent = files[0].name;
                        } else {
                            fileTitle.textContent = 'Soubory připraveny';
                            fileTitle.className = 'text-sm font-semibold text-cyan-500';
                            fileInfo.textContent = 'Vybráno celkem: ' + files.length + ' souborů';
                        }
                    });
                }
        </script>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>