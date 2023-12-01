@extends('components/basicComponent')
@section('title', 'Minha saúde')

@section('content')
    @include('components.navBar')
<div class="containerSistema">

    <div class="flex1 mt-2">
        <p style="margin-top: 15px; font-weight: 500; font-size: 18px">
            "Minha Saúde" é um sistema inovador de prontuários virtuais desenvolvido pelos estudantes Ayrla Costa, Danilo Silveira, Gustavo, Vinicius e Thiago Yuiti ao longo do semestre de 2023.2 na disciplina de Sistemas de Informação. Este sistema foi concebido para proporcionar transparência e acessibilidade aos usuários, permitindo-lhes um acesso prático aos seus registros médicos.
        </p>

        <p style="margin-top: 15px; font-weight: 500; font-size: 18px">
            Inicialmente, buscamos referências, como o artigo "Developing a Mobile App for Monitoring Medical Record Changes Using Blockchain: Development and Usability Study". As perguntas feitas aos participantes confirmaram a necessidade de sistemas de prontuários médicos que ofereçam maior transparência e controle sobre os dados dos usuários. O estudo identificou várias implementações baseadas em blockchain para o gerenciamento de registros médicos, mas muitas delas focam principalmente no armazenamento e compartilhamento de dados. No entanto, o estudo destacou uma abordagem interessante ao se concentrar na monitorização das mudanças nos documentos médicos.
        </p>
        <p style="margin-top: 15px; font-weight: 500; font-size: 18px">
            Posteriormente, realizamos pesquisas com diferentes pessoas para validar a necessidade identificada. Os resultados revelaram uma demanda real por um sistema de prontuário virtual. Observamos também relatos de pessoas que perderam ou esqueceram seus exames, evidenciando a importância de uma solução como a nossa. Muitos indivíduos expressaram desconfiança em relação aos hospitais para a guarda de suas informações pessoais.
        </p>
        <p style="margin-top: 15px; font-weight: 500; font-size: 18px">
            Conduzimos o processo de prototipagem do sistema no Figma, recebemos feedbacks sobre a usabilidade do usuário e realizamos diversos testes. Com base nessas avaliações, avançamos para o desenvolvimento do sistema. Agora, você está utilizando a versão final do nosso sistema. Agradecemos por escolher "Minha Saúde".
        </p>

    </div>
</div>
@endsection
