<div class="header py-4">
   <div class="container">
      <div class="d-flex">
         <a class="header-brand" href="<?= $url ?>">
         <img src="<?= $url ?>/assets/images/logo.svg" class="header-brand-img mr-2" alt="Campfire logo">
         <span class="hidden-sm-down">Campfire</span>
         </a>
         <div class="d-flex order-lg-2 ml-auto">
            <div class="nav-item d-none d-md-flex">
               <a href="mailto:support@hexagonal.agency?subject=Campfire%20support" target="_blank" class="btn btn-sm pl-4 pr-4 bg-camp">Need help?</a>
            </div>
            <div class="dropdown">
               <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
               <img class="avatar" src="<?= 'https://www.gravatar.com/avatar/' . md5($email) . '?d=' . $url . '/assets/images/avatar.png' ?>" onerror="this.src='<?= $url . '/assets/images/avatar.png' ?>'">
               <span class="ml-2 d-none d-lg-block">
                    <span class="text-default"><?= clean($first_name) ?></span>
               </span>
               </a>
               <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a class="dropdown-item" href="<?= $url . '/profile' ?>">
                  <i class="dropdown-icon fe fe-user"></i> Profile
                  </a>
                   <?php if ($role == 0) { ?>
                   <a class="dropdown-item" href="<?= $url . '/team' ?>">
                       <i class="dropdown-icon fe fe-users"></i> Team
                   </a>
                   <?php } ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= $url . '/logout' ?>">
                  <i class="dropdown-icon fe fe-log-out"></i> Log out
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
