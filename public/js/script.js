function EditarNota(idNota,nomeNota, descricao){

    document.getElementById('st_nomeNotaEdit').value = nomeNota
    document.getElementById('st_descricaoEdit').value = descricao
    document.getElementById('id_notaExameEdit').value = idNota
}

function mostrarNomeArquivo() {
    var input = document.getElementById('dropzone-file');
    var arquivos = input.files;
    var nomesArquivosElement = document.getElementById('nomesArquivos');

    nomesArquivosElement.innerHTML = '';

    if (arquivos.length > 0) {
        for (var i = 0; i < arquivos.length; i++) {
            var nomeDiv = document.createElement('div');
            nomeDiv.textContent = arquivos[i].name;
            nomesArquivosElement.appendChild(nomeDiv);
        }
    } else {
        nomesArquivosElement.innerText = 'Nenhum arquivo selecionado';
    }
}
