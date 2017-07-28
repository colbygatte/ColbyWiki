<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wiki!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.4/css/bulma.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar-brand">
        <a class="navbar-item" href="#">
            <strong>
                Wiki
            </strong>
        </a>
    </div>
    
    <div class="navbar-menu">
        <div class="navbar-end">
            <a href="#" class="navbar-item">
                Edit
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <?php template()->yieldSection('body') ?>
</div>
</body>
</html>