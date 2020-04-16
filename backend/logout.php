<?php

session_start();
session_destroy();
header('location: ../backend/login.php');