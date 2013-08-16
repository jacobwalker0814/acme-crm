<h1>Contacts</h1>
<div class="row-fluid">
    <div class="well span3" id="contact-list">
        <ul class="nav nav-list">
            <li><a href="/contacts/0">New Contact</a></li>
            <li class="nav-header">Current Contacts</li>
            <?php foreach($contacts as $contact) { ?>
                <?php $class = isset($current_contact) && $contact->getData("id") == $current_contact->getData("id") ? "active" : ""; ?>
                <li class="<?php echo $class; ?>"><a href="/contacts/<?php echo $contact->getData("id"); ?>"><?php echo $contact->getData("name"); ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="well span9">
        <?php if (isset($success)) { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $success; ?>
        </div>
        <?php } ?>
        <?php if (isset($error)) { ?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $error; ?>
        </div>
        <?php } ?>
        <?php if (isset($current_contact)) { ?>
        <form method="post" class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="input-name">Name</label>
                <div class="controls">
                    <input type="text" autofocus id="input-name" name="input-name" value="<?php echo $current_contact->getData("name"); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input-email">Email</label>
                <div class="controls">
                    <input type="email" pattern="[^ @]*@[^ @]*" id="input-email" name="input-email" value="<?php echo $current_contact->getData("email"); ?>" />
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        <?php } else { ?>
        <h3>Select A Contact</h3>
        <?php } ?>
    </div>
</div>
