<?php

session_start();

$login = isset($_SESSION['loggedInKapda']) && $_SESSION['loggedInKapda'] === true;
