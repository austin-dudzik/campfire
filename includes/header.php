<div class="header py-4">
   <div class="container">
      <div class="d-flex">
         <a class="header-brand" href="<?= $url ?>">
         <img src="<?= $url ?>/assets/images/logo.svg" class="header-brand-img mr-2" alt="Campfire logo">
         <span class="hidden-sm-down">Campfire</span>
         </a>
         <div class="d-flex order-lg-2 ml-auto">
            <div class="nav-item d-none d-md-flex">
               <a href="#" data-toggle="modal" data-target="#newListModal" id="newListModalBtn" data-backdrop="static" data-keyboard="false" class="btn btn-sm pl-4 pr-4 bg-camp"><i class="fe fe-plus mr-2"></i> New</a>
            </div>
            <div class="dropdown">
               <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
               <img class="avatar" src="<?= 'https://www.gravatar.com/avatar/' . md5($email) . '?d=mp' ?>">
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

<div class="modal fade" id="newListModal">
    <div class="modal-dialog modal-dialog-centered modal-s">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h5 class="modal-title">New Campaign</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <form method="post" action="<?= $url ?>/">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input">
                            <input type="text" class="form-control mb-2" name="name" placeholder="Campaign name" aria-label="Campaign name" required>
                            <small>This is only used internally when you need to identify the campaign.</small>
                        </div>
                    </div>
                    <button type="submit" name="submit" value="1" class="btn bg-camp w-25 btn-block new-list-modal-btn mb-3"><i class="fe fe-check"></i> Create</button>
                </div>
            </form>
        </div>
    </div>
</div>