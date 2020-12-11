<!-- Title Start -->
<div>
  <div class="row title-row">
    <div class="col title-empty-col"></div>
    <div class="col-5 title-col">
      <div class="title-main">
        <span><?php echo $crumbs[0] ?></span>
      </div>
    </div>

    <div class="col-5 title-col">
      <div class="title-path">
        <?php
        for ($i = 0; $i < count($crumbs); $i++) {
          echo "<span>" . $crumbs[$i] . "</span>";
          if ($i !== count($crumbs) - 1) {
            echo "<span>/</span>";
          }
        }
        ?>
      </div>
    </div>
    <div class="col title-empty-col"></div>
  </div>
</div>
<!-- Title End -->