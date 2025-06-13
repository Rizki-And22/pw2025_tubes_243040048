<?php
session_start();
session_destroy();
header("Location:../../public/php/index.php");
