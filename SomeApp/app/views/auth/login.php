<?php require_once __DIR__ . '/../layout/header.php'; ?>

<main class="container mx-auto px-6 pb-10 pt-6 flex-grow flex items-center justify-center">
    <div class="w-full max-w-md bg-white/85 backdrop-blur-sm border border-sky-100 rounded-3xl shadow-lg p-8">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-semibold text-sky-500">Přihlášení</h2>
            <p class="text-sky-400 mt-2 text-sm">Vítejte zpět v naší Knihovně.</p>
        </div>

        <form action="<?= BASE_URL ?>/index.php?url=auth/authenticate" method="post" class="space-y-6">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-sky-700">E-mail</label>
                <input type="email" id="email" name="email" required autofocus
                       class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-sky-700">Heslo</label>
                <input type="password" id="password" name="password" required
                       class="w-full rounded-2xl bg-sky-50 border border-sky-200 px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-300">
            </div>

            <button type="submit"
                    class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-full shadow-sm font-medium transition">
                Přihlásit se
            </button>

            <p class="text-sm text-slate-500 text-center">
                Nemáte ještě účet?
                <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="text-emerald-600 hover:underline">Zaregistrujte se</a>.
            </p>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>