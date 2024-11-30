<!DOCTYPE html>
<html lang="es">
<head>
  	<link rel="icon" type="image/png" href="img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CecyFriends</title>
    <!-- Bootstrap y Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=M+PLUS+Rounded+1c:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Logo" class="logo">
            </a>
        </div>
    </header>

    <!-- Login Section -->
    <main class="hero-section d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header form-header text-white text-center py-4">
                            <h2 class="hero-title mb-0">Bienvenido</h2>
                            <p class="hero-subtitle">Accede a tu cuenta o regístrate</p>
                            <div class="alert alert-danger d-none" id="error-message" role="alert"></div>
                            <div class="alert alert-success d-none" id="success-message" role="alert"></div>
                        </div>
                        <div class="card-body p-4">
                            <form id="login-form" action="php/login.php" method="post" style="display: block;">
                                <div class="form-group mb-3">
                                    <label for="login-email" class="form-label">Email Institucional</label>
                                    <input type="email" class="form-control" id="login-email" name="login-email" placeholder="ejemplo@cecyteq.edu.mx" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="login-password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="login-password" name="login-password" placeholder="••••••••" required>
                                </div>
                                <button type="submit" class="btn btn-primary-cta btn-block w-100">Iniciar Sesión</button>
                            </form>
                            <form id="register-form" action="php/register.php" method="post" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="register-name" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="register-name" name="register-name" 
                                        placeholder="Ingresa tu nombre completo" 
                                        required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,100}$" 
                                        title="El nombre debe contener solo letras y espacios, entre 3 y 100 caracteres.">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="register-email" class="form-label">Email Institucional</label>
                                    <input type="email" class="form-control" id="register-email" name="register-email" 
                                        placeholder="ejemplo@cecyteq.edu.mx" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="register-phone" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="register-phone" name="register-phone" 
                                        placeholder="10 dígitos" pattern="[0-9]{10}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="matricula" class="form-label">Matrícula Escolar</label>
                                    <input type="text" class="form-control" id="matricula" name="matricula" 
                                        placeholder="Ingresa tu matrícula" 
                                        maxlength="15" minlength="15" 
                                        required pattern="\d{15}" 
                                        title="La matrícula debe contener exactamente 15 caracteres numéricos.">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="register-password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="register-password" name="register-password" 
                                        placeholder="••••••••" required>
                                </div>
                                <button type="submit" class="btn btn-primary-cta btn-block w-100">Crear Cuenta</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <button id="toggle-btn" class="btn btn-link">¿No tienes una cuenta? <span id="toggle-text">Regístrate</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; 2024 CecyFriends | Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/cecyfriends.js"></script>
</body>
</html>
