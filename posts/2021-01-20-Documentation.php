<?php
$title = "Themes and Customization";
$description = "Customization is what this is all about";
$date = "2021/01/20";
?>
<p>
  Topik comes with just what you need to get started for a presentation layer.
  The core of the install is the Post class and the Posts directory. How you
  choose to display it is up to you. However, we do start you out with a few files
  to get you going:
</p>
<ul>
  <li>
    <code>config.php</code>: This is where all your options are.
  </li>
  <li>
    <code>index.php</code>: The home page.
  </li>
  <li>
    <code>header.php, footer.php</code>: Page parts, which keeps your code DRY.
  </li>
  <li>
    <code>blog.php</code>: Single post page
  </li>
  <li>
    <code>posts.php</code>: A place to show a preview of all posts.
  </li>
</ul>
<p>
  To get started with pagination, there are a few options. In most cases, you'll
  want to create another directory for your stylesheets, javascript, and images.
  You'll then have to link to them. You can do this in the <code>header.php</code>
  file using <code>&lt;style /&gt;</code> and <code>&lt;script&gt;&lt;/script&gt;</code> tags.<br />
  Edit the included files to reflect the markup you want. Below are some code
  snippets to get you going:
</p>
<h3>Get Most Recent Posts</h3>
<p>
  This function returns an array of the latest 3 posts.
</p>
<pre class='php'>
  <code>
$posts = Post::get_recent_posts();
foreach ($posts as $post) :
?&gt;
  &lt;div&gt;
    &lt;h1&gt;&lt;?php echo $post->title; ?&gt;&lt;/h1&gt;
    &lt;p&gt;
      &lt;?php echo $post->description; ?&gt;
    &lt;/p&gt;
    &lt;a href='&lt;?php echo $base . $post->link; ?&gt;'&gt;Read More&lt;/a&gt;
  &lt;/div&gt;
&lt;?php
endforeach;
  </code>
</pre>
<hr />
<h3>Get More Posts</h3>
<p>
  This function returns array of the latest 9 posts. The function accepts the "offset"
  parameter, which is the page number the user has navigated to. The default
  value is 1. Only integers are accepted, no strings. We suggest using <code>?page=1</code>
  in the URL and the <code>$_GET</code> array to access the <code>['page']</code> key. <br />
  You can later use that variable to determine if there is a previous page. You can use
  the amount of posts returned to determine if there is another page to go to.
</p>
<pre class='php'>
  <code>
$offset = isset($_GET['page'])?$_GET['page']:1;
$posts = Post::get_posts($offset);
if ($posts) {
  foreach ($posts as $post) {
    ?&gt;
      &lt;div&gt;
        &lt;h1&gt;&lt;?php echo $post->title; ?&gt;&lt;/h1&gt;
        &lt;p&gt;
          &lt;?php echo $post->description; ?&gt;
        &lt;/p&gt;
        &lt;a href='&lt;?php echo $base . $post->link; ?&gt;'&gt;Read More&lt;/a&gt;
      &lt;/div&gt;
    &lt;?php
  }
}
if ($offset - 1 > 0) {
  ?&gt;
  &lt;a href='&lt;?php echo $base; ?&gt;posts?page=&lt;?php echo $offset - 1; ?&gt;'&gt;Previous Posts&lt;/a&gt;
  &lt;?php
}
if (count($posts) == 9) {
  ?&gt;
  &lt;a href='&lt;?php echo $base; ?&gt;posts?page=&lt;?php echo $offset + 1; ?&gt;'&gt;Newer Posts&lt;/a&gt;
  &lt;?php
}
  </code>
</pre>
<h3>Displaying A Post</h3>
<p>
  Displaying a specific post requires use of the <code>get_post</code> method. The
  function accepts the parameter <code>$filename</code>, which should be a string
  containing just the file name, not the parent folder, and with or without the
  '.php' extension. <br />
  To access the filename, assuming the post is being linked the same way it's
  linked in the previous code blocks, use the <code>$_SERVER</code> global, and the
  <code>['REQUEST_URI']</code> key. This will return the request URL without the
  base URL. In this case, the Request URI is <code>blog/2021-01-20-Documentation</code>.
  We need to remove the leading part of that, including the slash. That can be done
  with the PHP <code>basename()</code> function. So, the filename is <code>$filename = basename($_SERVER['REQUEST_URI']);</code>.
</p>
<pre class='php'>
  <code>
    $post = Post::get_post(basename($_SERVER['REQUEST_URI']));
    ?&gt;
    &lt;h1 class='is-size-1'&gt;&lt;?php echo $post->title;?&gt;&lt;/h1&gt;
    &lt;p class='subtitle'&gt;
      &lt;?php echo $post->description; ?&gt;
    &lt;/p&gt;
    &lt;small&gt;&lt;?php echo $post->format_date; ?&gt;&lt;/small&gt;
  </code>
</pre>
<h3>Post Pagination/Canonical</h3>
<p>
  Adjacent posts can be accessed using a property and a function. To start, part
  of the post object are the <code>next_link</code> and <code>prev_link</code> properties,
  which only have a value if there is an adjacent post. <br />
  Note that these values are just the links, not the post arrays. To get the post
  details, the <code>get_post_meta()</code> function must be used. That function
  works similarly to the <code>get_post()</code> function: it acceps a file name
  as a string without a leading folder name or slash. The link is just the file name,
  so the <code>basename()</code> function won't be needed. Instead of using <code>$_SERVER</code>,
  the <code>$post->next_link</code> or <code>$post->prev_link</code> property
  can be used. Pass that property to the <code>get_post_meta()</code> function to get
  the post meta array.
</p>
<pre class='php'>
  <code>
    if ($post->next_link !== false) {
      $next_post = Post::get_post_meta($post->next_link);
      ?&gt;
      &lt;div&gt;
        &lt;div&gt;
          &lt;small&gt;Next Post:&lt;/small&gt;
          &lt;h3&gt;&lt;?php echo $next_post['title']; ?&gt;&lt;/h3&gt;
          &lt;p&gt;
            &lt;?php echo $next_post['description']; ?&gt;
          &lt;/p&gt;&lt;br /&gt;
          &lt;a href='&lt;?php echo $base . $next_post['link']; ?&gt;'&gt;Read&lt;/a&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;?php
    }
  </code>
</pre>
