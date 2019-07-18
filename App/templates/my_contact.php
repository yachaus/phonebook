<section class="tab-content">
    <div class="admintab">
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
        <form method="post" action="/Phonebook/MyContact" class="myContact">
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
                            <option value="<?= $country->name ?>"
                                <?= ($country->name == $user->country) ? 'selected' : '' ?>>
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
                            <input name="number_<?= $number->id ?>" type="text" value="<?= $number->number ?>"
                                   size="18" <?= ($number->id == 1) ? 'required' : ''; ?>
                                   pattern="((\+380|0)[0-9]{9})" title="Input valid phone number!">
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
                <input type="hidden" name="id" value="<?= $user->id ?>">
                <button type="submit" name="button" class="submit">SAVE</button>
            </div>
        </form>
    </div>
</section>
