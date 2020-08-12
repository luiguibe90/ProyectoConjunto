<?php
session_start();
  session_destroy();
  header('Location: ../../../Seed/login.html');
?>