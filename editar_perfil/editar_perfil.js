document.getElementById('enviarsubmit').addEventListener('click', function(event) {
    event.preventDefault();
    
    const nome = document.getElementById("nome_id").value;
    const email = document.getElementById("email_id").value;
    const matricula = document.getElementById("matricula_id").value;

    // Validação básica de campos
    if (!email.includes("@")) {
        alert("O email deve conter '@'");
        return;
    }

    if (nome.trim() === "" || email.trim() === "") {
        alert("É necessário colocar informações válidas");
        return;
    }

    // Constrói o corpo da requisição como JSON
    const requestBody = {
        solicitacao: "adicionar",
        nome: nome,
        email: email,
        matricula: matricula
    };

    
    fetch('atualizar_perfil.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestBody)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erro na requisição: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Resposta do servidor:', data);
        if (data.sucesso) {
            alert(data.sucesso);
            window.location.replace(`../perfil/perfil.php`);
        } else if (data.erro) {
            alert(`Erro: ${data.erro}`);
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        alert('Ocorreu um erro ao tentar atualizar o perfil. Tente novamente.');
    });
});

document.getElementById("excluirsubmit").addEventListener("click", function() {
    document.getElementById("popup").style.display = "block";
});

document.getElementById("closePopup").addEventListener("click", function() {
    document.getElementById("popup").style.display = "none";
});

document.getElementById("botao_excluir_popup").addEventListener("click", function() {
    document.getElementById("popup").style.display = "none";
});
