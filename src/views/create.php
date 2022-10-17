<?php

use Carandev\Todo\models\Todo;

if (count($_POST) > 0) {
  $title = $_POST['title'];
  $content = $_POST['content'];

  if (trim($title) != '' && trim($content) != '') {
    $todo = new Todo($title, $content);
    $todo->save();

    header('Location: http://localhost/~carandev/todo/');
  } else {
    $error = 'Campos vacíos';
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create new TODO</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php require 'templates/header.php' ?>
  <form action="?view=create" method="post" class="flex flex-col items-start gap-4 p-8 w-fit m-auto">
    <span class="bg-red-400 self-center text-center text-slate-100 rounded-lg"><?php echo $error ?></span>
    <label class="flex flex-col gap-4 w-full">
      Title
      <input type="text" name="title" required class="border border-slate-600 rounded-lg focus:outline-none focus:border-cyan-500 p-2 w-full">
    </label>
    <label class="flex flex-col gap-4">
      Content
      <textarea name="content" cols="30" rows="10" required class="border border-slate-600 resize-none rounded-lg focus:outline-none focus:border-cyan-500 p-2"></textarea>
    </label>
    <button class="self-center bg-yellow-500 hover:bg-yellow-400 transition-colors px-4 py-2 rounded-lg">Create todo</button>
  </form>
</body>

</html>