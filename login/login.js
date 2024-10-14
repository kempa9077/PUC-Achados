// CARREGUEI A PÁGINA HTML
document.addEventListener("DOMContentLoaded", () => {
    // ESTOU AGINDO SOBRE O FORMULÁRIO CHAMANDO ELE PELO ID - IDENTIFICANDO O SUBMIT
    document.getElementById("form1").addEventListener("submit", function(event) { // antes estava esperando o botão que n fazia nada correto, agora espera o formulario, devria funcuionar
        event.preventDefault(); // isso deve garantir que o evento defaout deja este
        var email = document.getElementById("email_id").value;
        var senha = document.getElementById("senha_id").value;
    
        console.log("Email: " + email);
        console.log("Senha: " + senha); 
    
        fetch('login.php', {
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
                window.location.href = '../home_logado/home_logado.html'; // ARRUMAR ESSE REDIRECIONAMENTO PRA PAGINA CORRETA, TA INDO PRA DE TESTE DE SESSAO
            } else {
                alert('Credenciais Invalidas');
            }
        })
        .catch(error => console.error('Erro:', error));
    });
});




