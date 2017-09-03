<?php if ($identity_status == 2): ?> 
    <span ><i class="remove large circle outline red icon"></i> <span class="red_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
<?php elseif ($identity_status == 3): ?> 
    <span><i class="check large circle green icon"></i> <span class="green_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
<?php elseif ($identity_status == 1): ?> 
    <span ><i class="refresh large blue icon"></i> <span class="blue_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
<?php else: ?> 
    <span ><i class="remove large circle red icon"></i> <span class="red_identity"><?php echo getUserIdentityStatus($identity_status); ?></span></span>
<?php endif ?>