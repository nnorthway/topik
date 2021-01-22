<?php
$title = "Getting Started";
$description = "An Intro to this system";
$date = "2021/01/21";
?>
<h1>Welcome to Topik!</h1>
<p>
  Topik is a flat file, databaseless blogging system built with PHP. It comes
  with little-to-no front end so that the focus is on customization and function.
  I built this with speed and extendability in mind so that it can grow. It's easy
  to get going with.
</p>
<hr />
<h3>Get Set Up</h3>
<p>
  To get started, you just need to download the .zip and extract the files in
  the root directory. Then, set up the <code>config.php</code> file. Set the two
  variables to the relevant values, and you're all set. The blogName variable
  is just what you want to call your site. The base variable is the URL of your
  site, with a trailing slash "/". See the example config file below:
</p>
<pre class='php'>
  <code>
    &lt;?php
    $blogName = "Topik";
    $base = "http://localhost:8888/flat_blog/";
  </code>
</pre>
<h3>Suggestions</h3>
<ul>
  <li>
    Add a privacy policy
  </li>
  <li>
    Use this site over SSL/HTTPS
  </li>
  <li>
    Add an HTTPS redirect to .htaccess
  </li>
  <li>
    Change the markup, at least to remove the documentation links
  </li>
  <li>
    Remove the "documentation" page, at least until you get going.
  </li>
  <li>
    Remove the default posts.
  </li>
  <li>
    Don't hardcode posts if you don't have to.
  </li>
</ul>
