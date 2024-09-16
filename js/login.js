// Adiciona um ouvinte de evento ao botão de login
document.getElementById("enviar").addEventListener("click", function() {
    var email = document.getElementById("email_id").value; // Obtém o valor do campo de e-mail
    var senha = document.getElementById("senha_id").value; // Obtém o valor do campo de senha

    // Envia uma requisição POST para o login.php
    fetch('../php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        // Codifica os parâmetros para envio
        body: `email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`
    })
    .then(response => response.text()) // Converte a resposta para texto
    .then(data => {
        if (data === 'success') { // Verifica se a resposta indica sucesso
            // Redireciona para original_professor.html em caso de login bem-sucedido
            window.location.href = 'original_professor.html';
        } else {
            // Exibe uma mensagem de erro se o login falhar
            alert('Login falhou. Verifique suas credenciais e tente novamente.');
        }
    })
    .catch(error => console.error('Erro:', error)); // Loga erros no console
});
