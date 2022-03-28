<div class="col-lg-2 mb-4 px-0">
   <div class="list-group list-group-transparent mb-0">

      <a href="<?= $url ?>" onclick="loaderInit()" class="list-group-item list-group-item-action mb-2">
      <span class="icon mr-3"><i class="fe fe-arrow-left"></i></span>All campaigns</a>

      <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/editor' ?>" onclick="loaderInit()" class="list-group-item list-group-item-action <?= $page === "editor" ? 'active' : '' ?>">
      <span class="icon mr-3"><i id="editorClick" class="fe fe-edit-2"></i></span>Editor</a>

      <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/responses' ?>" onclick="loaderInit()" class="list-group-item list-group-item-action <?= $page === "responses" ? 'active' : '' ?>">
      <span class="icon mr-3"><i class="fe fe-bar-chart-2"></i></span>Responses
      <span class="float-right"><?= $responses ?></span></a>

      <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/integrations' ?>" onclick="loaderInit()" class="list-group-item list-group-item-action <?= $page === "integrations" ? 'active' : '' ?>">
      <span class="icon mr-3"><i class="fe fe-code"></i></span>Integrations</a>

      <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/privacy' ?>" onclick="loaderInit()" class="list-group-item list-group-item-action <?= $page === "privacy" ? 'active' : '' ?>">
      <span class="icon mr-3"><i class="fe fe-eye"></i></span>Privacy</a>

      <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/data' ?>" onclick="loaderInit()" class="list-group-item list-group-item-action <<?= $page === "data" ? 'active' : '' ?>">
      <span class="icon mr-3"><i class="fe fe-database"></i></span>Data Manager</a>

       <?php if($role == 0) { ?>
      <div class="dropdown-divider"></div>

      <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/delete' ?>" onclick="loaderInit()" class="list-group-item list-group-item-action text-red">
      <span class="icon mr-3"><i class="fe fe-trash text-red"></i></span> Delete campaign</a>
      <?php } ?>

   </div>
</div>
