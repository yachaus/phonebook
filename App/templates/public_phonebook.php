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
                                    <?php foreach ($contact->numbers as $number):
                                        if ($number->publish == 2):
                                        ?>
                                        <div>
                                            <?= $number->number; ?>
                                        </div>
                                    <?php
                                        endif;
                                        endforeach;
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div class="column text">
                                    <div class="orange2">
                                        Emails
                                    </div>
                                    <?php foreach ($contact->emails as $email):
                                        if ($email->publish == 2):
                                        ?>
                                        <div>
                                            <?= $email->email; ?>
                                        </div>
                                    <?php
                                        endif;
                                        endforeach;
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </h3>
            <hr id="hr<?= $contact->id; ?>" style="display: block">
        <?php
        endif;
        endforeach;
        ?>
</section>