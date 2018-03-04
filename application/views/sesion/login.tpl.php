<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($texts["title"]) ? $texts["title"] . "::" : ""; ?> SIPIMSS</title>
  <?php echo css('bootstrap.css'); ?>
  <?php echo js('captcha.js'); ?>
  <script type="text/javascript">
    var url = "<?php echo base_url(); ?>";
    var site_url = "<?php echo site_url(); ?>";
    var img_url_loader = "<?php echo base_url('assets/img/loader.gif'); ?>";
  </script>
  <?php echo js("jquery.js"); ?>
  <?php echo js("jquery.min.js"); ?>
  <?php echo js("jquery.ui.min.js"); ?>
  <?php echo js("bootstrap.js"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/font-awesome/css/font-awesome.css");?>">
  <?php echo css("control_escolar/login.css");?>
  <!-- Google Analytics -->
  <script>
    (function (i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-109411950-1', 'auto');
    ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->
</head>
<body>

  <div class="overlay">
  </div>
  <div class="leftcontent">
    <span class="ltitle">Sistema de seguimiento de cursos presenciales</span>
    <br>
    <span class="lcontent">
      <p>El IMSS cuenta con espacios educativos atendidos por profesoras y profesores con dedicación de tiempo completo a la formación y actualización de personal con actividades docentes. Entre sus labores, se incluye la investigación educativa a través de diferentes modalidades.</p>

      <p>Estos espacios están dirigidos a personal de salud, de los tres niveles de atención con funciones y/o actividades educativas. Con ellos se pretende, desde el ámbito educativo, contribuir, a mejorar la atención de las y los derechohabientes del IMSS.</p>
    </span>
  </div>
  <div class="sidebar">
    <div class="row">
      <div class="rlogos">
        <div class="col-sm-3">
          <center>
          <a href="http://innovacioneducativa.imss.gob.mx" target="_blank">
            <img img-responsive src="<?php echo asset_url(); ?>img/logos/die.png" height="70px" class="logos" alt="SIPIMSS" title="SIPIMSS" target="_blank"/>
          </a>
          </center>
        </div>
        <div class="col-sm-4">
          <center>
          <a href="http://educacionensalud.imss.gob.mx" target="_blank">
            <img img-responsive src="<?php echo asset_url(); ?>img/logos/imss.png" height="70px" class="logos" alt="SIPIMSS" title="SIPIMSS" target="_blank"/>
          </a>
          </center>
        </div>
        <div class="col-sm-3">
          <center>
          <a href="http://educacionensalud.imss.gob.mx/" target="_blank"> 
            <img img-responsive src="<?php echo asset_url(); ?>img/logos/ces.png" height="70px" class="logos" alt="SIPIMSS" title="SIPIMSS" target="_blank"/>
          </a>
          </center>
        </div>
      </div>
    </div>
    <br>
    <span class="rtitle">Login</span>
    <br>
    <br>
    <form>
      <input class="textinput" type="text" name="username" autofocus="autofocus" placeholder="Username">
      <br>
      <br>
      <input class="textinput" type="password" name="password" placeholder="Password">
      <br>
      <br>
      <button class="submit" type="submit">
        <img src="http://www.yachtsale.se/wp-content/themes/Yachtsales/images/arrow-right.png" height="24px" />
      </button>
    </form>
  </div>
</body>
</html>
