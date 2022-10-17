<?php

use Carandev\Todo\models\Todo;

if (count($_GET) > 1) {
  $id = $_GET['id'];

  $todo = Todo::get($id);
}

if (count($_POST) > 0) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $id = $_POST['id'];

  $todo = Todo::get($id);
  $todo->setTitle($title);
  $todo->setContent($content);

  $todo->update();

  header('Location: http://localhost/~carandev/todo/');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $todo->getTitle() ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php require 'templates/header.php' ?>
  <form action="?view=view" method="post" class="flex flex-col items-start gap-4 p-8 w-fit m-auto">
    <label class="flex flex-col gap-4 w-full">
      Title
      <input type="text" name="title" required class="border border-slate-600 rounded-lg focus:outline-none focus:border-cyan-500 p-2 w-full" value="<?php echo $todo->getTitle() ?>">
    </label>
    <input type="hidden" name="id" value="<?php echo $todo->getUuid() ?>">
    <label class="flex flex-col gap-4">
      Content
      <textarea name="content" cols="30" rows="10" required class="border border-slate-600 resize-none rounded-lg focus:outline-none focus:border-cyan-500 p-2"><?php echo $todo->getContent() ?></textarea>
    </label>
    <button class="self-center bg-blue-500 text-slate-200 hover:bg-blue-400 transition-colors px-4 py-2 rounded-lg">Update todo</button>
  </form>
</body>

</html>