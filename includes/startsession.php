<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['uid'])) {
    if (isset($_COOKIE['uid']) && isset($_COOKIE['username'])) {
      $_SESSION['uid'] = $_COOKIE['uid'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>
