<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phonebook</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" resource="" href="/App/templates/styles.css">
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
    </script>
</head>
<body class="layout">
<div class="header" id="example-1" style="cursor:pointer;">
    Phonebook
    <?php if (isset($_SESSION['user_id'])): ?>
        <a class="logout" href="/Phonebook" id="logout">LOGOUT</a>
    <?php endif; ?>
</div>
<div id="content">
    <div class="tabs">
        <div class="tab">
            <a href="/Ajax/PublicPhonebook" class="tab-title" id="tab1">Public Phonebook</a>
        </div>
        <div class="tab">
            <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/Ajax/MyContact" class="tab-title active" id="tab2">My Contact</a>
            <?php else: ?>
            <a href="/Ajax/Login" class="tab-title active"id="tab2">Login</a>
            <?php endif; ?>
        </div>
        <div id="block">
        </div>
    </div>
</div>
<script src="/App/templates/script.js"></script>
</body>
</html>