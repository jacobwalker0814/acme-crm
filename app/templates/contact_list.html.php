<h1>Contacts</h1>
<div class="row-fluid">
    <div class="well span3" id="contact-list">
        <ul class="nav nav-list">
            <li class="nav-header">Current Contacts</li>
            <?php foreach($contacts as $contact) { ?>
                <li><a href="/myapp/contact/view/<?php echo $contact->getData("id"); ?>"><?php echo $contact->getData("name"); ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="well span9">
        <?php if (isset($current_contact)) { ?>
        <dl>
            <dt>Name</dt>
            <dd><?php echo $current_contact->getData("name"); ?></dd>
            <dt>Email</dt>
            <dd><?php echo $current_contact->getData("email"); ?></dd>
        </dl>
        <?php } else { ?>
            <h3>Select A Contact</h3>
        <?php } ?>
    </div>
</div>
