document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("form1").addEventListener("submit", function(event) {
        event.preventDefault(); 
        var email = document.getElementById("email_id").value;
        var senha = document.getElementById("senha_id").value;

        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `email_id=${encodeURIComponent(email)}&senha_id=${encodeURIComponent(senha)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); 
            if (data === 'nivel_0') {
                window.location.href = '../index.php'; // pagina pro user 0
            } else if (data === 'nivel_1') {
                window.location.href = '../index.php'; // pagina pro fun 1
            } else if (data === 'nivel_2') {
                window.location.href = '../index.php'; // pagina pro adm 2
            } else {
                alert('Credenciais Inválidas');
            }
        })
        .catch(error => console.error('Erro:', error));
    });
});
