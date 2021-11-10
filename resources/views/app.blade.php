<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/assets/img/Logo.jpeg" />
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" defer>
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet" defer>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" defer>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js" defer></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>


    <!-- Template Main JS File -->
    <script src="assets/js/main.js" defer></script>

    <!-- Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" defer>

    <!-- PWA -->
    <meta name="theme-color" content="#8BC34A" />
    <link rel="manifest" href="manifest.json">

</head>

<body class="antialiased">
    @inertia
</body>

</html>
<script src="{{ asset('./sw.js') }}"></script>
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('./sw.js');
    };
</script>


<script>
    notifyMe();
    
    function notifyMe() {
      Notification.requestPermission();
      // Comprobamos si el navegador soporta las notificaciones
      if (!("Notification" in window)) {
        alert("Este navegador no soporta las notificaciones del sistema");
      }
    
      // Comprobamos si ya nos habían dado permiso
      else if (Notification.permission === "granted") {
        // Si esta correcto lanzamos la notificación
        console.log("result");
    
          this.randomNotification("Ya estabas suscrito");
    
      }
    
      // Si no, tendremos que pedir permiso al usuario
      else if (Notification.permission === 'denied' || Notification.permission == 'default') {
        Notification.requestPermission(function (permission) {
          // Si el usuario acepta, lanzamos la notificación
          console.log("Entrp:)");
          if (permission === "granted") {
              this.randomNotification("Bienvenido");
          }
        });
      }
      // Finalmente, si el usuario te ha denegado el permiso y
      // quieres ser respetuoso no hay necesidad molestar más.
    }
    function spawnNotification(theBody,theIcon,theTitle) {
      var options = {
          body: theBody,
          icon: theIcon
      }
      var n = new Notification(theTitle,options);
      setTimeout(n.close.bind(n), 5000);
    }
    
    function randomNotification(titulo='Notificaciones de prueba') {
      var options = {
          body: 'Puedes cancelar cuando gustes',
          icon: 'Logo.png',
      }
      var n = new Notification(titulo,options);
      ///setTimeout(n.close.bind(n), 5000);
    }
    </script>