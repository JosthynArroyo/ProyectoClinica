<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Clínica Los Ángeles</title>
    <style>
        /* Reset y base */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7fafc;
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        a {
            text-decoration: none;
            cursor: pointer;
        }
        /* Header */
        header {
            background: linear-gradient(90deg, #4f46e5, #6366f1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 70px;
            display: flex;
            align-items: center;
            z-index: 100;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            color: #f3f4f6;
            font-weight: 700;
            font-size: 1.75rem;
            letter-spacing: 1.2px;
            user-select: none;
        }
        nav a {
            margin-left: 20px;
            font-weight: 600;
            font-size: 1rem;
            padding: 8px 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
            color: #d1d5db;
        }
        nav a:first-child {
            background: transparent;
            color: #cbd5e1;
            border: 2px solid transparent;
        }
        nav a:first-child:hover {
            color: #eef2ff;
            text-decoration: underline;
        }
        nav a:last-child {
            background: #e0e7ff;
            color: #3730a3;
            border: 2px solid #c7d2fe;
            font-weight: 700;
        }
        nav a:last-child:hover {
            background: #c7d2fe;
            color: #312e81;
            border-color: #4f46e5;
        }

        /* Hero */
        main {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://images.unsplash.com/photo-1576765607928-236edb2617c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            padding-top: 70px;
            min-height: calc(100vh - 70px);
            position: relative;
        }
        main::before {
            content: "";
            position: absolute;
            top:0; left:0; right:0; bottom:0;
            background: rgba(79, 70, 229, 0.6);
            z-index: 0;
        }
        .hero-content {
            position: relative;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px 50px;
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.2);
            text-align: center;
            z-index: 1;
            animation: fadeInUp 1s ease forwards;
        }
        .hero-content h2 {
            font-size: 2.75rem;
            font-weight: 800;
            color: #3730a3;
            margin-bottom: 20px;
            line-height: 1.1;
            letter-spacing: 0.03em;
        }
        .hero-content p {
            font-size: 1.15rem;
            color: #4b5563;
            margin-bottom: 32px;
            line-height: 1.5;
        }
        .btn-primary {
            background-color: #4f46e5;
            color: white;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 8px 15px rgba(79, 70, 229, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            user-select: none;
        }
        .btn-primary:hover {
            background-color: #4338ca;
            box-shadow: 0 10px 20px rgba(67, 56, 202, 0.6);
        }

        /* Footer */
        footer {
            background-color: #f9fafb;
            text-align: center;
            padding: 16px 12px;
            font-size: 0.9rem;
            color: #6b7280;
            user-select: none;
            box-shadow: inset 0 1px 0 #e5e7eb;
        }

        /* Animations */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content {
                padding: 30px 25px;
                max-width: 90vw;
            }
            .hero-content h2 {
                font-size: 2rem;
            }
            nav a {
                margin-left: 12px;
                padding: 6px 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Clínica Los Ángeles</h1>
        <nav>
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn-primary">Registrarse</a>
        </nav>
    </div>
</header>

<main>
    <div class="hero-content" role="main" aria-label="Bienvenida a Clínica Los Ángeles">
        <h2>Bienvenido a la Clínica Los Ángeles</h2>
        <p>Agenda tus citas médicas fácilmente desde casa. Un sistema rápido, seguro y personalizado para ti.</p>
        <a href="{{ route('login') }}" class="btn-primary" role="button" aria-label="Comenzar sesión">Comenzar</a>
    </div>
</main>

<footer>
    © {{ date('Y') }} Clínica Los Ángeles. Todos los derechos reservados.
</footer>

</body>
</html>
