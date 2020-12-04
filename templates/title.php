  <!-- Title Start -->
  <div class="container">

    <div class="row title-row">
      <div class="col title-empty-col"></div>
      <div class="col-5 title-col">
        <div class="title-main">
          <a href="<?php echo $links[count($links) - 1] ?>"><?php echo $crumbs[count($crumbs) - 1] ?></a>
        </div>
      </div>

      <div class="col-5 title-col">
        <div class="title-path">
          <?php
          for ($i = 0; $i < count($crumbs); $i++) {
            echo "<a href=\"" . $links[$i] . "\">" . $crumbs[$i] . "</a>";
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