@extends('layouts.welcome')

@section('content')


<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed navbar-fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="header-logo img-fluid p-4" src="assets/images/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login">Member Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<canvas id="canvas"></canvas>
<div id="wrapper">
</div>
<div class="center_caption">
    <div class="container">
        <div class="text-center">
            <div class="row col_sec">
                <div class="col pb-2">
                    <img class="img-fluid" src="assets/images/logo-round.png" alt="">
                </div>
            </div>
            <!-- <h1>Lemaconet</h1> -->
            <div class="row social pt-5 ">
                <div class="col">
                    <a target="_blank" href="https://www.facebook.com/lemaconet"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </div>
                <div class="col">
                    <a target="_blank" href="https://twitter.com/lemaconet?t=WpBgyonytod5S9ys7yVZ_w&s=08"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </div>
                <div class="col">
                    <a target="_blank" href="https://wa.me/94777522242"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                </div>
                <div class="col">
                    <a target="_blank" href="https://t.me/+hZiEU7uoprkzZTM1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                </div>
                <div class="col">
                    <a target="_blank" href="mailto:info@lemaconet.com"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                </div>

            </div>
        </div>
    </div>
</div>
@stop