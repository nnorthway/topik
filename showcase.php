<?php
include 'config.php';
$title = "Showcase";
include 'header.php';
?>
<section class='hero is-bold is-primary'>
  <div class='hero-body'>
    <div class='container'>
      <h1 class='title'>Showcase</h1>
      <p class='subtitle'>
        Use the tag #BuiltOnTopik on Twitter to add your site to this showcase!
      </p>
    </div>
  </div>
</section>
<section class='section'>
  <div class='container'>
    <div class='columns is-centered'>
      <div class='column is-half'>
        <a class='showcase' href='http://beta.natenorthway.com'>
          <img src='<?php echo $base; ?>img/nate_northway.png' load='lazy' alt="Nate Northway's Site Built With Topik" target='_blank' />
          <h4 class='is-size-4'>Nate Northway</h4>
          <p class='subtitle'>
            Feb 1, 2021
          </p>
        </a>
      </div>
    </div>
  </div>
</section>
