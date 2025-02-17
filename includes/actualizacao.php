<?php require_once "Class.class.php";
if(isset($_POST['nome_professor'])){
	$professor = new professor;
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
                $professor->actualizar_foto_professor($foto, $_POST['nr_professor']);
        }
        $professor->actualizar_professor($_POST['nr_professor'], $_POST['tipo_documento'], $_POST['nr_documento'], $_POST['local_de_emissao'], $_POST['nome_professor'], $_POST['apelido_professor'], $_POST['nacionalidade_professor'], $_POST['naturalidade_professor'], $_POST['data_nascimento_professor'], $_POST['validade_documento_inicial_professor'], $_POST['sexo_professor'], $_POST['bairro'], $_POST['quarteirao'], $_POST['casa'], $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['email']);
}elseif (isset($_POST['classe_edicao'])) {
    
$administracao = new administracao;
    
    $administracao->actualizar_classe($_POST['nr_classe'], $_POST['nome_classe']);

}elseif (isset($_POST['edicao_turma'])) {
    
$administracao = new administracao;
    
    $administracao->actualizar_turma($_POST['nr_turma'], $_POST['nome_turma'], $_POST['classe_turma'], $_POST['duracao_turma'], $_POST['formato_turma'], $_POST['numero_sessoes_formato']);

}elseif (isset($_POST['edicao_disciplina'])) {
    
$administracao = new administracao;
    
    $administracao->actualizar_disciplina($_POST['nr_disciplina'], $_POST['nome_disciplina'], $_POST['nr_turma'], $_POST['carga_horaria'], $_POST['creditos'], $_POST['sessao']);

}elseif(isset($_POST['edicao_usuario'])){
    $usuario = new usuario;
    $usuario->actualizar_usuario($_POST['id_usuario'], $_POST['nome'], $_POST['usuario'], $_POST['id_nivel_acesso'], $_POST['senha']);
}elseif(isset($_POST['nome_aluno'])){
    $aluno = new aluno;
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
                $aluno->actualizar_foto_aluno($foto, $_POST['nr_aluno']);
        }
        $aluno->actualizar_matricula($_POST['nr_aluno'], $_POST['classe_turma']);
        $aluno->actualizar_aluno($_POST['nr_aluno'], $_POST['tipo_documento'], $_POST['nr_documento'], $_POST['local_de_emissao'], $_POST['nome_aluno'], $_POST['apelido_aluno'], $_POST['nacionalidade_aluno'], $_POST['naturalidade_aluno'], $_POST['data_nascimento_aluno'], $_POST['validade_documento_inicial_aluno'], $_POST['sexo_aluno'], $_POST['bairro'], $_POST['quarteirao'], $_POST['casa'], $_POST['rua_avenida'], $_POST['telefone'], $_POST['telefone_alternativo'], $_POST['email'], $_POST['classe_turma']);
}
