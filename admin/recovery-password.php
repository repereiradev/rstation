
<?php
	$conn = new mysqli("localhost", "root", "xd", "rockstation", "3308");
session_start();

// Função para verificar o login
function login($email, $pw, $conn)
{
    $email = mysqli_real_escape_string($conn, $email);
    $pw = mysqli_real_escape_string($conn, $pw);

    // Consulta para verificar o usuário no banco de dados
    $query = "SELECT id, email FROM users WHERE email = '$email' AND pw = '$pw'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Usuário autenticado com sucesso
        $row = $result->fetch_assoc();

        // Armazenando informações na sessão
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];

        return true;
    } else {
        // Falha na autenticação
        return false;
    }
}

// Exemplo de uso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pw = $_POST['pw'];

    if (login($email, $pw, $conn)) {
        // Redirecionar para a página de sucesso ou fazer outras operações necessárias
        header("Location: dashboard\dashboard.php");
        exit();
    } else {
        // Exibir mensagem de erro
        $error_message = "Login falhou. Verifique suas credenciais.";
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>



<!doctype html>
<html lang="pt">
  <head>
    <title>Rock Station</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.2/components/logins/login-1/assets/css/login-1.css" />
  </head>
  <body>
    <!-- Login 1 - Bootstrap Brain Component -->
    <div class="bg-light py-3 py-md-5 py-xl-8">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
            <div class="bg-white p-4 p-md-5 rounded shadow-sm">
              <div class="row">
                <div class="col-12">
                  <div class="text-center mb-5">
                    <a href="#!">
                      <img src="..\assets\img\profile-img.png" alt="" width="175" height="175">
                    </a>
                  </div>
                </div>
              </div>
              <form action="" method="post">
                <div class="row gy-3 gy-md-4 overflow-hidden">
                  <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                          <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                        </svg>
                      </span>
                      <input type="email" class="form-control" name="email"  required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn btn-primary btn-lg" type="submit">Recuperar Password</button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-12">
                  <hr class="mt-5 mb-4 border-secondary-subtle">
                  <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center">
                    <a href="index.php" class="link-secondary text-decoration-none">Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
