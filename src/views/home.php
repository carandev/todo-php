<?php

use Carandev\Todo\models\Todo;

$todos = Todo::getAll();

if (isset($_GET['delete'])) {
  Todo::deleteByUuid($_GET['delete']);

  header('Location: http://localhost/~carandev/todo/');
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php require 'templates/header.php' ?>
  <main class="h-full flex justify-center items-center flex-col p-8">
    <ul class="flex gap-8 flex-wrap">
      <?php
      if ($todos) {
        foreach ($todos as $todo) {

      ?>
        <li class="bg-slate-300 w-80 border hover:border-cyan-500 relative">
          <a href="?delete=<?php echo $todo->getUuid() ?>" class="flex items-center justify-center bg-red-500 rounded-full w-12 h-12 absolute -right-6 -top-6 text-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <line x1="4" y1="7" x2="20" y2="7" />
              <line x1="10" y1="11" x2="10" y2="17" />
              <line x1="14" y1="11" x2="14" y2="17" />
              <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
              <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
            </svg>
          </a>
          <a class=" flex flex-col gap-4 items-center pb-4" href="?view=view&id=<?php echo $todo->getUuid() ?>">
            <h3 class="p-4 bg-slate-500 w-full text-center text-slate-100 font-bold"><?php echo $todo->getTitle() ?></h3>
            <p class="px-4"><?php echo $todo->getContent() ?></p>
          </a>
        </li>
        <?php
        }
      } else {
        ?>
        </ul>
        <p>There aren't todos</p>
        <a class="bg-yellow-400 px-4 rounded m-4" href="?view=create">Create TODO</a>
      <?php 
        }
      ?>
  </main>
</body>

</html>