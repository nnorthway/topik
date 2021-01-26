<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo isset($title) ? $title . " | ":''; echo $blogName;?></title>
    <base href="<?php echo $base; ?>" />
    <meta name='description' content="<?php echo $description; ?>" />
    <meta name="robots" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    <?php
      if (isset($googleSiteVerification)) :
        ?>
        <meta name="google-site-verification" content="<?php echo $googleSiteVerification; ?>" />
        <?php
      endif;
    ?>
    <meta name="generator" content="<?php echo isset($generator)?$generator:'Atom.io'; ?>">
    <?php
    $subject = $blogName;
    if (isset($post->subject)) {
      $subject = $post->subject;
    } else if (isset($blogSubject)) {
      $subject = $blogSubject;
    }
    ?>
    <meta name="subject" content="<?php echo $subject; ?>">
    <?php
    $link = "";
    if (isset($postsPage) && strpos($_SERVER['REQUEST_URI'], $postsPage) !== false) {
      if (($offset - 1) != 0) {
        $link = $base . "posts?page=" . ($offset - 1);
      } else {
        $link = $base . "posts?page=" . ($offset + 1);
      }
    } else if (isset($post->next_link) && $post->next_link != "") {
      $link = $base . $blogPage . $post->next_link;
    }
    if ($link != "") :
      ?>
      <link rel="canonical" href="<?php echo $link; ?>">
      <?php
    endif;
    ?>
    <?php if (isset($blogHumans)) : ?>
      <link rel="author" href="<?php echo $blogHumans; ?>">
    <?php endif; ?>
    <?php if (isset($postsPage)) : ?>
      <link rel="archives" href="<?php echo $postsPage; ?>">
    <?php endif; ?>
    <link type='text/css' href='https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css' rel='stylesheet' />
    <style type='text/css'>
    main {
      min-height: 100vh;
    }
    .box-footer {
      display: flex;
      align-items: center;
      align-content: center;
      justify-content: space-between;
    }
    main {
      margin-top: 52px;
    }
    #docs section {
      padding-top: 52px;
    }
    pre,
    .content pre {
      padding: 0;
      padding-left: .5em;
    }
    pre:before {
      display: block;
      background: orange;
      color: black;
      position: relative;
      left: -.5em;
      width: calc(100% + .5em);
      padding: .3em;
      content: 'PHP';
    }
    pre code,
    .content pre code {
      padding-left: 1em;
    }
    .showcase {
      display: flex;
      flex-direction: column;
      align-items: center;
      align-content: center;
      justify-content: center;
      color: #4a4a4a;
    }
    .showcase img {
      margin: 0 auto;
    }
    .showcase:hover img {
      filter: brightness(50%);
    }
    </style>
  </head>
  <body>
    <header>
      <nav class='navbar is-fixed-top' role='navigation' aria-label='main navigation'>
        <div class='navbar-brand'>
          <a class='navbar-item' href='<?php echo $base; ?>'>Topik</a>
          <a role='button' class='navbar-burger' id='navbar_toggle' aria-label='menu' aria-expanded='false' data-target='navbar'>
            <span aria-hidden='true'></span>
            <span aria-hidden='true'></span>
            <span aria-hidden='true'></span>
          </a>
        </div>
        <div id='navbar' class='navbar-menu'>
          <a class='navbar-item' href='<?php echo $base; ?>'>Home</a>
          <a class='navbar-item' href='posts'>Blog</a>
          <a class='navbar-item' href='showcase'>Showcase</a>
          <div class='navbar-item has-dropdown is-hoverable'>
            <a class='navbar-link' href='documentation'>
              Documentation
            </a>
            <div class='navbar-dropdown'>
              <a class='navbar-item' href='documentation#getting_started'>Getting Started</a>
              <a class='navbar-item' href='documentation#pages'>Pages</a>
              <a class='navbar-item' href='documentation#post_class'>The Post Class</a>
              <a class='navbar-item' href='documentation#content'>Content</a>
              <a class='navbar-item' href='documentation#customization'>Customization</a>
              <a class='navbar-item' href='documentation#help'>Help</a>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
