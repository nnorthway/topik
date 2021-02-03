<?php
include 'config.php';
include 'Post.php';
$title = 'Search';
include 'header.php';
$results = Post::search($_GET['s']);
?>
<div class='section'>
  <div class='container'>
    <div class='columns is-centered'>
      <div class='column is-two-thirds'>
        <h1 class='title'>Search Results</h1>
        <?php if ($results) {
          foreach ($results as $post) : ?>
            <div class='box'>
              <h3 class='is-size-3'><?php echo $post->title; ?></h3>
              <p class='subtitle'>
                <?php echo $post->description; ?><br />
              </p>
              <footer class='box-footer'>
                <small><?php echo $post->format_date; ?></small>
                <a href='<?php echo $post->link; ?>' class='button is-info'>
                  Read More
                </a>
              </footer>
            </div>
          <?php
          endforeach;
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
