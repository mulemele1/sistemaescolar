<?php require_once "Class.class.php";
$usuario = new usuario;
$aluno = new aluno;
if (isset($_POST['nome_aluno'])) {
    $foto = "img/user.webp"; // Valor padrão para a foto

    // Verifica se o arquivo foi enviado corretamente e se o tamanho é menor ou igual a 2MB
    if (isset($_FILES["url_foto"]) && $_FILES["url_foto"]['error'] == UPLOAD_ERR_OK) {
        if ($_FILES["url_foto"]['size'] <= 2 * 1024 * 1024) { // 2MB em bytes
            $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
            if (in_array($_FILES["url_foto"]['type'], $allowed_types)) {
                $foto = upload_imagem($_FILES["url_foto"]);
                if (!$foto) {
                    echo "<p class='text-center alert alert-warning'>Erro ao fazer upload da imagem.</p>";
                    $foto = "img/user.webp"; // Usa a imagem padrão em caso de erro
                }
            } else {
                echo "<p class='text-center alert alert-warning'>Tipo de arquivo não permitido.</p>";
            }
        } else {
            echo "<p class='text-center alert alert-warning'>O arquivo de imagem deve ter no máximo 2MB.</p>";
        }
    }

    // Sanitização dos dados de entrada
    $nome_aluno = filter_input(INPUT_POST, 'nome_aluno', FILTER_SANITIZE_STRING);
    $data_nascimento_aluno = filter_input(INPUT_POST, 'data_nascimento_aluno', FILTER_SANITIZE_STRING);
    // Repita para os outros campos...

    // Inserção do aluno
    $id_aluno = $aluno->inserir_aluno(
        $_POST['tipo_documento'], $_POST['nr_documento'], $_POST['local_de_emissao'], $nome_aluno, 
        $_POST['apelido_aluno'], $_POST['nacionalidade_aluno'], $_POST['naturalidade_aluno'], 
        $data_nascimento_aluno, $_POST['validade_documento_inicial_aluno'], $_POST['sexo_aluno'], 
        $_POST['bairro'], $_POST['quarteirao'], $_POST['casa'], $_POST['rua_avenida'], 
        $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['nome_do_pai'], 
        $_POST['nome_da_mae'], $_POST['email'], $foto, $_POST['recibo'], 
        $_POST['data_deposito'], $_POST['valor_inscricao'], $_POST['valor_mensalidade']
    );

    if ($id_aluno) {
        // Verifica se a classe/turma foi fornecida
        if (isset($_POST['classe_turma']) && strlen($_POST['classe_turma']) > 1) {
            $aluno->matricula($id_aluno, $_POST['classe_turma']);
        }

        // Inserção do usuário
        $nr_aluno = isset($_POST['nr_aluno']) ? $_POST['nr_aluno'] : '';
        $usuario->inserir_usuario(
            $nome_aluno . ' ' . $_POST['apelido_aluno'], 
            $nr_aluno, 6, "12345678a", $id_aluno
        );

        echo "<p class='text-center alert alert-success'>Aluno cadastrado com sucesso!</p>";
    } else {
        echo "<p class='text-center alert alert-danger'>Erro ao cadastrar aluno. Por favor, tente novamente.</p>";
    }


}elseif (isset($_POST['nome_professor'])) {
	
$professor = new professor;
    $foto="img/user.webp";
    if($professor->verifica_existencia($_POST['nr_documento'], $_POST['telefone'], $_POST['email'])==1){
        if (($_FILES["url_foto"]['size'])>2) {
                function upload_imagem($file)
                {
                    if (isset($file)) {
                        $extensao=explode('.', $file["name"]);
                        $novo_nome=rand().'.'.$extensao[1];
                        $foto='../uploads/fotos/'.$novo_nome;
                        move_uploaded_file($file['tmp_name'],$foto);
                        $foto='uploads/fotos/'.$novo_nome;
                        return $foto;
                    }
                }
                $foto=upload_imagem($_FILES["url_foto"]);
                
        }

        if($professor->inserir_professor($_POST['tipo_documento'], $_POST['nr_documento'], $_POST['local_de_emissao'], $_POST['nome_professor'], $_POST['apelido_professor'], $_POST['nacionalidade_professor'], $_POST['naturalidade_professor'], $_POST['data_nascimento_professor'], $_POST['validade_documento_inicial_professor'], $_POST['sexo_professor'], $_POST['bairro'], $_POST['quarteirao'], $_POST['casa'], $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['email'], $foto)==1){
            $usuario->inserir_usuario($_POST['nome_professor'].' '.$_POST['apelido_professor'], $_POST['email'], 5, "p12345678", $professor->ultimo_id()-1);
            $url="professores.php";
            echo "<p class='text-center alert alert-success'>Professor cadastrado com sucesso!</p>";
        }
    }
}elseif (isset($_POST['nome_funcionario'])) {
    
$funcionario = new funcionario;
    $foto="img/user.webp";
    if (($_FILES["url_foto"]['size'])>2) {
            function upload_imagem($file)
            {
                if (isset($file)) {
                    $extensao=explode('.', $file["name"]);
                    $novo_nome=rand().'.'.$extensao[1];
                    $foto='../uploads/fotos/'.$novo_nome;
                    move_uploaded_file($file['tmp_name'],$foto);
                    $foto='uploads/fotos/'.$novo_nome;
                    return $foto;
                }
            }
            $foto=upload_imagem($_FILES["url_foto"]);
            
    }
    if($funcionario->inserir_funcionario($_POST['tipo_documento'], $_POST['nr_documento'], $_POST['local_de_emissao'], $_POST['nome_funcionario'], $_POST['apelido_funcionario'], $_POST['nacionalidade_funcionario'], $_POST['naturalidade_funcionario'], $_POST['data_nascimento_funcionario'], $_POST['validade_documento_inicial_funcionario'], $_POST['sexo_funcionario'], $_POST['bairro'], $_POST['quarteirao'], $_POST['casa'], $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['email'], $_POST['id_funcao'], $foto)==1){
        
        $usuario->inserir_usuario($_POST['nome_funcionario'].' '.$_POST['apelido_funcionario'], $_POST['email'], 3, "p12345678", $funcionario->ultimo_id()-1);
        $url="funcionarios.php";
            echo "<p class='text-center alert alert-success'>Funcionário cadastrado com sucesso!</p>";
    }

}elseif (isset($_POST['classe_insercao'])) {
    
$administracao = new administracao;
    
    $administracao->inserir_classe($_POST['nome_classe']);

}elseif (isset($_POST['fazer_pagamento'])) {
    
$administracao = new administracao;
    
    $administracao->fazer_pagamento($_POST['nr_aluno'],$_POST['Mes'],$_POST['Estado'],$_POST['recibo'],$_POST['data_deposito']);

}elseif (isset($_POST['anular_pagamento'])) {
    
$administracao = new administracao;
    
    $administracao->anular_pagamento($_POST['nr_aluno'],$_POST['Mes'],$_POST['recibo']);

}elseif (isset($_POST['definicoes'])) {
    
$administracao = new administracao;
    
    $administracao->inserir_professor_disciplina($_POST['nr_disciplina'], $_POST['nr_professsor'], date('Y'));

}elseif (isset($_POST['turma_insercao'])) {
    
$administracao = new administracao;
    
    $administracao->inserir_turma($_POST['nome_turma'], $_POST['classe_turma'], $_POST['duracao_turma'], $_POST['formato_turma'], $_POST['numero_sessoes_formato']);

}elseif (isset($_POST['disciplina_insercao'])) {
    
$administracao = new administracao;
    
    $administracao->inserir_disciplina($_POST['nome_disciplina'], $_POST['nr_turma'], $_POST['carga_horaria'], $_POST['creditos'], $_POST['sessao']);

}elseif(isset($_POST['Usuario_insercao'])){
    $usuario = new usuario;
    $usuario->inserir_usuario($_POST['nome'],$_POST['usuario'],$_POST['id_nivel_acesso'],$_POST['senha'], 0);
}elseif(isset($_POST['novo_teste'])){
    $teste = new teste;
    $teste->novo_teste($_POST['nr_disciplina'],$_POST['descricao'],$_POST['data_teste'],$_POST['hora_teste'],$_POST['duracao'],$_POST['nota_maxima'],$_POST['obs']);
}elseif(isset($_POST['novo_trabalho'])){
    $trabalho = new trabalho;
    $trabalho->novo_trabalho($_POST['nr_disciplina'],$_POST['descricao'],$_POST['data_limite_entrega'],$_POST['nota_maxima'],$_POST['obs']);
}elseif(isset($_POST['nova_pergunta'])){
    $teste = new teste;
    $teste->nova_pergunta($_POST['nr_teste'],$_POST['nota'],$_POST['pergunta'],$_POST['a'],$_POST['b'],$_POST['c'],$_POST['d'],$_POST['opcao_correcta'],$_POST['tipo_pergunta']);
}elseif(isset($_POST['novo_anexo'])){
    $trabalho = new trabalho;
    if (($_FILES["anexo"]['size'])>2) {
                function upload_file($file)
                {
                    if (isset($file)) {
                        $extensao=explode('.', $file["name"]);
                        $novo_nome=rand().'.'.$extensao[1];
                        $anexo='../uploads/trabalhos/'.$novo_nome;
                        move_uploaded_file($file['tmp_name'],$anexo);
                        $anexo='uploads/trabalhos/'.$novo_nome;
                        return $anexo;
                    }
                }
                $anexo=upload_file($_FILES["anexo"]);
                
        }
    $trabalho->novo_anexo($_POST['nr_trabalho'], $_POST['nome_anexo'], $anexo);
}