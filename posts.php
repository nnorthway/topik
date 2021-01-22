<?php
include "config.php";
include 'Post.php';
$offset = isset($_GET['page'])?$_GET['page']:1;
$posts = Post::get_posts($offset);
$title = "Posts";
include "header.php";
?>
<div class='section'>
  <div class='container'>
    <div class='columns is-centered'>
      <div class='column is-two-thirds'>
        <?php
        foreach ($posts as $post) {
          ?>
          <div class='box'>
            <h3 class='is-size-3'><?php echo $post->title; ?></h3>
            <p class='subtitle'>
              <?php echo $post->description; ?><br />
            </p>
            <footer class='box-footer'>
              <small><?php echo $post->format_date; ?></small>
              <a href='<?php echo $base . $post->link; ?>' class='button is-info'>
                Read More
              </a>
            </footer>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<p>
  <?php
  if (($offset - 1) != 0) {
    ?><a class='button' href='<?php echo $base . "posts?page=" . ($offset - 1); ?>'><span class='icon is-small'><i class='fa fa-chevron-left'></i></span><span>Newer Posts</span></a><?php
  }
  ?>
</p>
<p>
  <?php
  if (count($posts) == 9) {
    ?><a class='button' href='<?php echo $base . "posts?page=" . ($offset + 1); ?>'><span>Older Posts</span><span class='icon is-small'><i class='fa fa-chevron-right'></i></span></a><?php
  }
  ?>
</p>
<?php include 'footer.php'; ?>
