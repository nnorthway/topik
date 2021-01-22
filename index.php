<?php
include 'config.php';
include 'Post.php';
$posts = Post::get_recent_posts();
$title = "Home";
include 'header.php';
?>
<section class='hero is-large'>
  <div class='hero-body'>
    <div class='container'>
      <h1 class='title'>Topik</h1>
      <p class='subtitle'>
        An open source, database-less blogging system (or flat-file) that is based in simplicity and speed. There is no "admin" section and this is not a CMS. This system simply gathers all of your posts and puts them into a comprehensive view. Posts are written in PHP and require a little bit of PHP knowledge to get started.
      </p>
      <div class='level'>
        <a class='button is-info' href='<?php echo $base; ?>documentation#getting_started'>Get Started</a>
        <a class='button is-info' href='<?php echo $base; ?>documentation'>Documentation</a>
        <a class='button is-info' href='<?php echo $base; ?>posts'>All Posts</a>
      </div>
    </div>
  </div>
</section>
<div class='section has-background-dark'>
  <div class='columns'>
    <?php
    foreach ($posts as $post) : ?>
    <div class='column'>
      <a class='box' href='<?php echo $base . $post['link']; ?>'>
        <p class='title'>
          <?php echo $post['title']; ?>
        </p>
        <p>
          <?php echo $post['description']; ?>
        </p>
      </a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
