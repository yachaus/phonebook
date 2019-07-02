<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="App/templates/styles.css">
    <title>Phonebook</title>
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
    </script>
</head>
<body class="layout">
<div class="header">
    Phonebook
    <a class="logout" href="/phonebook">LOGOUT</a>
</div>
<div class="tabs">
    <div class="tab">
        <input type="radio" id="tab1" name="tab-group">
        <label for="tab1" class="tab-title">Public Phonebook</label>
        <section class="tab-content menu">
            <?php
            foreach ($contacts as $contact):
                if ($contact->publish == 2):
                    ?>
                    <h3>
                        <?= $contact->firstname; ?> <?= $contact->lastname; ?>
                        <a href="#" class="link"
                           onclick="show(this)" id="view<?= $contact->id; ?>" style="display: block">View details</a>
                        <a href="#" class="link"
                           onclick="hide(this)" id="hide<?= $contact->id; ?>" style="display: none">Hide details</a>
                        <div style="display: none;" class="details" id="dropdown<?= $contact->id; ?>">
                            <table>
                                <tr style="vertical-align: top;">
                                    <td>
                                        <div class="column text">
                                            <div class="orange2">
                                                Adress
                                            </div>
                                            <div><?= $contact->address; ?></div>
                                            <div><?= $contact->country; ?></div>
                                            <div><?= $contact->city; ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="column text">
                                            <div class="orange2">
                                                Phone Numbers
                                            </div>
                                            <?php foreach ($contact->numbers as $number): ?>
                                                <?php if ($number->publish == 2): ?>
                                                    <div>
                                                        <?= $number->number; ?>
                                                    </div>
                                                <?php endif; endforeach; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="column text">
                                            <div class="orange2">
                                                Emails
                                            </div>
                                            <?php foreach ($contact->emails as $email): ?>
                                            <?php if ($email->publish == 2) : ?>
                                                <div>
                                                    <?= $email->email; ?>
                                                </div>
                                            <?php endif; endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </h3>
                    <hr id="hr<?= $contact->id; ?>" style="display: block">
                <?php endif; endforeach; ?>
        </section>
    </div>
    <div class="tab">
        <input type="radio" id="tab2" name="tab-group" checked>
        <label for="tab2" class="tab-title">My Contact</label>
        <section class="tab-content">
            <div class="admintab">
                <form method="post" action="MyContact" class="myContact">
                    <div class="top">
                        <div class="orange">
                            CONTACT
                        </div>
                        <div class="orange">
                            PHONE NUMBERS
                        </div>
                        <div class="orange">
                            EMAILS
                        </div>
                    </div>
                    <div class="column">
                        <div>
                            <label for="firstname" class="label">First name *</label>
                            <input name="firstname" type="text" placeholder="First name" size="18" required
                                   value="<?= $user->firstname; ?>" oninput="this.setAttribute('value', this.value);">
                        </div>
                        <div>
                            <label for="lastname" class="label">Last name *</label>
                            <input name="lastname" type="text" placeholder="Last name" size="18" required
                                   value="<?= $user->lastname; ?>">
                        </div>
                        <div>
                            <label for="address" class="label">Address *</label>
                            <input name="address" type="text" placeholder="Address" size="18" required
                                   value="<?= $user->address; ?>">
                        </div>
                        <div>
                            <label for="city" class="label">ZIP/CITY *</label>
                            <input name="city" type="text" placeholder="ZIP/CITY" size="18" required
                                   value="<?= $user->city; ?>">
                        </div>
                        <div>
                            <label for="country" class="label">Country *</label>
                            <select name="country">
                                <?php
                                foreach ($countries as $country) : ?>
                                    <option value="<?= $country->name ?>" <?= ($country->name == $user->country) ? 'selected' : '' ?>>
                                        <?= $country->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="column">
                        <div id="phoneNumbers">
                            <?php foreach ($user->numbers as $number): ?>
                                <div class="section">
                                    <input type="hidden" name="number_publish_<?= $number->id ?>" value="1">
                                    <input type="checkbox" name="number_publish_<?= $number->id ?>"
                                           value="2" <?= (2 == $number->publish) ? 'checked' : ''; ?>>
                                    <div class="phonelabel">Publish Field</div>
                                    <input  name="number_<?= $number->id ?>" type="text" value="<?= $number->number ?>"
                                           size="18" <?= ($number->id == 1) ? 'required' : ''; ?> pattern="((\+380|0)[0-9]{9})" title="Input valid phone number!">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="#" class="addlink" onclick="addNumber();">+ Add</a>
                    </div>
                    <div class="column">
                        <div id="emails">
                            <?php foreach ($user->emails as $email): ?>
                                <div class="section">
                                    <input type="hidden" name="email_publish_<?= $email->id; ?>" value="1">
                                    <input type="checkbox" name="email_publish_<?= $email->id; ?>"
                                           value="2" <?= ($email->publish == 2) ? 'checked' : ''; ?>>
                                    <div class="phonelabel">Publish Field</div>
                                    <input name="email_<?= $email->id; ?>" type="text" value="<?= $email->email; ?>"
                                           size="18" <?= ($number->id == 1) ? 'required' : ''; ?> >
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="#" class="addlink" onclick="addEmail();">+ Add</a>
                    </div>
                    <div class="bottom">
                        <label class="label">* Fields are mandatory</label>
                        <div id="PublishMyContact">
                            <input type="hidden" name="publish" value="1">
                            <input type="checkbox" name="publish"
                                   value="2" <?= ($user->publish == 2) ? 'checked' : ''; ?>>
                            <div class="phonelabel">Publish my contact</div>
                        </div>
                        <input type="hidden" name="save_id" value="<?= $user->id ?>">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit" name="button" class="submit">SAVE</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
</body>
<script>
    function show(element) {
        var id = element.id;
        id = id.substr(-1, 1);
        $(function () {
            $('#view' + id).hide();
            $('#dropdown' + id).slideToggle('fast');
            $('#hide' + id).show();
            $('#hr' + id).slideToggle('fast');
        });
    }

    function hide(element) {
        var id = element.id;
        id = id.substr(-1, 1);
        $(function () {
            $('#dropdown' + id).slideToggle('fast');
            $('#view' + id).show();
            $('#hide' + id).hide();
            $('#hr' + id).slideToggle('fast');
        });
    }

    var counter = document.getElementById('phoneNumbers').children.length;

    function addNumber() {
        counter++;
        var div = document.createElement("div");
        div.className = "section";
        div.innerHTML = "<input type=\"hidden\" name=\"number_publish_" + counter + "\" value=\"1\">\n" +
            "            <input type=\"checkbox\" name=\"number_publish_" + counter + "\" value=\"2\">\n" +
            "            <div class=\"phonelabel\">Publish Field</div>\n" +
        "            <input pattern=\"((\\+380|0)[0-9]{9})\" title=\"Input valid phone number!\" name=\"number_" + counter + "\" type=\"text\" placeholder=\"+1234567890\" size=\"18\">";
        document.getElementById('phoneNumbers').appendChild(div);
    }

    var counter_emails = 2;

    function addEmail() {
        var div = document.createElement("div");
        div.className = "section";
        div.innerHTML = "<input type=\"hidden\" name=\"email_publish_" + counter + "\" value=\"1\">\n" +
            "            <input type=\"checkbox\" name=\"email_publish_" + counter + "\" value=\"2\">\n" +
            "            <div class=\"phonelabel\">Publish Field</div>\n" +
            "            <input name=\"email_" + counter + "\" type=\"text\" placeholder=\"john.s@domen.com\" size=\"18\">";
        document.getElementById('emails').appendChild(div);
        counter++;
    }
</script>
</html>

