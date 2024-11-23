<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Landing Page</title>
    <style>
        /* Global Styles */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: #000;
            color: #fff;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        /* Navbar */
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: rgba(0, 0, 0, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        nav .brand {
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 2px;
        }
        
        nav ul {
            list-style: none;
            display: flex;
        }
        
        nav ul li {
            margin: 0 1rem;
        }
        
        nav ul li a {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }
        
        nav ul li a:hover {
            background: #fff;
            color: #000;
        }
        /* Hero Section */
        
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .hero button {
            padding: 0.8rem 2rem;
            font-size: 1rem;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        
        .hero button:hover {
            background: #000;
            color: #fff;
            transform: scale(1.1);
        }
        /* Lightning Effect */
        
        .lightning {
            position: absolute;
            top: 0;
            left: 50%;
            width: 2px;
            height: 100%;
            background: linear-gradient(white, rgba(255, 255, 255, 0.1));
            animation: flash 1s infinite ease-in-out;
            opacity: 0.7;
        }
        
        .lightning::before,
        .lightning::after {
            content: '';
            position: absolute;
            width: 2px;
            background: white;
            opacity: 0.7;
            transform: rotate(25deg);
            animation: flash 1s infinite ease-in-out;
        }
        
        .lightning::before {
            top: 30%;
            left: -10px;
            height: 20%;
        }
        
        .lightning::after {
            top: 60%;
            left: 10px;
            height: 25%;
        }
        
        @keyframes flash {
            0%,
            100% {
                opacity: 0;
                transform: scale(0.5);
            }
            50% {
                opacity: 1;
                transform: scale(1);
            }
        }
        /* Footer */
        
        footer {
            background: #111;
            color: #aaa;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            border-top: 1px solid #222;
        }
        
        footer a {
            color: #fff;
            transition: color 0.3s;
        }
        
        footer a:hover {
            color: #aaa;
        }
        /* Responsive */
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
            nav ul {
                flex-direction: column;
                display: none;
                background: #111;
                position: absolute;
                top: 100%;
                right: 0;
                width: 200px;
                padding: 1rem;
                border-radius: 5px;
            }
            nav ul.active {
                display: flex;
            }
            nav .menu-toggle {
                display: block;
                cursor: pointer;
            }
            nav .menu-toggle div {
                width: 25px;
                height: 3px;
                background: white;
                margin: 5px 0;
            }
        }
        
        @media (min-width: 769px) {
            nav .menu-toggle {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <a href="https://lodcreative.id/" class="brand" target="_blank">lod.</a>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul>
            <li><a href="https://lodcreative.id/">Home</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Regist</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero" id="hero">
        <div class="hero-content">
            <h1>Form Pengajuan Lembur</h1>
            <p>"Setiap menit yang kamu curahkan untuk kerja keras, adalah langkah menuju impianmu."</p>
            <button class="btn btn-primary w-100" id="btn-getstar">Get Started</button>
            <script> 
                 document.getElementById('btn-getstar').addEventListener('click', function() {
                    window.location.href = '{{ route("login") }}';
                });
            </script>

        </div>
        <div class="lightning"></div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Royhan Ibnu Mubarok. All Rights Reserved.</p>
    </footer>

    <script>
        // JavaScript for responsive menu
        document.querySelector('.menu-toggle').addEventListener('click', () => {
            document.querySelector('nav ul').classList.toggle('active');
        });
    </script>
</body>

</html>