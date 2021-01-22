# Topik
Topik is an open source, database-less blogging system (or flat-file) that is based in simplicity and speed. There is no "admin" section and this is not a CMS. This system simply gathers all of your posts and puts them into a comprehensive view. Posts are written in PHP and require a little bit of PHP knowledge to get started.  
The base files score 100 on Google PageSpeed Insights for both mobile and desktop. The complete size is <100kb.

___

## Demo
Visit [http://topik.natenorthway.com](http://topik.natenorthway.com) to see it in action.

___

## Features
- Flat File Blog System
- Configurable options
- Static Pages
- Expandable & Customizable
- No Dependencies
- Per Post Navigation (previous/next links)
- No Design out of the box - use your own markup & styles.

___

## Requirements
The only requirement is PHP 5.6 or higher. To publish blog posts, you'll need to save them in the "posts" directory, so any text editor that can save files in PHP format will do. You'll probably want an FTP solution to get your files on to the server.

___

## Configurations
The config file has two variables: the name of your website and the URL at which it lives. The name can be any string, but try to keep it short because it's used in the `<title></title>` HTML tag. The URL **must** have a trailing slash. Example:

    $base = "https://myblog.com"; <--Will break things
    $base = "https://myblog.com/"; <--Will work

---

## File Naming Convention
Files are saved with a date (YYYY-MM-DD) leading the post title as .php files in the /posts directory.

    2021-01-20-This_Is_A_Post.php

Words in the post titles should be separated, but it's not required. They can be separated with underscores or hyphens, but never with slashes, spaces, or other special characters.

---

## Post Parts
Each post should have the variables for title, description, and date defined at the top of the post. After these variables are saved, the rest of the content after the closing PHP tag should be written in HTML.

    <?php
    $title = "A Title";
    $description = "A short description";
    $date = "2021-01-21";
    //or "2021/01/21"
    ?>
    <!--HTML content goes here-->

---

## Contributors
This was built by me, Nate Northway. To contribute, send me a message with your idea, and I'll add you as a contributor.

---

## Copyright & Licensing
Please see the copyright file in the root directory. This is released under the GNU Public License.
