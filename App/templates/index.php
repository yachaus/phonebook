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
<script src="App/templates/script.js">
</script>
</html>
