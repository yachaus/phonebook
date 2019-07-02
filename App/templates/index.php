<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" resource="" href="/phonebook/App/templates/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Phonebook</title>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>
</head>
<body class="layout">
<div class="header">Phonebook</div>
<div class="tabs">
    <div class="tab">
        <input type="radio" id="tab1" name="tab-group" checked>
        <label for="tab1" class="tab-title">Public Phonebook</label>
        <section class="tab-content menu">
            <?php
                foreach ($contacts as $contact):
                    if ($contact->publish == true):
            ?>
            <h3>
                <?= $contact->firstname;?> <?= $contact->lastname;?>
                <a href="#" class="link"
                   onclick="show(this)" id="view<?=$contact->id;?>" style="display: block">View details</a>
                <a href="#" class="link"
                   onclick="hide(this)" id="hide<?=$contact->id;?>" style="display: none">Hide details</a>
                <div style="display: none;" class="details" id="dropdown<?=$contact->id;?>">
                    <table>
                        <tr style="vertical-align: top;">
                            <td>
                                <div class="column text">
                                    <div class="orange2">
                                        Adress
                                    </div>
                                    <div><?=$contact->address;?></div>
                                    <div><?=$contact->country;?></div>
                                    <div><?=$contact->city;?></div>
                                </div>
                            </td>
                            <td>
                                <div class="column text">
                                    <div class="orange2">
                                        Phone Numbers
                                    </div>
                                    <?php foreach ($contact->numbers as $number): ?>
                                        <div>
                                            <?= $number->number; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            <td>
                                <div class="column text">
                                    <div class="orange2">
                                        Emails
                                    </div>
                                    <?php foreach ($contact->emails as $email): ?>
                                        <div>
                                            <?= $email->email; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </h3>
            <hr id="hr<?=$contact->id;?>" style="display: block">
            <?php endif; endforeach;?>
        </section>
    </div>
    <div class="tab">
        <input type="radio" id="tab2" name="tab-group" <?= (isset($login_tab)) ? 'checked' : ''?>>
        <label for="tab2" class="tab-title">Login</label>
        <section class="tab-content">
            <div class="login">
                <div class="form">
                    <form method="post" action="/phonebook/MyContact">
                        <label for="username">
                            Username
                        </label>
                        </br>
                        <input type="text" name="login" placeholder="Username" size="30" required>
                    </br>
                        <label style="padding-top:20px;" for="password">
                            Password
                        </label>
                        </br>
                        <input type="password" name="password" placeholder="Password" size="30" required>
                        </br>
                        <button type="submit" name="button" class="button">LOGIN</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
<script>
    function show(element){
        var id = element.id;
        id = id.substr(-1,1);
        $(function(){$('#view'+id).hide(); $('#dropdown'+id).slideToggle('fast');
            $('#hide'+id).show(); $('#hr'+id).slideToggle('fast');});
    }

    function hide(element) {
        var id = element.id;
        id = id.substr(-1,1);
        $(function(){$('#dropdown'+id).slideToggle('fast'); $('#view'+id).show();
            $('#hide'+id).hide(); $('#hr'+id).slideToggle('fast');});
    }
</script>
</html>
