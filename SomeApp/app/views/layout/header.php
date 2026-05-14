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

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=book/create"
                            class="inline-block rounded-full bg-cyan-300 px-5 py-2.5 text-white font-medium shadow-sm hover:bg-cyan-400 transition">
                                + Přidat knihu
                            </a>
                        </li>
                        <li class="text-sky-500 text-sm flex items-center gap-2">
                            Ahoj,
                            <span class="font-semibold">
                                <?= htmlspecialchars($_SESSION['user_name']) ?>
                            </span>

                            <?php if (!empty($_SESSION['is_admin'])): ?>
                                <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full border border-amber-200">
                                    ADMIN
                                </span>
                            <?php endif; ?>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/logout"
                            class="inline-block rounded-full bg-rose-100 px-5 py-2.5 text-rose-700 font-medium shadow-sm hover:bg-rose-200 transition">
                                Odhlásit
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/login"
                            class="inline-block rounded-full bg-sky-100 px-5 py-2.5 text-sky-700 font-medium shadow-sm hover:bg-sky-200 transition">
                                Přihlásit
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>/index.php?url=auth/register"
                            class="inline-block rounded-full bg-cyan-300 px-5 py-2.5 text-white font-medium shadow-sm hover:bg-cyan-400 transition">
                                Registrace
                            </a>
                        </li>
                    <?php endif; ?>
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
                        <div class="<?= $style ?> notification border-l-4 p-4 rounded-2xl shadow-sm flex items-start justify-between gap-4 transition-all duration-500">
                            <p class="font-medium text-sm">
                                <?= htmlspecialchars($message) ?>
                            </p>

                            <button
                                type="button"
                                class="close-notification text-lg leading-none opacity-60 hover:opacity-100 transition"
                                aria-label="Zavřít notifikaci"
                            >
                                ×
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function closeNotification(notification) {
                if (!notification) {
                    return;
                }

                notification.classList.add('opacity-0', '-translate-y-2');

                setTimeout(() => {
                    notification.remove();
                }, 500);
            }

            document.querySelectorAll('.close-notification').forEach(button => {
                button.addEventListener('click', () => {
                    closeNotification(button.closest('.notification'));
                });
            });

            document.querySelectorAll('.notification').forEach(notification => {
                setTimeout(() => {
                    closeNotification(notification);
                }, 5000);
            });
        });
    </script>