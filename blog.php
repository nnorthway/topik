<?php
include "config.php";
include 'Post.php';
$post = Post::get_post(basename($_SERVER['REQUEST_URI']));
$title = $post->title;
include "header.php";
?>
<div class='section'>
  <div class='container'>
    <h1 class='is-size-1'><?php echo $post->title;?></h1>
    <p class='subtitle'>
      <?php echo $post->description; ?>
    </p>
    <small><?php echo $post->format_date; ?></small>
  </div>
</div>
<div class='section'>
  <div class='container'>
    <div class='columns is-centered'>
      <div class='column is-four-fifths'>
        <div class='content'>
          <?php echo $post->content; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class='section has-background-grey-lighter'>
  <div class='level'>
    <?php
    if ($post->prev_link !== false) {
      $prev_post = $post->get_post_meta($post->prev_link);
      ?>
      <div class='level-item'>
        <div class='box'>
          <small>Previous Post:</small>
          <h3 class='is-size-3'><?php echo $prev_post['title']; ?></h3>
          <p>
            <?php echo $prev_post['description']; ?>
          </p><br />
          <a href='<?php echo $base . $prev_post['link']; ?>' class='button is-info'>Read</a>
        </div>
      </div>
      <?php
    }
    if ($post->next_link !== false) {
      $next_post = $post->get_post_meta($post->next_link);
      ?>
      <div class='level-item'>
        <div class='box'>
          <small>Next Post:</small>
          <h3 class='is-size-3'><?php echo $next_post['title']; ?></h3>
          <p>
            <?php echo $next_post['description']; ?>
          </p><br />
          <a href='<?php echo $base . $next_post['link']; ?>' class='button is-info'>Read</a>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>
<?php
include 'footer.php';
