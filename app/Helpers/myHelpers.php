<?php

use Illuminate\Support\Facades\Request;

function setActive(string $path, string $class_name = "active")
{
	return Request::path() === $path ? $class_name : "";
}