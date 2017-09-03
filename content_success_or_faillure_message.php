<?php if (isset($_SESSION["success_process"])): ?>
    <div class="ui success message">
        <i class="check circle icon"></i>
        <?php
        echo $_SESSION["success_process"];
        unset($_SESSION["success_process"]);
        ?>.
        <i class="close icon"></i>
    </div>                    
<?php elseif (isset($_SESSION["faillure_process"])): ?>
    <div class="ui error message">
        <i class="remove circle icon"></i>
        <?php
        echo $_SESSION["faillure_process"];
        unset($_SESSION["faillure_process"]);
        ?>.
        <i class="close icon"></i>
    </div>
<?php elseif (isset($_SESSION["warning_process"])): ?>
    <div class="ui warning message">
        <i class="warning sign icon"></i>
        <?php
        echo $_SESSION["warning_process"];
        unset($_SESSION["warning_process"]);
        ?>.
        <i class="close icon"></i>
    </div>  
<?php
 endif ?>
