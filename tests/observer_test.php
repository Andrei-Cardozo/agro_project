<?php    
// INCLUDES — sempre no topo

require_once __DIR__ . '/../observers/observer.php';
require_once __DIR__ . '/../observers/notifier.php';
require_once __DIR__ . '/../observers/email_observer.php';

use Observers\Notifier;
use Observers\EmailObserver;

// PROCESSAMENTO DO FORM
if ($_POST) {

    $notifier = new Notifier();

    $email = $_POST['email'];
    $emailObserver = new EmailObserver($email);

    // registra observer no evento "Custo calculado"
    $notifier->registrar($emailObserver);

    // simula payload vindo do sistema
    $payload = ["crop" => "Milho", "custo" => 20000];

}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f3f6fa;
        padding: 40px;
        display: flex;
        justify-content: center;
    }

    .card {
        background: white;
        padding: 25px;
        width: 380px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .card h2 {
        margin-top: 0;
        text-align: center;
        color: #2c3e50;
        font-size: 22px;
        font-weight: bold;
    }

    label {
        display: block;
        margin-bottom: 6px;
        color: #34495e;
        font-weight: 600;
    }

    input[type="email"] {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #bdc3c7;
        margin-bottom: 15px;
        font-size: 16px;
    }

    input[type="email"]:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 4px rgba(52,152,219,0.4);
    }

    button {
        width: 100%;
        background: #3498db;
        color: white;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    button:hover {
        background: #2980b9;
    }

    .success {
        margin-top: 15px;
        padding: 10px;
        background: #d4edda;
        border-left: 4px solid #28a745;
        color: #155724;
        border-radius: 6px;
        font-size: 15px;
    }
</style>

<div class="card">
    <h2>Teste de Notificação (Observer)</h2>

    <form method="POST">
        <label>Seu email:</label>
        <input type="email" name="email" required>
        <button type="submit">Testar Notificação</button>
    </form>

    <?php if ($_POST): ?>
        <div class="success">
            Notificação enviada para: <strong><?= htmlspecialchars($_POST['email']) ?></strong>
        </div>
    <?php endif; ?>

    <br><br>
<a href="../index.php" 
   style="
      display:inline-block;
      padding:12px 22px;
      background:#1d76d2;
      color:#fff;
      text-decoration:none;
      border-radius:8px;
      font-weight:600;
      transition:0.25s;
      font-family:Arial,sans-serif;
   "
   onmouseover="this.style.background='#145ea8'"
   onmouseout="this.style.background='#1d76d2'"
>
   ⬅ Voltar ao Início
</a>

</div>
