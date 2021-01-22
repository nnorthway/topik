<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo isset($title) ? $title . " | ":''; echo $blogName;?></title>
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
          <a class='navbar-item' href='<?php echo $base; ?>posts'>Blog</a>
          <div class='navbar-item has-dropdown is-hoverable'>
            <a class='navbar-link' href='<?php echo $base; ?>documentation'>
              Documentation
            </a>
            <div class='navbar-dropdown'>
              <a class='navbar-item' href='<?php echo $base; ?>documentation#getting_started'>Getting Started</a>
              <a class='navbar-item' href='<?php echo $base; ?>documentation#pages'>Pages</a>
              <a class='navbar-item' href='<?php echo $base; ?>documentation#post_class'>The Post Class</a>
              <a class='navbar-item' href='<?php echo $base; ?>documentation#content'>Content</a>
              <a class='navbar-item' href='<?php echo $base; ?>documentation#customization'>Customization</a>
              <a class='navbar-item' href='<?php echo $base; ?>documentation#help'>Help</a>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
