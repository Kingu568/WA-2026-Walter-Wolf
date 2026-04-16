<!DOCTYPE html>
<html lang="cs" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Knihovna - Výuková aplikace</title>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-sky-50 via-cyan-50 to-blue-100 text-slate-700">

    <header class="bg-white/80 backdrop-blur-md border-b border-sky-200 shadow-sm">
        <div class="container mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-wide text-sky-500">
                    Aplikace <span class="text-cyan-400">Knihovna</span>
                </h1>
            </div>

            <nav>
                <ul class="flex flex-wrap gap-3 items-center">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php"
                           class="inline-block rounded-full bg-sky-100 px-5 py-2.5 text-sky-700 font-medium shadow-sm hover:bg-sky-200 transition">
                            Seznam knih
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create"
                           class="inline-block rounded-full bg-cyan-300 px-5 py-2.5 text-white font-medium shadow-sm hover:bg-cyan-400 transition">
                            + Přidat knihu
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 pt-8">
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="space-y-3">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php
                        $styles = [
                            'success' => 'bg-emerald-50 border-emerald-300 text-emerald-700',
                            'error'   => 'bg-rose-50 border-rose-300 text-rose-700',
                            'notice'  => 'bg-amber-50 border-amber-300 text-amber-700',
                        ];
                        $style = $styles[$type] ?? 'bg-white border-sky-200 text-slate-700';
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="<?= $style ?> border-l-4 p-4 rounded-2xl shadow-sm">
                            <p class="font-medium text-sm"><?= htmlspecialchars($message) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>
    </div>