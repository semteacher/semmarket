<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.06.2015
 * Time: 10:35
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

<script type="text/javascript">
        function phoneCheck(thisName, thisValue) {
            if (!document.getElementById("saved_phone_best").value){
                if (thisValue != ''){
                    document.getElementById(thisName).checked = true;
                    document.getElementById("saved_phone_best").value = document.getElementById(thisName).value;
                }
            }

        }
</script>

<section id="content">
<div>
    <span><h2><?php echo $pageheader; ?></h2></span>
</div>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

<form action="<?php echo SITE_ROOT; ?>/contacts/save" method="post" name="editcontact">
    <input type="hidden" value="<?php echo $mode; ?>" name="mode">
    <input type="hidden" value="<?php if(isset($contact)){echo $contact['id_contact'];} ?>" name="contact[id_contact]">
    <input type="hidden" id="saved_phone_best" value="<?php if(isset($contact)){echo $contact['phone_best'];} ?>" name="saved_phone_best">
    <div>
        <label for="contact[fname]">First Name: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['fname'];} ?>" name="contact[fname]" autofocus required>
    </div>
    <div>
        <label for="contact[lname]">Last Name: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['lname'];} ?>" name="contact[lname]" required>
    </div>
    <div>
        <label for="contact[email]">Email: </label>
        <input type="email" value="<?php if(isset($contact)){echo $contact['email'];} ?>" name="contact[email]" required placeholder="A Valid Email Address">
    </div>
    <div>
        <label for="contact[phone_h]">Phone (home): </label>
        <input type="radio" id="contact[phone_h]" value="h" <?php if(isset($contact)){if ($contact['phone_best']=='h'){echo ' checked ';}} ?> name="contact[phone_best]">
        <input type="text" value="<?php if(isset($contact)){echo $contact['phone_h'];} ?>" name="contact[phone_h]" onKeyUp="phoneCheck(this.name, this.value);" >
    </div>
    <div>
        <label for="contact[phone_w]">Phone (work): </label>
        <input type="radio" id="contact[phone_w]" value="w" <?php if(isset($contact)){if ($contact['phone_best']=='w'){echo ' checked ';}} ?> name="contact[phone_best]">
        <input type="text" value="<?php if(isset($contact)){echo $contact['phone_w'];} ?>" name="contact[phone_w]" onKeyUp="phoneCheck(this.name, this.value);">
    </div>
    <div>
        <label for="contact[phone_c]">Phone (cell): </label>
        <input type="radio" id="contact[phone_c]" value="c" <?php if(isset($contact)){if ($contact['phone_best']=='c'){echo ' checked ';}} ?> name="contact[phone_best]">
        <input type="text" value="<?php if(isset($contact)){echo $contact['phone_c'];} ?>" name="contact[phone_c]" onKeyUp="phoneCheck(this.name, this.value);">
    </div>
    <div>
        <label for="contact[address1]">Address 1: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['address1'];} ?>" name="contact[address1]">
    </div>
    <div>
        <label for="contact[address2]">Address 2: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['address2'];} ?>" name="contact[address2]">
    </div>
    <div>
        <label for="contact[city]">City: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['city'];} ?>" name="contact[city]">
    </div>
    <div>
        <label for="contact[state]">State: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['state'];} ?>" name="contact[state]">
    </div>
    <div>
        <label for="contact[country]">Country: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['country'];} ?>" name="contact[country]">
    </div>
    <div>
        <label for="contact[zip]">Zip: </label>
        <input type="text" value="<?php if(isset($contact)){echo $contact['zip'];} ?>" name="contact[zip]">
    </div>
    <div>
        <label for="contact[birthday]">Birthday: </label>
        <input type="date" value="<?php if(isset($contact)){echo $contact['birthday'];} ?>" name="contact[birthday]">
    </div>
    <div class="labelbtn">
        <input class="button" type="submit" name="editcontactsubmit" value="save">
        <input class="button" type="button" onclick="window.location.replace('<?php echo SITE_ROOT; ?>/contacts/index')" value="cancel">
    </div>
</form>
</section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>