<?php
$title = "Themes and Customization";
$description = "Customization is what this is all about";
$date = "2021/01/20";
$subject = "Topik Blog Platform Documentation";
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
  To get started with customization, there are a few options. In most cases, you'll
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
    &lt;a href='&lt;?php echo $post->link; ?&gt;'&gt;Read More&lt;/a&gt;
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
  You can later use that variable to get the <a href='#pagination'>pagination</a>.
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
        &lt;a href='&lt;?php echo $post->link; ?&gt;'&gt;Read More&lt;/a&gt;
      &lt;/div&gt;
    &lt;?php
  }
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
          &lt;a href='&lt;?php echo $next_post['link']; ?&gt;'&gt;Read&lt;/a&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;?php
    }
  </code>
</pre>
<h3 id='pagination'>Posts Page Pagination</h3>
<p>
  You can also get pagination for the Posts page. This function returns an array.
  It accepts an integer, which should be the current page. The default value is 1.
  The properties are as follows:
  <ul>
    <li>
      <code>count</code>: How many total pages exist. This will always be returned.
    </li>
    <li>
      <code>next</code>: The next page (older posts). This will not be returned if <code>offset</code> is equal to <code>count</code>.
    </li>
    <li>
      <code>prev</code>: The preceding page (newer posts). This will not be returned if <code>offset</code> is equal to 1.
    </li>
    <li>
      <code>current</code>: The current page. This will always be returned.
    </li>
  </ul>
  An example of usage is below.
</p>
<pre>
  <code class='php'>
$offset = isset($_GET['page'])?$_GET['page']:1;
$pagination = Post::get_pagination($offset);
/*Later in the document*/
if ($pagination['prev']):?&gt;
&lgt;a href='posts?page=&lt;?php echo $pagination['prev']; ?&gt;'&gt;Newer Posts&lt;/a&gt;
&lt;?php endif; ?&gt;
&lt;?php echo "Page " . $pagination['current'] . " of " . $pagination['count']; ?&gt;
if ($pagination['next']):&gt;
&lt;a href='posts?page=&lt;?php echo $pagination['next']; ?&gt;'>Older Posts&lt;/a&gt;
&lt;?php endif; ?&gt;
  </code>
</pre>
<p>
  The above will output something like this section below:
</p>
<div class='has-background-dark has-text-light'>
  <a href='posts?page=1'>Newer Posts</a><br />
  Page 2 of 6<br />
  <a href='posts?page=3'>Older Posts</a>
</div>
<hr />
<h3 class='is-size-3'>Search</h3>
<p>
  The search function is built in to the Post class. It accepts a string and
  returns an array of posts. The posts returned will either have a title or
  content that matches. This function is not verbose, though, so simple strings
  like "a" or "is" will likely match multiple posts. Below is demo
  implementation code.
</p>
<pre>
  <code class='php'>
if (isset($_GET['term'])) $results = Post::search($_GET['term']);
....
if ($results) {
  foreach ($results as $result) {
    //do stuff (like display the posts)
  }
}
  </code>
</pre>
<p>
  The form used on Topik uses the <code>GET</code> method, which appends the
  input value to the end of the URL string. For example, if the page that runs
  the function is <code>search.php</code>, the URL when a search is executed
  becomes <code>search.php?term=crocodile</code>. Below is some starter code
  for the search form.
</p>
<pre>
  <code class='html'>
&lt;form action='search' method='get'&gt;
  &lt;input type='text' name='term' id='term' /&gt;
  &lt;label for='term'&gt;Search For&lt;/label&gt;
  &lt;button type='submit'&gt;Search&lt;/button&gt;
&lt;/form&gt;
  </code>
</pre>
<p>
  There are other things that can be done there, like adding an autofilled value
  if there is already a term in the <code>$_GET</code> array, but we'll let you
  make those decisions.
</p>
<hr />
<h3 class='is-size-3'>Config File</h3>
<p>
  The config file contains a lot of customizable options to improve SEO.
  The only variables that are required are the <code>$blogName</code> and <code>$base</code>,
  but the rest really help SEO. This list describes all of the available
  options and what they're used for.
</p>
<ul>
  <li>
    <code>$blogDescription</code>: A description of your blog. This
    will be overwritten by the post description on post pages.
  </li>
  <li>
    <code>$blogSubject</code>: The subject of your blog. This will be
    overwritten by the post subject on post pages (if the subject is
    set). If empty or unset, it defaults to the blog name.
  </li>
  <li>
    <code>$googleSiteVerification</code>: Your Google Site Verification
    key
  </li>
  <li>
    <code>$generator</code>: The program used to generate the page.
    Usually your text editor.
  </li>
  <li>
    <code>$postsPage</code>: The page that will have all of your posts
    displayed. Defaults to "posts.php". This helps with canonical links
    and defines the Archive meta tag.
  </li>
  <li>
    <code>$blogPage</code>: The page that is called when displaying a
    blog post. Default is "blog.php"
  </li>
  <li>
    <code>$blogHumans</code>: The location of the humans.txt file. No
    default.
  </li>
</ul>
