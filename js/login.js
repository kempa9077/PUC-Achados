document.getElementById("enviar").addEventListener("click", function() {
    var email = document.getElementById("email_id").value;
    var senha = document.getElementById("senha_id").value;

    console.log("Email: " + email);
    console.log("Senha: " + senha); 

    fetch('../php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email_id=${encodeURIComponent(email)}&senha_id=${encodeURIComponent(senha)}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // era pra eu ver oque está retornando do PHP
        if (data === 'success') {
            window.location.href = '../php/teste_sessao.php';
        } else {
            alert('Login falhou. Pq vc é burro e quebrou algo');
        }
    })
    .catch(error => console.error('Erro:', error));
});
