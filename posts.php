<?php
include "config.php";
include 'Post.php';
$offset = isset($_GET['page'])?$_GET['page']:1;
$posts = Post::get_posts($offset);
$pagination = Post::get_pagination($offset);
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
              <a href='<?php echo $post->link; ?>' class='button is-info'>
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
<div class='container mb-4'>
  <div class='level pagination'>
    <?php if ($pagination['prev']):?>
      <a href='posts?page=<?php echo $pagination['prev']; ?>' class='button'>Newer Posts</a>
    <?php endif; ?>
    <?php
    if ($pagination['count']) :
      for ($x = 0; $x < $pagination['count']; $x++) :
        ?>
        <a href='posts?page=<?php echo $x + 1; ?>' class='button <?php if (($x + 1) == $pagination['current']):?>is-active<?php endif; ?>'><?php echo $x + 1; ?></a>
        <?php
      endfor;
    endif; ?>
    <?php if ($pagination['next']): ?>
      <a href='posts?page=<?php echo $pagination['next']; ?>' class='button'>Older Posts</a>
    <?php endif; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
