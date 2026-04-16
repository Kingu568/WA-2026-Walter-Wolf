<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto px-6 pb-10 pt-6 flex-grow flex items-center justify-center">
    <div class="w-full max-w-3xl bg-white/85 backdrop-blur-sm border border-sky-100 rounded-3xl shadow-lg p-8">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-semibold text-sky-500">Nová registrace</h2>
            <p class="text-sky-400 mt-2 text-sm">Vytvořte si účet pro správu vašeho knižního katalogu.</p>
        </div>

        <form action="<?= BASE_URL ?>/index.php?url=auth/storeUser" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <h3 class="text-sm font-semibold text-sky-700 border-b border-sky-100 pb-2">Přihlašovací údaje</h3>
                </div>

                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-sky-700">Uživatelské jméno *</label>
                    <input type="text" id="username" name="username" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-sky-700">E-mail *</label>
                    <input type="email" id="email" name="email" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-sky-700">Heslo *</label>
                    <input type="password" id="password" name="password" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="password_confirm" class="block mb-2 text-sm font-medium text-sky-700">Potvrzení hesla *</label>
                    <input type="password" id="password_confirm" name="password_confirm" required
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div class="md:col-span-2 pt-2">
                    <h3 class="text-sm font-semibold text-sky-700 border-b border-sky-100 pb-2">Osobní údaje (volitelné)</h3>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-sky-700">Křestní jméno</label>
                    <input type="text" id="first_name" name="first_name"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-sky-700">Příjmení</label>
                    <input type="text" id="last_name" name="last_name"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>

                <div class="md:col-span-2">
                    <label for="nickname" class="block mb-2 text-sm font-medium text-sky-700">Přezdívka</label>
                    <input type="text" id="nickname" name="nickname" placeholder="Jak vám máme v aplikaci říkat?"
                           class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-300">
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <button type="submit"
                        class="bg-cyan-300 hover:bg-cyan-400 text-white px-5 py-3 rounded-full shadow-sm font-medium transition">
                    Vytvořit účet
                </button>

                <p class="text-sm text-slate-500 text-center">
                    Už máte účet?
                    <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-sky-600 hover:underline">Přihlaste se zde</a>.
                </p>
            </div>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>