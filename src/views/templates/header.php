<?php
$view = isset($_GET['view']) ? $_GET['view'] : 'Home'

?>

<header class="bg-slate-800 h-16 p-4 flex justify-between">
    <h1 class="text-yellow-400 text-xl"><?php echo strtoupper($view) ?></h1>
    <nav>
        <ul class="flex gap-4 text-cyan-500 font-bold text-base">
            <li class="hover:text-cyan-300 transition-colors"><a href="?view=home">Home</a></li>
            <li class="hover:text-cyan-300 transition-colors"><a href="?view=create">Create TODO</a></li>
        </ul>
    </nav>
</header>