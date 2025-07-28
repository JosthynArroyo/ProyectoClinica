<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />

    @vite(['resources/css/dashboards/admin.css', 'resources/js/dashboard-admin.js'])
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

                <!-- ADMIN Dashboard -->
                <a href="#">
                    <span class="material-symbols-outlined">grid_view</span>
                    <h3>Panel Principal</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">groups</span>
                    <h3>Gestión de Usuarios</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">event_available</span>
                    <h3>Citas Programadas</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">local_hospital</span>
                    <h3>Médicos</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">patient_list</span>
                    <h3>Pacientes</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <h3>Reportes</h3>
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
             <div class="date">
                <input type="date">
             </div>

           <div class="insights">
                <!--start selling-->
                   <div class="sales">
                      <span class="material-symbols-sharp">trending_up</span>
                        <div class="middle">
                          <div class="left">
                             <h3>Total</h3>
                             <h1>$50,0</h1>
                          </div>
                          <div class="progress">
                              <svg>
                                 <circle r="30" cy="40" cx="40"></circle>
                              </svg>
                              <div class="number">80%</div>
                          </div>
                        </div>
                        <small>Last 24 Hours</small>
                   </div>
                <!--start selling-->

           </div>
                      
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