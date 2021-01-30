<?php
include 'config.php';
if (isset($_GET['e'])) {
  $status = $_GET['e'];
} else {
  $status = $_SERVER['REDIRECT_STATUS'];
}
$codes = array(
  400 => array('400 Bad Request', 'The request cannot be fulfilled due to bad syntax.'),
  403 => array('403 Forbidden', 'The server has refused to fulfill your request.'),
  404 => array('404 Not Found', 'The page you requested was not found on this server'),
  405 => array('405 Method Not Allowed', 'The method specified in the request is not allowed for the specified resource.'),
  408 => array('408 Request Timeout', 'Your browser failed to send a request in the time allowed by the server.'),
  500 => array('500 Internal Server Error', 'The request was unsuccessful due to an unexpected condition encountered by the server.'),
  502 => array('502 Bad Gateway', 'The server received an invalid response while trying to carry out the request.'),
  504 => array('504 Gateway Timeout', 'The upstream server failed to send a request in the time allowed by the server.'),
);
$error = $codes[$status];
$title = "Error " . $status;
include 'header.php';
?>
<section class='hero is-large is-bold is-primary'>
  <div class='hero-body'>
    <div class='container'>
      <h1 class='title'>Error: <?php echo $error[0]; ?></h1>
      <p class='subtitle'>
        <?php echo $error[1]; ?><br />
        Sorry about that. We're working on fixing that issue.
      </p>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
