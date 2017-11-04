<?php
  # Thank you http://stackoverflow.com/posts/2510459/revisions
  function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
  } 
?>

<div class="kirby-zipdl-asset-gallery">

<?php snippet('zipdl_form_btn'); ?>

  <?php foreach($page->files()->sortBy('sort', 'asc') as $file): ?>
  <?php snippet('zipdl_checkbox', array('file' => $file)); ?>

  <?php if($file->type() == 'image'): ?>
    <figure>
      <img src="<?php echo $file->crop(300, 300)->url() ?>" alt="<?php echo $page->title()->html() ?>">
    </figure>
  <?php else : ?>
    <p>
      <a href="<?php echo $file->url() ?>" title="<?php echo $file->filename() ?>"><?php echo $file->name() ?>
        <small>(<?php echo $file->extension() ?>, <?php echo formatBytes($file->size()) ?>)</small>
      </a>
    </p>
  <?php endif ?>

  <?php endforeach ?>
</div>
