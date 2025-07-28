<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GSRI Denpasar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #00809D;
            --primary-light: #4da6c0;
            --primary-dark: #005c73;
            --primary-soft: rgba(0, 128, 157, 0.1);
            --primary-gradient: linear-gradient(135deg, #00809D 0%, #4da6c0 100%);
            --secondary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --white: #ffffff;
            --shadow: rgba(0, 128, 157, 0.15);
            --shadow-hover: rgba(0, 128, 157, 0.25);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            background: var(--primary-color);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            background: linear-gradient(135deg, #ff6b6b, #ff5252);
            color: white;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: none;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
            animation: slideInDown 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 20px 60px var(--shadow);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 80px var(--shadow-hover);
        }

        .image-side {
            background: var(--primary-gradient);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .image-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="50" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: backgroundMove 20s linear infinite;
        }

        @keyframes backgroundMove {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-50px, -50px);
            }
        }

        .image-side h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--white);
            text-align: center;
            margin-bottom: 16px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1;
            animation: slideInLeft 0.8s ease-out 0.2s both;
        }

        .image-side p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            line-height: 1.6;
            z-index: 1;
            animation: slideInLeft 0.8s ease-out 0.4s both;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-side {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .logo-single {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            border-radius: 16px;
            margin: 0 auto 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounceIn 0.8s ease-out 0.6s both;
            position: relative;
            overflow: hidden;
        }

        .logo-single::before {
            content: '⛪';
            font-size: 24px;
            color: white;
            z-index: 1;
        }

        .logo-single::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: rotate 3s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .form-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 40px;
            animation: fadeIn 0.8s ease-out 0.8s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .form-group {
            position: relative;
            margin-bottom: 32px;
            animation: slideInUp 0.6s ease-out both;
        }

        .form-group:nth-child(1) {
            animation-delay: 1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 1.2s;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            width: 100%;
            padding: 18px 20px 18px 50px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--white);
            box-shadow: 0 0 0 4px var(--primary-soft);
            transform: translateY(-2px);
        }

        .form-control:valid {
            border-color: #27ae60;
        }

        .form-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 18px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .form-control:focus+.form-icon {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        .form-label {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .form-control:focus+.form-icon+.form-label,
        .form-control:valid+.form-icon+.form-label {
            top: -8px;
            left: 16px;
            font-size: 12px;
            color: var(--primary-color);
            background: var(--white);
            padding: 0 8px;
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-container {
            text-align: center;
            animation: slideInUp 0.6s ease-out 1.4s both;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: var(--white);
            border: none;
            padding: 16px 48px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            min-width: 160px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px var(--shadow-hover);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .auth-card {
                grid-template-columns: 1fr;
                margin: 20px 0;
            }

            .image-side {
                padding: 40px 30px;
                text-align: center;
            }

            .image-side h1 {
                font-size: 1.6rem;
            }

            .image-side p {
                font-size: 1rem;
            }

            .form-side {
                padding: 40px 30px;
            }

            .form-title {
                font-size: 1.6rem;
                margin-bottom: 30px;
            }

            .form-group {
                margin-bottom: 24px;
            }

            .form-control {
                padding: 16px 18px 16px 45px;
                font-size: 15px;
            }

            .form-icon {
                left: 16px;
                font-size: 16px;
            }

            .form-label {
                left: 45px;
                font-size: 15px;
            }

            .btn-primary {
                padding: 14px 40px;
                font-size: 15px;
                min-width: 140px;
            }
        }

        @media (max-width: 480px) {
            .image-side h1 {
                font-size: 1.4rem;
            }

            .form-side {
                padding: 30px 20px;
            }

            .form-control {
                padding: 14px 16px 14px 40px;
            }

            .form-icon {
                left: 14px;
            }

            .form-label {
                left: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="background-animation">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>

    <main class="container">
        <div class="row">
            <div class="col">
                <!-- Flash Message -->
                <div class="alert" id="flashAlert" style="display: none;">
                    <i class="fas fa-exclamation-triangle"></i>
                    Username atau password salah. Silakan coba lagi.
                </div>

                <div class="auth-card">
                    <div class="image-side">
                        <h1>GEREJA SANTAPAN ROHANI INDONESIA DENPASAR</h1>
                        <p>Sistem Informasi<br>Pengelolaan Keuangan</p>
                    </div>

                    <div class="form-side">
                        <div class="logo-single"></div>
                        <h2 class="form-title">Login</h2>

                        <form id="loginForm">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" required>
                                <i class="fas fa-user form-icon"></i>
                                <label class="form-label">Username</label>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" required>
                                <i class="fas fa-lock form-icon"></i>
                                <label class="form-label">Password</label>
                            </div>

                            <div class="btn-container">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> LOGIN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Form validation and animation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = this.username.value.trim();
            const password = this.password.value.trim();

            if (!username || !password) {
                showFlashMessage('Mohon lengkapi semua field yang diperlukan.');
                return;
            }

            // Simulate login process
            const button = this.querySelector('.btn-primary');
            const originalText = button.innerHTML;

            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> LOADING...';
            button.style.pointerEvents = 'none';

            setTimeout(() => {
                // Simulate failed login for demo
                button.innerHTML = originalText;
                button.style.pointerEvents = 'auto';
                showFlashMessage('Username atau password salah. Silakan coba lagi.');
            }, 2000);
        });

        function showFlashMessage(message) {
            const alert = document.getElementById('flashAlert');
            alert.innerHTML = '<i class="fas fa-exclamation-triangle"></i> ' + message;
            alert.style.display = 'block';

            setTimeout(() => {
                alert.style.animation = 'slideInDown 0.5s ease-out reverse';
                setTimeout(() => {
                    alert.style.display = 'none';
                    alert.style.animation = 'slideInDown 0.5s ease-out';
                }, 500);
            }, 5000);
        }

        // Enhanced input interactions
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });

            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });
        });

        // Add subtle parallax effect on mouse move
        document.addEventListener('mousemove', function(e) {
            const shapes = document.querySelectorAll('.shape');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                shape.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });

        // Add typing animation to title
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';

            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize animations when page loads
        window.addEventListener('load', function() {
            const title = document.querySelector('.image-side h1');
            if (title) {
                const originalText = title.textContent;
                setTimeout(() => {
                    typeWriter(title, originalText, 80);
                }, 1000);
            }
        });
    </script>
</body>

</html>