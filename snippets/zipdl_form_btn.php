<form action="<?php zipdl_dl_url() ?>" method="post" accept-charset="utf-8" id="kirby-zipdl-form">
  <fieldset>
    <!-- <legend>download</legend> -->
    <input type="hidden" name="current_page" value="<?php echo $page->id() ?>">
    <button type="submit">Download</button>
  </fieldset>
</form>
