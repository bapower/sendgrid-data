<?php

function adminer_object()
{
    // @codingStandardsIgnoreLine
    class AdminerSendgrid extends Adminer
    {
        function loginForm()
        {
?>
<input type=hidden name=auth[driver] value=pgsql>
<input type=hidden name=auth[server] value=db>
<input type=hidden name=auth[username] value="<?= getenv('STDB_USER') ?>">
<input type=hidden name=auth[password] value="<?= getenv('STDB_PASSWORD') ?>">
<input type=hidden name=auth[db] value="<?= getenv('STDB_DATABASE') ?>">
<input type=submit id=submit value="Click Me.">
<script>
document.getElementById('submit').click();
</script>
<?php
        }
    }
    return new AdminerSendgrid();
}

require('adminer.php');
