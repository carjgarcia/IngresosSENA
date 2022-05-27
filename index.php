<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Ingreso Sena</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'><link rel="stylesheet" href="css/index.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--SWEETALERT 2 CON CSS-->
  <script src="assets/sweet/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="assets/sweet/sweetalert2.css">
</head>
<body>
<!-- partial:index.partial.html -->
    <!-- <div class="menu-responsive">
        <nav>
            <ul>
                <li><a class="scroll" href="#">Inicio</a></li>
                <li><a class="scroll" href="#about">Nosotros</a></li>
                <li><a class="scroll" href="login.html">Ingresar</a></li>
            </ul>
        </nav>
    </div> -->
   
    <header>
        <div class="container">
            <div class="row">
                <div class="header__top">
                    <div class="col-md-6 header__top-brand">
                        <h1><span class="bold">Ingreso</span> Sena</h1>
                        <hr>       
                    </div>
                    <!-- <nav class="col-md-6 header__top-nav hidden-md-down">
                        <ul>
                            <li><a class="scroll" href="#">Inicio</a></li>
                            <li><a class="scroll" href="#about">Nosotros</a></li>
                            <li><a class="scroll" href="login.php">Ingresar</a></li>
                            <button id="btnPrueba">ALERTA DE PRUEBA</button>
                            
                            
                        </ul>
                    </nav>
                    <nav class="col-md-6 header__top--responsive hidden-lg-up">
                        <ul>
                            <li><a class="menu-bars" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
                        </ul>
                    </nav> -->
                </div>
            </div>
            
            <div class="header__content">
                <p class="bold">¡Bienvenido Instructor!</p>
                <p>Una manera ágil y sencilla de registrar su actividad.</p>
                <a class="btn scroll" href="login.php">Ingresar</a>
            </div>
            
            <div class="header__arrow">
                <a class="scroll" href="#about"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
            </div>
            
        </div>                
    </header>
    
    <section id="about">
        <div class="container quienes-somos">
            <h2>Quienes Somos</h2>
            <hr>
            <img src="img/icons8-company-100.png" alt="Photo Cyril">
            <!-- <p class="lead">Freelance Designer & Developer</p> -->
            <!-- <p>I'm <span class="bold">Cyril</span> Gouverneur, a <strong>Designer</strong> and <strong>Front-end Developer</strong> from <a href="https://www.google.fr/maps/place/40600+Biscarrosse/@44.4026163,-1.2626371,34041m/data=!3m1!1e3!4m5!3m4!1s0xd54808242250a41:0x31362ef6d956cc21!8m2!3d44.3946602!4d-1.164218?hl=fr" target="_blank">Biscarosse</a>, France.</p> -->
            <p>En todo el país el SENA imparte formación relacionada con las Tecnologías de la Información y las Comunicaciones <span class="bold">(TIC)</span>. Actualmente, son <span class="bold">178 mil aprendices </span> activos en 30 programas de formación titulada y 336 cursos cortos.</p>
            <!-- <p>I love <strong>helping businesses</strong> of all size to build and improve their online presence.</p>
            <p>I <strong>Design</strong> and <strong>Develop</strong> modern and responsive website.</p>
            <p>Aside from development, I like learning languages, playing and waching sports.</p> -->
        </div>
    </section>

    <section id="imageSection">
        <div class="container containerInfoimage">
        </div>
    </section>
    
   <!--  <section id="skills">
        <div class="container">
            <h2>My Skills</h2>
            <hr>
            <div class="row">
                <div class="skill col-12 col-lg-6">
                    <div class="skills__percent">95%</div>
                    <div class="progress-container">
                        <strong>HTML / CSS</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 95%"></div>
                        </div>
                    </div>
                </div>
                <div class="skill col-12 col-lg-6">
                    <div class="skills__percent">80%</div>
                    <div class="progress-container">
                        <strong>JavaScript</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
                <div class="skill col-12 col-lg-6">
                    <div class="skills__percent">90%</div>
                    <div class="progress-container">
                        <strong>Photoshop</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
                <div class="skill col-12 col-lg-6">
                    <div class="skills__percent">85%</div>
                    <div class="progress-container">
                        <strong>Wordpress</strong>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    
    <section id="portfolio">
        <h2 style="font-size: 25px">Sede las Tecnologías de la Información y las Comunicaciones</h2>
        <hr>
        <div class="container">
            <div class="portfolio__projects">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <figure>
                            <figcaption>
                                <h3>Project Name</h3>
                                <p>Coming Soon</p>
                                <!-- <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i></a> -->
                            </figcaption>
                            <img src="img/bg_1.jpg">
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure>
                            <figcaption>
                                <h3>Project Name</h3>
                                <p>Coming Soon</p>
                                <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                            </figcaption>
                            <img src="img/bg_1.jpg">
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure>
                            <figcaption>
                                <h3>Project Name</h3>
                                <p>Coming Soon</p>
                                <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                            </figcaption>
                            <img src="img/bg_1.jpg">
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure>
                            <figcaption>
                                <h3>Project Name</h3>
                                <p>Coming Soon</p>
                                <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                            </figcaption>
                            <img src="img/bg_1.jpg">
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure>
                            <figcaption>
                                <h3>Project Name</h3>
                                <p>Coming Soon</p>
                                <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                            </figcaption>
                            <img src="img/bg_1.jpg">
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure>
                            <figcaption>
                                <h3>Project Name</h3>
                                <p>Coming Soon</p>
                                <a href="#"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                            </figcaption>
                            <img src="img/bg_1.jpg">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<!--     <section id="contact">
        <div class="container">
            <p class="lead">Do you like what you see ?</p>
            <p>Need a <span class="text-animate">web designer ?</span></p>
            <a class="btn" href="mailto:cyrilgouverneur@protonmail.com">Contact Me</a>
            
            <div class="contact__social">
                <a href="https://twitter.com/CyrilGouv" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://codepen.io/CyrilG" target="_blank"><i class="fa fa-codepen" aria-hidden="true"></i></a>
                <a href="https://github.com/Kiril03" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
            </div>
        </div>
    </section> -->
    
    <section id="footer">
        <p>Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Carlitos Garcia</a> <i class="fa fa-copyright" aria-hidden="true"></i>2022</p>
    </section>

<!-- partial -->
  <script src="js/alerta.js"></script>  
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src='https://unpkg.com/scrollreveal/dist/scrollreveal.min.js'></script><script  src="./js/index.js"></script>
   
</body>
</html>
