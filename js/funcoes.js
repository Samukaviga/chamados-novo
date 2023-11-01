function aberto () {
    const popupAberto = document.querySelector('#popup__lateral__aberto');
    const popupFecharAbertobt = document.querySelector('#popup__lateral__fechar__aberto');

    popupFecharAbertobt.addEventListener('click', (event) => {
        event.preventDefault();

        popupAberto.style.display = 'none';
    })

    const popuoAbrirAbertobt = document.querySelector('#popup__lateral__abrir__aberto');

    popuoAbrirAbertobt.addEventListener('click', (event) => {
        event.preventDefault();

        popupAberto.style.display = 'block';
    })
}

function andamento() {
        const popupAndamento = document.querySelector('#popup__lateral__andamento');
        const popupFecharAndamentobt = document.querySelector('#popup__lateral__fechar__andamento');

        popupFecharAndamentobt.addEventListener('click', (event) => {
            event.preventDefault();

            popupAndamento.style.display = 'none';
        })

        const popuoAbrirAndamentobt = document.querySelector('#popup__lateral__abrir__andamento');

        popuoAbrirAndamentobt.addEventListener('click', (event) => {
            event.preventDefault();

            popupAndamento.style.display = 'block';
     })
}

function concluido() {
        const popupConcluido = document.querySelector('#popup__lateral__concluido');
        const popupFecharConcluidoobt = document.querySelector('#popup__lateral__fechar__concluido');

        popupFecharConcluidoobt.addEventListener('click', (event) => {
            event.preventDefault();

            popupConcluido.style.display = 'none';
        })

        const popuoAbrirAndamentobt = document.querySelector('#popup__lateral__abrir__concluido');

        popuoAbrirAndamentobt.addEventListener('click', (event) => {
            event.preventDefault();

            popupConcluido.style.display = 'block';
     })
}

function engrenagem() {
    const engrenagemDiv = document.querySelector('#popup__engrenagem__abrir');
    const engrenagembt = document.querySelector('#mostrar__engrenagem');

    engrenagembt.addEventListener('click', (event) => {
        event.preventDefault();
        engrenagemDiv.style.display = 'block';
        event.stopPropagation(); // Impede a propagação do evento para o document
    });

    document.addEventListener('click', (event) => {
        engrenagemDiv.style.display = 'none';
    });
}

engrenagem();

andamento();

aberto();

concluido();