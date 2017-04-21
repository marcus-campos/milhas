<?php
if (!session_id()) @session_start();
//Init routes
$route = new \Milhas\Http\Route\BaseRouter();