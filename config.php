<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'kj') or die("DB CONNECTION ERROR");

// UTF-8 설정(DB에 있는 내용을 UTF-8로 가져오겠다는 설정, 이거 없어도 한글 안깨지면 안해도 됨)
mysqli_query($conn, "SET NAMES utf8");

$isLogined = isset($_SESSION['loginedMember']);
