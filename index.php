<?php
session_start();

if (isset($_SESSION['row_id'])) {
    header("Location: ./Templates/detail.php");
} else { header("Location: ./Templates/index.php"); }