<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    @vite(['resources/css/dashboards/doctor.css', 'resources/js/dashboard-doctor.js'])
</head>
<body>
    <div class="container">
        <!--aside section start-->
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>Clínica<span class="danger">Los Angeles</span></h2>
                </div>
                <div class="close">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>
            <!--end top-->

            <div class="sidebar">

            
                <!-- DOCTOR Dashboard -->
                <a href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Inicio</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">event</span>
                    <h3>Mis Citas</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">patient_list</span>
                    <h3>Mis Pacientes</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">assignment</span>
                    <h3>Historia Clínica</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">chat</span>
                    <h3>Mensajes</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Configuración</h3>
                </a>
                <a href="{{ route('salir') }}">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Salir</h3>
                </a>


                

                
            </div>
            

        </aside>
        <!--aside section end-->

        <!--main section start-->
        <main>
            <h1>Dashboard</h1>
        </main>
        <!--main section end-->

        <!--right section start-->
            <div class="right">
                  <h1>right</h1>
            </div>
        <!--end right section-->
    </div>
</body>
</html>
