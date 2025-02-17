<?php

if (!isset($_SESSION)) {
    session_start();
}

/**
 * 
 */
abstract class conexao {
  public function connect(){
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=sigma","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
      echo "Connection Error ! ".$e->getMessage();
    }
  }
}

class sessao extends conexao {

    public function valida_login($usuario,$senha) {
        $query = "SELECT *,`tabela_nivel_acesso`.`nome_nivel_acesso` FROM tabela_usuarios JOIN tabela_nivel_acesso ON `tabela_usuarios`.`id_nivel_acesso` = `tabela_nivel_acesso`.`id_nivel_acesso` WHERE `tabela_usuarios`.`usuario`= ? AND `tabela_usuarios`.`senha`= ? LIMIT 1";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$usuario,$senha]);
        $flag=0;
        while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['ultimo_acesso']      = Date('Y-m-d');
            $_SESSION['idUsuario']      = $rs['id_usuario'];
            $_SESSION['usuarioNome']    = $rs['nome'];
            $_SESSION['usuarioSenha']     = $rs['senha'];
            $_SESSION['usuarioLogin']     = $rs['usuario'];
            $_SESSION['usuarioNivelAcesso'] = $rs['id_nivel_acesso'];
            $_SESSION['nome_nivel_acesso'] = $rs['nome_nivel_acesso'];
            $_SESSION['f_key'] = $rs['f_key'];
            
            if($_SESSION['usuarioNivelAcesso'] > 0){
              $flag++;
              header("Location: painel_inicial.php");
            }   
        }
        if ($flag>0) {
            $_SESSION['activa']=1;
        }else{
            $_SESSION['loginErro'] = "<p id='erro' style='color: red' align='center'>Usuário ou Senha Inválido</p><br><br>";
            header("Location: index.php");
        }
          
    }

}

class administracao extends conexao {

   
    public function select_turmas() {
        $query = "SELECT nr_turma,nome_turma FROM turma";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_turma'] ."'>". $linhas['nome_turma'] ."</option>";
        }
        return $out;
    }

    public function select_classe_turma() {
        $query = "SELECT * FROM turma JOIN classe ON turma.classe_turma = classe.nr_classe";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_turma'] ."'>". $linhas['nome_classe'] .' '. $linhas['nome_turma'] ."</option>";
        }
        return $out;
    }

   public function select_sessoes($q) {
        $query = "SELECT numero_sessoes_formato, formato_turma FROM turma WHERE nr_turma = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        $numero_sessoes_formato = $rs['numero_sessoes_formato'];
        $formato_turma="";
        if ($rs['formato_turma']=="Semestral") {
                $formato_turma="Semestre";
            }elseif ($rs['formato_turma']=="Trimestral") {
                $formato_turma="Trimestre";
            }elseif ($rs['formato_turma']=="Modular") {
                $formato_turma="Modulo";
            }
        $out = "";
        $count=1;
        while ($numero_sessoes_formato>=$count) {
            $out .= "<option value='". $count ."'>". $count ."</option>";
            $count++;
        }
        return $out;
    }

    public function formato_turma($nr_turma) {
        $query = "SELECT formato_turma FROM turma WHERE $nr_turma = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_turma]);
        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        $formato_turma="";
        if ($rs['formato_turma']=="Semestral") {
                $formato_turma="Semestre";
            }elseif ($rs['formato_turma']=="Trimestral") {
                $formato_turma="Trimestre";
            }elseif ($rs['formato_turma']=="Modular") {
                $formato_turma="Modulo";
            }
        return $formato_turma;
    }

    public function ultimo_id_turma() {
        $query = "SELECT max(nr_turma) AS ultimo FROM turma";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_turmas() {
        $query = "SELECT COUNT(nr_turma) AS total_turmas FROM turma";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_turmas'];
    }

    public function listar_turmas($q) {
        if($q=="" OR $q==null){
            $query = "SELECT * FROM turma JOIN classe ON `turma`.`classe_turma` = `classe`.`nr_classe`";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
        }else{

            $query = "SELECT * FROM turma JOIN classe ON `turma`.`classe_turma` = `classe`.`nr_classe` WHERE `turma`.`classe_turma` = ? ";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$q]);
        }
        
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $out .= "<div class='col-xl-4 col-md-4 mb-4'>
                        <div class='card shadow mb-4'>
                            <div class='card-header  d-flex flex-row '>
                                <p><div class='col m-0 p-0 font-weight-bold text-primary align-items-start' >" . $rs['nome_turma'] . "</div><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='' class='text-warning' title='Editar' data-toggle='modal' data-target='#editar_turma". $rs['nr_turma'] ."' ><i class='fas fa-pen fa-fw'></i></a></span></p>
                            </div> 
                            <div class='card-body'>
                            
                                <div class='row no-gutters align-items-center'>
                                    <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Classe: <b>" . $rs['nome_classe'] . "</b> </div>"; 
            $out .= "
                                    </div>
                                </div>     
                            </div>
                            
                        </div>
                    </div>
                <div class='modal fade' id='editar_turma". $rs['nr_turma']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Editar Turma</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='turma_submit_edicao' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>

                                    <input type='hidden' id='controlador' name='edicao_turma'>
                                    <div class='row'>
                                        <div class='col-md-3'>

                                            <label>#</label>
                                            <input type='number' readonly='' class='input-xs form-control in' name='nr_turma' maxlength='70' value='". $rs['nr_turma']. "' placeholder='Codigo' required='' >
                                        </div>  
                                        <div class='col-md-9'>
                                            <label>Turma</label>
                                            <input type='text' class='input-xs form-control in' required='' name='nome_turma' maxlength='70' value='". $rs['nome_turma']. "' placeholder='Nome do Turma' required='' >
                                        </div> 

                                    </div> 
                                    <div class='row' hidden>
                                        <div class='col-md-9'>
                                            <label>Classe</label>
                                            <select name='classe_turma' id='classe_turma1' required='' class='input-xs form-control in' style=''>
                                                <option value='". $rs['nr_classe']. "'>". $rs['nome_classe']. "</option>
                                                ".$this->select_classes()."
                                            </select>
                                        </div>  

                                        <div class='col-md-3'>

                                            <label>Duração</label>
                                            <input type='' class='input-xs form-control in' required='' name='duracao_turma' maxlength='1' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='". $rs['duracao_turma']. "' placeholder='Duração' >
                                        </div>  
                                    </div> 
                                    <div class='row' hidden>
                                        <div class='col-md-9'>
                                            <label>Formato do turma</label>
                                            <select name='formato_turma' required='' class='input-xs form-control in' style=''>
                                                <option value='". $rs['formato_turma']. "'>". $rs['formato_turma']. "</option>
                                                <option value='Modular'>Modular</option>
                                                <option value='Semestral'>Semestral</option>
                                                <option value='Trimestral'>Trimestral</option>
                                            </select>
                                        </div>  

                                        <div class='col-md-3'>
                                            <label>Sessões</label>
                                            <input type='text' required='' class='input-xs form-control in' name='numero_sessoes_formato' id='numero_sessoes_formato1' maxlength='2' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='". $rs['numero_sessoes_formato']. "' placeholder='Sessões' >
                                        </div>  
                                    </div> 
                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' id='ok1' name='ok1' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
                ";
        }
        return $out;
    }

    public function listar_disciplinas($q) {
        $professor= new professor;
        if($q=="" OR $q==null){

            $query = "SELECT * FROM disciplina JOIN turma ON `disciplina`.`nr_turma` = `turma`.`nr_turma`";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
        }else{

            $query = "SELECT * FROM disciplina JOIN turma ON `disciplina`.`nr_turma` = `turma`.`nr_turma` WHERE `disciplina`.`nr_turma`= ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$q]);
        }
        
        $out = "";
        $sessao="";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($rs['formato_turma']=="Semestral") {
                $sessao="Semestre";
            }elseif ($rs['formato_turma']=="Trimestral") {
                $sessao="Trimestre";
            }elseif ($rs['formato_turma']=="Modular") {
                $sessao="Modulo";
            }
            $out .= "<div class='col-xl-4 col-md-4 mb-4'>
                        <div class='card shadow mb-4'>
                            <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                                <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_disciplina'] . "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a data-toggle='modal' data-target='#editar_disciplina". $rs['nr_disciplina'] ."'  class='text-warning' title='Editar'><i class='fas fa-pen fa-fw'></i></a><a data-toggle='modal' data-target='#settings". $rs['nr_disciplina'] ."' title='Configurações'><i class='fas fa-cog fa-fw'></i></a></span>
                            </div> 
                            <div class='card-body'>
                            
                                <div class='row no-gutters align-items-center'>
                                    <div class='col mr-2'>";/*
            $out .= "<div class='h6 mb-0  text-gray-800'>Créditos: <b>" . $rs['creditos'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Carga Horária: <b>" . $rs['carga_horaria'] . " Horas</b> </div>";*/
            $out .= "<div class='h6 mb-0  text-gray-800'>Turma: <b>" . $rs['nome_turma'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Professor: <b>" . $this->q_professor_disciplina($rs['nr_disciplina']) . "</b> </div>";
            $out .= "
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div><div class='modal fade' id='editar_disciplina". $rs['nr_disciplina']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Editar Disciplina</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='disciplina_submit_edicao' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>

                                    <input type='hidden' id='controlador' name='edicao_disciplina'>
                                    <div class='row'>
                                        <div class='col-md-3'>

                                            <label>#</label>
                                            <input type='number' readonly='' class='input-xs form-control in' name='nr_disciplina' maxlength='70' value='". $rs['nr_disciplina']. "' placeholder='Codigo' required='' >
                                        </div>  
                                        <div class='col-md-9'>
                                            <label>Disciplina</label>
                                            <input type='text' class='input-xs form-control in' required='' name='nome_disciplina' maxlength='70' value='". $rs['nome_disciplina']. "' placeholder='Nome do Turma' required='' >
                                        </div> 

                                    </div> 
                                    <div class='row' hidden>
                                        <div class='col-md-6'>
                                            <label >Turma</label>
                                            <select name='nr_turma' id='nr_turma' required='' class='input-xs form-control in'>
                                                <option value='". $rs['nr_turma']. "'>". $rs['nome_turma']. "</option>
                                                ".$this->select_turmas()."
                                            </select>
                                        </div>  

                                        <div class='col-md-3'>
                                            <label >Carga Horária</label>
                                            <input type='text' class='input-xs form-control in' name='carga_horaria' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='". $rs['carga_horaria']. "' placeholder='Carga Horaria' >
                                        </div> 

                                        <div class='col-md-3'>
                                            <label >Créditos</label>
                                            <input type='text' class='input-xs form-control in' name='creditos' maxlength='1' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='". $rs['creditos']. "' placeholder='Créditos' >
                                        </div>  
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' name='ok' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
                <div class='modal fade' id='settings". $rs['nr_disciplina']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Definições</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='settings' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>

                                    <input type='hidden' id='controlador' name='definicoes'>
                                    <div class='row'>
                                        <div class='col-md-3'>

                                            <label>#</label>
                                            <input type='number' readonly='' class='input-xs form-control in' name='nr_disciplina' maxlength='70' value='". $rs['nr_disciplina']. "' placeholder='Codigo' required='' >
                                        </div>  
                                        <div class='col-md-9'>
                                            <label>Disciplina</label>
                                            <input type='text' readonly class='input-xs form-control in' required='' name='nome_disciplina' maxlength='70' value='". $rs['nome_disciplina']. "' placeholder='Nome do Turma' required='' >
                                        </div> 

                                    </div> 
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <label >Professor</label>
                                            <select name='nr_professsor' required='' class='input-xs form-control in'>
                                                ".$this->select_professor_disciplina($rs['nr_disciplina'])."
                                                ".$professor->select_professores ()."
                                            </select>
                                        </div>  

                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' name='ok' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
                ";
        }
        return $out;
    }

    public function ultimo_id_disciplina() {
        $query = "SELECT max(nr_disciplina) AS ultimo FROM disciplina";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_disciplinas() {
        $query = "SELECT COUNT(nr_disciplina) AS total_disciplinas FROM disciplina";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_disciplinas'];
    }

    public function select_disciplina() {
        $query = "SELECT * FROM disciplina";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_disciplina'] ."'>". $linhas['nome_disciplina'] ."</option>";
        }
        return $out;
    }

    public function inserir_disciplina($a, $b, $c, $d, $f) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `disciplina`(`nome_disciplina`, `nr_turma`, `carga_horaria`, `creditos`, `criado_por`) VALUES(?,?,?,?,?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$a, $b, $c, $d, $usuario_logado])) {
            echo "<p class='text-center alert alert-success'>Disciplina adicionada com sucesso!</p>";

        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }

    }/*

    public function inserir_disciplina($a, $b, $c, $d, $f) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `disciplina`(`nome_disciplina`, `nr_turma`, `carga_horaria`, `creditos`, `criado_por`) VALUES(?,?,?,?,?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$a, $b, $c, $d, $usuario_logado])) {
            echo "<p class='text-center alert alert-success'>Disciplina adicionada com sucesso!</p>";

        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }

    }
*/


    public function q_professor_disciplina($q) {
        $query = "SELECT id_disciplina_professor, professor.nr_professor as nr_p, nome_professor, nr_disciplina, ano FROM disciplina_professor JOIN professor ON disciplina_professor.nr_professor=professor.nr_professor WHERE nr_disciplina = ? LIMIT 1";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        $linhas = $stmt->fetch(PDO::FETCH_ASSOC);
            $out = @$linhas['nome_professor'];
        return $out;
    }
    public function inserir_professor_disciplina($nr_disciplina, $nr_professsor, $ano) {
        $usuario_logado = $_SESSION['idUsuario'];

        $query1 = "SELECT * FROM disciplina_professor WHERE nr_disciplina = ?";
        $stmt1 = $this->connect()->prepare($query1);
        $stmt1->execute([$nr_disciplina]);
        $flag = 0;
        while ($linhas = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $flag=1;
        }
        if($flag==0){
            $query = "INSERT INTO `disciplina_professor`(`nr_disciplina`, `nr_professor`, `ano`, `criado_por`) VALUES(?,?,?,?) ";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute([$nr_disciplina, $nr_professsor, $ano, $usuario_logado])==true) {
                echo "<p class='text-center alert alert-success'>Professor adicionado com sucesso!</p>";

            } else {
                    echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
            } 
        }elseif($flag==1) {
                $query = "UPDATE `disciplina_professor` SET `nr_professor` = ?, `modificado_por` = ? WHERE `nr_disciplina` = ?";
                $stmt = $this->connect()->prepare($query);
                if ($stmt->execute([$nr_professsor, $usuario_logado, $nr_disciplina])) {
                    echo "<p class='text-center alert alert-success'>Configurações efectuadas com sucesso!</p>";

                } else {
                    echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
                }
        }
        echo "<meta http-equiv='refresh' content='3'>";
    }


    public function actualizar_disciplina($nr_disciplina, $nome_disciplina, $nr_turma, $carga_horaria, $creditos, $sessao) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `disciplina` SET `nome_disciplina` = ? , `nr_turma` = ? , `carga_horaria` = ? , `creditos` = ? , `sessao` = ? , `modificado_por` = ? WHERE nr_disciplina = ?";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome_disciplina, $nr_turma, $carga_horaria, $creditos, $sessao, $usuario_logado, $nr_disciplina])) {
            echo "<p class='text-center alert alert-success'>Dados da Disciplina actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
    public function verifica_recibo($q) {
        $query = "SELECT * FROM conf_mensalidades WHERE recibo = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        if($stmt->rowCount() == 0){
            $query = "SELECT * FROM inscricao_detalhes WHERE recibo = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$q]);
            if($stmt->rowCount() == 0){
                return 1;
            } else {
                echo "<p class='text-center text-capitalize alert alert-danger'>Erro: Este número de recibo já foi usado no sistema!</p>";
            }
        } else {
            echo "<p class='text-center text-capitalize alert alert-danger'>Erro: Este número de recibo já foi usado no sistema!</p>";
        }
    }
    public function criar_aluno_mensalidade($q) {
        $query = "SELECT * FROM mensalidades WHERE nr_aluno = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        if($stmt->rowCount() == 0){
            $query = "INSERT INTO `mensalidades`(`nr_aluno`, `Fev`, `Mar`, `Abr`, `Mai`, `Jun`, `Jul`, `Ago`, `Sete`, `Outu`, `Nov`, `Ano`) VALUES ('$q',0,0,0,0,0,0,0,0,0,0,?)";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([date('y')]);
            if($stmt->execute()){
                return 1;
            } else {
                echo "<p class='text-center text-capitalize alert alert-danger'>Erro: " . $stmt->error . "!</p>";
            }
        } 
    }
    public function fazer_pagamento($nr_aluno, $Mes, $Estado, $recibo, $data_deposito) {
        if ($this->verifica_recibo($recibo)==1) {
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "INSERT INTO `conf_mensalidades`(`nr_aluno`, `mes`, `recibo`, `data_deposito`, `ano`, `criado_por`) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute([$nr_aluno, $Mes, $recibo, $data_deposito, date('Y'), $usuario_logado])) {
                $this->criar_aluno_mensalidade($nr_aluno);
                $query = "UPDATE mensalidades SET $Mes = 1 WHERE mensalidades.nr_aluno = '$nr_aluno' AND Ano=?";
                $stmt = $this->connect()->prepare($query);
                if ($stmt->execute([date('Y')])) {
                    echo "<p class='text-center alert alert-success'>Pagamento efectuado com sucesso!</p>";
                } else {
                    echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
                }
            } else {
                echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
            }
        } else {
            $this->verifica_recibo($recibo);
        } 
    }

    public function anular_pagamento($nr_aluno, $Mes, $recibo) {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "DELETE FROM `conf_mensalidades` WHERE nr_aluno = ? AND recibo = ?";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute([$nr_aluno, $recibo])) {
                $query = "UPDATE mensalidades SET $Mes = 0 WHERE mensalidades.nr_aluno = '$nr_aluno' AND Ano=?";
                $stmt = $this->connect()->prepare($query);
                if ($stmt->execute([date('Y')])) {
                    echo "<p class='text-center alert alert-success'>Pagamento anulado com sucesso!</p>";
                } else {
                    echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
                }
            } else {
                echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
            } 
    }
    public function coleta_mes($Mes) {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "SELECT SUM( `inscricao_detalhes`.`valor_mensalidade`) as total_mes FROM `conf_mensalidades` JOIN inscricao_detalhes ON conf_mensalidades.nr_aluno=inscricao_detalhes.nr_aluno WHERE mes=?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$Mes]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total_mes'];
    }

    public function coleta_ano() {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "SELECT SUM( `inscricao_detalhes`.`valor_inscricao`) as total_ano FROM inscricao_detalhes";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total_ano'];
    }
    public function coleta_mensalidades() {
        
            $usuario_logado = $_SESSION['idUsuario'];
            $query = "SELECT SUM( `inscricao_detalhes`.`valor_mensalidade`) as total_ano FROM `conf_mensalidades` JOIN inscricao_detalhes ON conf_mensalidades.nr_aluno=inscricao_detalhes.nr_aluno";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total_ano'];
    }

    public function inserir_turma($a, $b, $c, $d, $e) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `turma`(`nome_turma`, `classe_turma`, `duracao_turma`, `formato_turma`, `numero_sessoes_formato`,  `criado_por`) VALUES(?,?,?,?,?,?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$a, $b, $c, $d, $e, $usuario_logado])) {
            echo "<p class='text-center alert alert-success'>Turma adicionada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
        echo "<meta http-equiv='refresh' content='3'>";
    }



    public function actualizar_turma($nr_turma, $nome_turma, $classe_turma, $duracao_turma, $formato_turma, $numero_sessoes_formato) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `turma` SET `nome_turma` = ?, `classe_turma` = ?, `duracao_turma` = ?, `formato_turma` = ?, `numero_sessoes_formato` = ?,  `modificado_por` = ? WHERE `nr_turma` = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome_turma, $classe_turma, $duracao_turma, $formato_turma, $numero_sessoes_formato, $usuario_logado, $nr_turma])) {
            echo "<p class='text-center alert alert-success'>Actualização dos dados do Turma efectuadas com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }



    public function pesquisa_classes($q) {
        $query = "SELECT nr_classe,nome_classe FROM classe WHERE nr_classe=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_classe'] ."'>". $linhas['nome_classe'] ."</option>";
        }
        return $out;
    }


    public function select_classes() {
        $query = "SELECT nr_classe,nome_classe FROM classe";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_classe'] ."'>". $linhas['nome_classe'] ."</option>";
        }
        return $out;
    }

    public function ultimo_id_classe() {
        $query = "SELECT max(nr_classe) AS ultimo FROM classe";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_classes() {
        $query = "SELECT COUNT(nr_classe) AS total_classes FROM classe";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_classes'];
    }

    public function listar_classes() {
        $query = "SELECT * FROM classe";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $query1="SELECT COUNT(nr_turma) as total_turmas FROM `turma` WHERE `classe_turma` = ?";
            $stmt1 = $this->connect()->prepare($query1);
            $stmt1->execute(([$rs['nr_classe']]));
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);
            $out .= "<div class='col-xl-4 col-md-4 mb-4'>
                        <div class='card shadow mb-4'>
                            <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                                <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_classe'] . "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a type='button' class='text-warning btn' title='Editar' data-title='Editar Classe' data-toggle='modal' data-target='#editar_classe". $rs['nr_classe'] ."' ><i class='fas fa-pen fa-fw'></i></a></span>
                            </div> 
                            <div class='card-body'>
                            
                                <div class='row no-gutters align-items-center'>
                                    <div class='col mr-2'>";/*
            $out .= "<div class='h6 mb-0  text-gray-800'>Codigo: <b>" . $rs['nr_classe'] . "</b> </div>";*/
            $out .= "<div class='h6 mb-0  text-gray-800'>Número de turmas: <b>" .  $row['total_turmas'] . "</b> 
                            <a href='turmas.php?q=".$rs['nr_classe']."' title='Ver'>
                                <button type='button' class='btn btn-light btn-xs'>
                                    <i class='text-danger fas fa-eye aria-hidden='true'></i> 
                                </button>                               
                            </a> </div>";
            $out .= "
                                    </div>
        						</div>     
                            </div>
                           
                        </div>
                    </div>
                <div class='modal fade' id='editar_classe". $rs['nr_classe']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Editar Classe</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='classe_submit_edicao' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>

                                    <input type='hidden' name='classe_edicao'>
                                    <div class='row'>
                                        <div class='col-md-3'>
                                            <input type='text' readonly='' class='input-xs form-control in' name='nr_classe' maxlength='70' value='". $rs['nr_classe'] ."' placeholder='Codigo' required='' >
                                        </div>  
                                        <div class='col-md-9'>
                                            <input type='text' class='input-xs form-control in' name='nome_classe' maxlength='70' value='". $rs['nome_classe'] ."' placeholder='Nome da Classe' required='' >
                                        </div> 

                                    </div>  
                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' name='editar' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
                ";
        }
        return $out;
    }

    public function inserir_classe($f) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `classe`(`nome_classe`, `criado_por`) VALUES(?,?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$f, $usuario_logado])) {
            echo "<p class='text-center alert alert-success'>Classe adicionada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function actualizar_classe($nr_classe,$nome_classe) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `classe` SET `nome_classe`= ? , `modificado_por`= ? WHERE `nr_classe`= ?";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome_classe, $usuario_logado, $nr_classe])) {
            echo "<p class='text-center alert alert-success'>Actualização efectuada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

}

class aluno extends conexao {

    public function total_alunos() {
        $query = "SELECT COUNT(nr_aluno ) AS total_alunos FROM aluno";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_alunos'];
    }

    public function ultimo_id() {
        $query = "SELECT max(nr_aluno ) AS ultimo FROM aluno";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }


    public function actualizar_foto_aluno($url_foto, $nr_aluno)
    {
        $query = "UPDATE `aluno` SET url_foto = ? where nr_aluno = ?"; 
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$url_foto, $nr_aluno]);
        
    }


    public function actualizar_aluno($nr_aluno, $tipo_documento, $nr_documento, $local_de_emissao, $nome_aluno, $apelido_aluno, $nacionalidade_aluno, $naturalidade_aluno, $data_nascimento_aluno, $validade_documento_inicial_aluno, $sexo_aluno, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $nr_turma) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `aluno` SET tipo_documento = ?, nr_documento = ?, local_de_emissao = ?, nome_aluno=?, apelido_aluno=?, nacionalidade_aluno = ?, naturalidade_aluno = ?, data_nascimento_aluno = ?, validade_documento_inicial_aluno=?, sexo_aluno=?, bairro = ?, quarteirao = ?, casa = ?, rua_avenida=?, telefone=?, telefone_alternativo = ?, email = ?, modificado_por=? where nr_aluno = ?"; 
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $local_de_emissao, $nome_aluno, $apelido_aluno, $nacionalidade_aluno, $naturalidade_aluno, $data_nascimento_aluno, $validade_documento_inicial_aluno, $sexo_aluno, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $usuario_logado, $nr_aluno])) {
            $url="alunos.php";
            
            echo "<p class='text-center alert alert-success'>Dados actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function pegar_dados_alunos($nr_aluno) {
        $query = "SELECT * FROM `aluno` WHERE `nr_aluno` = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_aluno]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function matricula($nr_aluno, $classe_turma) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `matricula`(`nr_aluno`, `nr_turma`, `ano`, `criado_por`) VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_aluno, $classe_turma, date('Y'), $usuario_logado])) {
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function actualizar_matricula($nr_aluno, $nr_turma) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `matricula` SET `nr_turma` = ?, `modificado_por` = ? WHERE nr_aluno = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_turma, $usuario_logado, $nr_aluno])) {
            if ($stmt->rowCount()<1) {
                $this->matricula($nr_aluno, $nr_turma);
            }
            return 1;
        } else {

            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }


    public function q_matricula($nr_aluno) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "SELECT * FROM `matricula` JOIN turma ON turma.nr_turma= matricula.nr_turma JOIN classe ON classe.nr_classe= turma.classe_turma WHERE `nr_aluno`= ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_aluno]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }


    public function listar_alunos() {/*
        $query = "SELECT * FROM aluno JOIN matricula ON aluno.nr_aluno= matricula.nr_aluno JOIN turma ON turma.nr_turma= matricula.nr_turma JOIN classe ON classe.nr_classe= turma.classe_turma";*/
        $query = "SELECT * FROM aluno";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rs2=$this->q_matricula($rs['nr_aluno']);
                $out .= "<tr>";
                $out .= "<td>" . $rs['nome_aluno'] .' '. $rs['apelido_aluno'] . "</td>";
                $out .= "<td>" . $rs['bairro'] . "</td>";
                $out .= "<td>" . $rs['telefone'] . "</td>";
                $out .= "<td>" . $rs['sexo_aluno'] . "</td>";
                $out .= "<td>" . @$rs2['nome_classe'] . ' ' . @$rs2['nome_turma'] . "</td>";
                $out .= "<td>
                                
                                 <a href='aluno-ver.php?q=". $rs['nr_aluno'] ."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a>
                            </td>";
                $out .= "</tr>

                ";
        }
        return $out;
    }

    public function inserir_aluno($tipo_documento, $nr_documento, $local_de_emissao, $nome_aluno, $apelido_aluno, $nacionalidade_aluno, $naturalidade_aluno, $data_nascimento_aluno, $validade_documento_inicial_aluno, $sexo_aluno, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $nome_do_pai, $nome_da_mae, $email, $url_foto, $recibo, $data_deposito, $valor_inscricao, $valor_mensalidade) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `aluno`(`tipo_documento`, `nr_documento`, `local_de_emissao`, `nome_aluno`, `apelido_aluno`, `nacionalidade_aluno`, `naturalidade_aluno`, `data_nascimento_aluno`, `validade_documento_inicial_aluno`, `sexo_aluno`, `bairro`, `quarteirao`, `casa`, `rua_avenida`, `telefone`, `telefone_alternativo`, `nome_do_pai`, `nome_da_mae`, `email`, `url_foto`, `criado_por`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $local_de_emissao, $nome_aluno, $apelido_aluno, $nacionalidade_aluno, $naturalidade_aluno, $data_nascimento_aluno, $validade_documento_inicial_aluno, $sexo_aluno, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $nome_do_pai, $nome_da_mae, $email, $url_foto, $usuario_logado])) {
            $query_incricao="INSERT INTO `inscricao_detalhes`(`nr_aluno`, `recibo`, `valor_inscricao`, `valor_mensalidade`, `data_deposito`, `criado_por`) VALUES (?,?,?,?,?,?)";
            $stmt_incricao = $this->connect()->prepare($query_incricao);
            $stmt_incricao->execute([$this->ultimo_id()-1, $recibo, $valor_inscricao, $valor_mensalidade, $data_deposito, $usuario_logado]);
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}

class professor extends conexao {
    public function verifica_existencia($nr_documento , $telefone, $email)
    {
        $query = "SELECT * FROM professor WHERE `nr_documento`='$nr_documento'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $query = "SELECT * FROM professor WHERE `telefone`='$telefone'";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() == 0){
                $query = "SELECT * FROM professor WHERE `email`='$email'";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute();
                if($stmt->rowCount() == 0){

                    return 1;
                    
                } else{
                    echo "<p class='text-center alert alert-danger'>Erro: O email inserido já existe no sistema </p>";
                }

            } else{
                echo "<p class='text-center alert alert-danger'>Erro: O celular inserido já existe no sistema </p>";
            }
        } else{
            echo "<p class='text-center alert alert-danger'>Erro: O aluno com este número de documento já existe no sistema </p>";
        }
    }
    public function ultimo_id() {
        $query = "SELECT max(nr_professor ) AS ultimo FROM professor";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_professores() {
        $query = "SELECT COUNT(nr_professor ) AS total_professores FROM professor";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_professores'];
    }


    // update data
    public function mudar_estado($nr_professor) {
        $query = "SELECT * FROM professor WHERE nr_professor = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_professor]);
        $estado='';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $estado= $row['estado'];
        }
        if ($estado=='0') {
            $estado='1';
        }else{
            $estado='0';
        }
        $query1 = "UPDATE professor SET estado = ? where nr_professor = ? ";
        $stmt1 = $this->connect()->prepare($query1);
        if ($stmt1->execute([$estado])) {
            $url="professores.php";
            
            echo "<p class='text-center alert alert-success'>Estado altera!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function listar_professores() {
        $query = "SELECT * FROM professor WHERE `estado`='1'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow mb-4 h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_professor'].' '.$rs['apelido_professor']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='professor-ver.php?q=". $rs['nr_professor'] ."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                                                    
                </div> 
                <div class='card-body'>
                    <img src=" . $rs['url_foto'] . " class='img-fluid card-img card-' alt=''>
                    <div class='row no-gutters align-items-center'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Disciplina(s) :<b>" . '' . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Celular :<b>" . $rs['telefone'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>E-mail :<b>" . $rs['email'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
                    
                </div> 
            </div>";

        }
        return $out;
    }



    public function pegar_dados_professores($nr_professor) {
        $query = "SELECT * FROM `professor` WHERE `nr_professor` = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$nr_professor]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function inserir_professor($tipo_documento, $nr_documento, $local_de_emissao, $nome_professor, $apelido_professor, $nacionalidade_professor, $naturalidade_professor, $data_nascimento_professor, $validade_documento_inicial_professor, $sexo_professor, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $url_foto) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `professor`(`tipo_documento`, `nr_documento`, `local_de_emissao`, `nome_professor`, `apelido_professor`, `nacionalidade_professor`, `naturalidade_professor`, `data_nascimento_professor`, `validade_documento_inicial_professor`, `sexo_professor`, `bairro`, `quarteirao`, `casa`, `rua_avenida`, `telefone`, `telefone_alternativo`, `email`, `url_foto`, `criado_por`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $local_de_emissao, $nome_professor, $apelido_professor, $nacionalidade_professor, $naturalidade_professor, $data_nascimento_professor, $validade_documento_inicial_professor, $sexo_professor, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $url_foto, $usuario_logado])) {
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function actualizar_foto_professor($url_foto, $nr_professor)
    {
        $query = "UPDATE `professor` SET url_foto = ? where nr_professor = ?"; 
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$url_foto, $nr_professor]);
        
    }



    public function select_professores () {
        $query = "SELECT * FROM  professor";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<option value='". $linhas['nr_professor'] ."'>". $linhas['nome_professor'] ."</option>";
        }
        return $out;
    }


    public function actualizar_professor($nr_professor, $tipo_documento, $nr_documento, $local_de_emissao, $nome_professor, $apelido_professor, $nacionalidade_professor, $naturalidade_professor, $data_nascimento_professor, $validade_documento_inicial_professor, $sexo_professor, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE `professor` SET tipo_documento = ?, nr_documento = ?, local_de_emissao = ?, nome_professor=?, apelido_professor=?, nacionalidade_professor = ?, naturalidade_professor = ?, data_nascimento_professor = ?, validade_documento_inicial_professor=?, sexo_professor=?, bairro = ?, quarteirao = ?, casa = ?, rua_avenida=?, telefone=?, telefone_alternativo = ?, email = ?, modificado_por=? where nr_professor = ?"; 
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $local_de_emissao, $nome_professor, $apelido_professor, $nacionalidade_professor, $naturalidade_professor, $data_nascimento_professor, $validade_documento_inicial_professor, $sexo_professor, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $usuario_logado, $nr_professor])) {
            $url="professores.php";
            
            echo "<p class='text-center alert alert-success'>Dados actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}


class funcionario extends conexao {

    public function ultimo_id() {
        $query = "SELECT max(nr_funcionario ) AS ultimo FROM funcionario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ultimo'] + 1;
    }

    public function total_funcionarios() {
        $query = "SELECT COUNT(nr_funcionario ) AS total_funcionarios FROM funcionario";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_funcionarios'];
    }

    public function listar_funcionarios() {
        $query = "SELECT * FROM funcionario JOIN funcao ON `funcionario`.`id_funcao` = `funcao`.`id_funcao`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>" . $rs['nome_funcionario'].' '.$rs['apelido_funcionario']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='funcionario-ver.php?q=". $rs['nr_funcionario'] ."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                </div> 
                <div class='card-body'>
                    <img src=" . $rs['url_foto'] . " class='img-fluid card-img card-' alt=''>
                    <div class='row no-gutters align-items-center'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Função :<b>" . $rs['funcao'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Celular :<b>" . $rs['telefone'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>E-mail :<b>" . $rs['email'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
        return $out;
    }

    public function inserir_funcionario($tipo_documento, $nr_documento, $local_de_emissao, $nome_funcionario, $apelido_funcionario, $nacionalidade_funcionario, $naturalidade_funcionario, $data_nascimento_funcionario, $validade_documento_inicial_funcionario, $sexo_funcionario, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email,  $id_funcao, $url_foto) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `funcionario`(`tipo_documento`, `nr_documento`, `local_de_emissao`, `nome_funcionario`, `apelido_funcionario`, `nacionalidade_funcionario`, `naturalidade_funcionario`, `data_nascimento_funcionario`, `validade_documento_inicial_funcionario`, `sexo_funcionario`, `bairro`, `quarteirao`, `casa`, `rua_avenida`, `telefone`, `telefone_alternativo`, `email`, `id_funcao`, `url_foto`, `criado_por`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$tipo_documento, $nr_documento, $local_de_emissao, $nome_funcionario, $apelido_funcionario, $nacionalidade_funcionario, $naturalidade_funcionario, $data_nascimento_funcionario, $validade_documento_inicial_funcionario, $sexo_funcionario, $bairro, $quarteirao, $casa, $rua_avenida, $telefone, $telefone_alternativo, $email, $id_funcao, $url_foto, $usuario_logado])) {
            return 1;
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}



class teste extends conexao {


    public function listar_perguntas($q) {
        $query = "SELECT * FROM perguntas_teste WHERE perguntas_teste.nr_teste = ? ORDER BY nr_pergunta";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        $count=0;
        $out .= "<div class='col-md-12 list-group mb-1 ml-0' style='padding-bottom:15px;'>";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $count++;
            $out .= "   <div class='list-group-item list-group-item-action'> 
                            <div class='row'>
                                <div class='col-md-10'><b>".$count.'. '.$rs['pergunta']."</b></div>
                                <div class='col-md-2 text-right'><b>".$rs['nota']."V</b></div>
                            </div>";

            if ($rs['tipo_pergunta']==2) {
                $a="";
                $b="";
                $c="";
                $d="";
                if ($rs['opcao_correcta']=="a") {
                    $a="alert-success";
                }
                if ($rs['opcao_correcta']=="b") {
                    $b="alert-success";
                }
                if ($rs['opcao_correcta']=="c") {
                    $c="alert-success";
                }
                if ($rs['opcao_correcta']=="d") {
                    $d="alert-success";
                }
                $out .= "   <div class='row m-2'>
                                <div class='col-md-3 alert ".$a."'>a).".$rs['a']." </div>
                                <div class='col-md-3 alert ".$b."'>b).".$rs['b']." </div>
                                <div class='col-md-3 alert ".$c."'>c).".$rs['c']." </div>
                                <div class='col-md-3 alert ".$d."'>d).".$rs['d']." </div>
                            </div>";
            }
                $out.="</div>";
        }
        $out.="</div><br>";
        return $out;
    }



    public function listar_perguntas_alunos($q) {
        $query = "SELECT * FROM perguntas_teste WHERE perguntas_teste.nr_teste = ? ORDER BY nr_pergunta";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        $count=0;
        $out .= "<div class='col-md-12 list-group mb-1 ml-0' style='padding-bottom:15px;'>";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $count++;
            $out .= "   <div class='list-group-item list-group-item-action'> 
                            <div class='row'>
                                
                                <div class='col-md-10'><b>".$count.'. '.$rs['pergunta']."</b></div>
                                <div class='col-md-2 text-right'><b>".$rs['nota']."V</b></div>
                            </div>";

            if ($rs['tipo_pergunta']==2) {
                $a="";
                $b="";
                $c="";
                $d="";
                /*if ($rs['opcao_correcta']=="a") {
                    $a="alert-success";
                }
                if ($rs['opcao_correcta']=="b") {
                    $b="alert-success";
                }
                if ($rs['opcao_correcta']=="c") {
                    $c="alert-success";
                }
                if ($rs['opcao_correcta']=="d") {
                    $d="alert-success";
                }*/
                $out .= "   <div class='row m-2'>
                                <div class='col-md-3 alert ".$a."' ><span  style='cursor:pointer;'>a).".$rs['a']."</span> </div>
                                <div class='col-md-3 alert ".$b."' ><span  style='cursor:pointer;'>b).".$rs['b']."</span> </div>
                                <div class='col-md-3 alert ".$c."' ><span  style='cursor:pointer;'>c).".$rs['c']."</span> </div>
                                <div class='col-md-3 alert ".$d."' ><span  style='cursor:pointer;'>d).".$rs['d']."</span> </div>
                            </div>";
            }else{
                $out .= "   <div class='row m-2'>
                                <div class='col-md-12'><textarea class='input-xs form-control in' name='resposta".$rs['pergunta']."'></textarea></div>
                            </div>";
            }
                $out.="</div>";
        }
        $out.="</div><br>";
        return $out;
    }


    public function novo_teste($nr_disciplina, $descricao, $data_teste, $hora_teste, $duracao, $nota_maxima, $obs) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `teste`( `nr_disciplina`, `descricao`, `data_teste`, `hora_teste`, `duracao`, `nota_maxima`, `obs`, `criado_por`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_disciplina, $descricao, $data_teste, $hora_teste, $duracao, $nota_maxima, $obs, $usuario_logado])) {
            echo "<meta http-equiv='refresh' content='3'>";
            echo "<p class='text-center alert alert-success'>Teste criado com successo!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }


    public function listar_testes($q) {
        $query = "SELECT * FROM teste JOIN disciplina ON teste.nr_disciplina = disciplina.nr_disciplina WHERE teste.nr_disciplina = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$_SESSION['nome_disciplina'].' - '.$rs['descricao']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='teste-ver.php?q=". $rs['nr_teste'] ."&q2=".$rs['descricao']."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                </div> 
                <div class='card-body'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Data :<b>" . $rs['data_teste'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Hora :<b>" . $rs['hora_teste'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Duração :<b>" . $rs['duracao'] . " min</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
            </div>";
        }
        return $out;
    }

    public function listar_testes_turma($q, $d) {
        $query = "SELECT * FROM teste JOIN disciplina ON teste.nr_disciplina = disciplina.nr_disciplina JOIN turma ON disciplina.nr_turma = turma.nr_turma JOIN disciplina_professor ON disciplina.nr_disciplina = disciplina_professor.nr_disciplina JOIN professor ON professor.nr_professor = disciplina_professor.nr_professor WHERE turma.nr_turma = ? AND disciplina.nr_disciplina = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q, $d]);
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$rs['nome_disciplina'].' - '.$rs['descricao']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='teste-ver.php?q=". $rs['nr_teste'] ."&q2=".$rs['descricao']."&q3=".$rs['nome_disciplina']."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                </div> 
                <div class='card-body'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Data :<b>" . $rs['data_teste'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Hora :<b>" . $rs['hora_teste'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Duração :<b>" . $rs['duracao'] . " min</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Professor :<b>" . $rs['nome_professor'] . ' ' . $rs['apelido_professor'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
            </div>";
        }
        return $out;
    }

    public function nova_pergunta($nr_teste, $nota, $pergunta, $a, $b, $c, $d, $opcao_correcta, $tipo_pergunta) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `perguntas_teste`(`nr_teste`, `nota`, `pergunta`, `a`, `b`, `c`, `d`, `opcao_correcta`, `tipo_pergunta`, `criado_por`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_teste, $nota, $pergunta, $a, $b, $c, $d, $opcao_correcta, $tipo_pergunta, $usuario_logado])) {
            echo "<meta http-equiv='refresh' content='3'>";
            echo "<p class='text-center alert alert-success'>Pergunta adionada com successo!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}


class usuario extends conexao {


    public function total_usuarios() {
        $query = "SELECT COUNT(id_usuario) AS total_usuarios FROM tabela_usuarios";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_usuarios'];
    }

    public function select_nivel_acesso() {
        $query = "SELECT `id_nivel_acesso`,`nome_nivel_acesso` FROM `tabela_nivel_acesso` ORDER BY `id_nivel_acesso`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($linhas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($linhas['id_nivel_acesso']>2) {
                if ($linhas['id_nivel_acesso']!=5) {
                    $out .= "<option value='". $linhas['id_nivel_acesso'] ."'>". $linhas['nome_nivel_acesso'] ."</option>";
                } 
                
                
            }
        }
        return $out;
    }

    public function inserir_usuario($nome, $usuario, $id_nivel_acesso, $senha, $f_key) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO tabela_usuarios(nome, usuario, id_nivel_acesso, senha, f_key, criado_por) VALUES(?, ?, ?, ?, ?, ?) ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome, $usuario, $id_nivel_acesso, md5($senha), $f_key, $usuario_logado])) {
            $url="usuarios.php";
            
            echo "<p class='text-center alert alert-success'>Operação efectuada com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }


    public function actualizar_usuario($id_usuario, $nome, $usuario, $id_nivel_acesso, $senha) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "UPDATE tabela_usuarios SET nome = ? , usuario = ? , id_nivel_acesso = ? , senha = ? , modificado_por = ?  WHERE `id_usuario` = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nome, $usuario, $id_nivel_acesso, md5($senha), $usuario_logado, $id_usuario])) {
            $url="usuarios.php";
            
            echo "<p class='text-center alert alert-success'>Dados do Usuário actualizados com sucesso!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }

    public function get_row($id) {
        $query = "SELECT * FROM users WHERE id = ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$id]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function listar_usuarios() {
        $query = "SELECT *,`tabela_nivel_acesso`.`nome_nivel_acesso` FROM tabela_usuarios JOIN tabela_nivel_acesso ON `tabela_usuarios`.`id_nivel_acesso` = `tabela_nivel_acesso`.`id_nivel_acesso`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $out .= "<tr>";
                $out .= "<td>" . $rs['usuario'] . "</td>";
                $out .= "<td>" . $rs['nome'] . "</td>";
                $out .= "<td>" . $rs['nome_nivel_acesso'] . "</td>";
                $out .= "<td>" . $rs['estado'] . "</td>";
                $out .= "<td>
                                <a href='#' data-toggle='modal' data-target='#editar_usuario". $rs['id_usuario'] ."' title='Editar'>
                                    <button type='button' class='btn'>
                                        <i class='fas fa-edit text-warning' aria-hidden='true'></i> 
                                    </button>                               
                                 </a>
                            </td>";
                $out .= "</tr>

                <div class='modal fade' id='editar_usuario". $rs['id_usuario']. "' tabindex='-1' role='dialog' aria-labelledby='edit' aria-hidden='true'>
                    <div class='modal-dialog ' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header ' style='background-color: #880f0f;'>
                                <h5 class='modal-title' style='color: #fff;' id='exampleModalLabel'>Editar Usuário</h5>
                                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true' style='color:#fff;'>×</span>
                                </button>
                            </div>
                            <form class='usuario_submit_edicao' method='POST' accept-charset='utf-8'>
                                <div class='modal-body'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <input type='hidden' id='controlador' name='edicao_usuario'>
                                            <input type=''hidden class='input-xs form-control in' name='id_usuario' maxlength='70' value='". $rs['id_usuario']. "' placeholder='Nome' required='' >
                                                <label>Nome</label>
                                            <input type='text' autofocus='' class='input-xs form-control in' name='nome' maxlength='70' value='". $rs['nome']. "' placeholder='Nome' required='' >
                                        </div> 

                                    </div> 
                                    <div class='row'>
                                        <div class='col-md-6'>
                                                <label>Usuário</label>
                                            <input type='text' class='input-xs form-control in'  name='usuario' maxlength='70' value='". $rs['usuario']. "' placeholder='Usuário' required='' >
                                        </div>  
                                        <div class='col-md-6'>
                                                <label>Nivel de acesso</label>
                                            <select class='input-xs form-control in' name='id_nivel_acesso' required=''>
                                                <option value='". $rs['id_nivel_acesso']. "'>". $rs['nome_nivel_acesso']. "</option>
                                                ".$this->select_nivel_acesso()."
                                            </select>
                                        </div> 

                                    </div>  
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <label>Senha</label>
                                            <input type='password' class='input-xs form-control in' name='senha' maxlength=''  value='' placeholder='Senha' required='' >
                                        </div> 
                                    </div>  

                                </div>
                                <div class='modal-footer'>
                                    <button class='btn btn-primary btn-sm' name='ok' type='submit' data-dismiss=''><i class='fas fa-edit'></i> Editar</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
                ";
        }
        return $out;
    }

    // update data
    public function update($f, $l, $w, $c, $e, $id) {
        $query = "UPDATE users SET first = ?,last = ?,work = ?,city=?,email=? where id = ? ";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$f, $l, $w, $c, $e, $id])) {
            echo "Data updated! <a href='index.php'>view</a>";
        }
    }

    //user search results
    public function search($text) {
        $text = strtolower($text);
        $query = "SELECT * FROM users WHERE first LIKE ? OR last LIKE ? OR work LIKE ? OR email LIKE ? or city LIKE ? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$text, $text, $text, $text, $text]);
        $out = "";
        $out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ID</th><th>First Name</th><th>Last Name</th><th>Occupation</th><th>City</th><th>Email</th><th colspan='2'>Option</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $first = $row['first'];
            $last = $row['last'];
            $work = $row['work'];
            $city = $row['city'];
            $email = $row['email'];
            $out .= "<tr><td>$id</td><td>$first</td><td>$last</td><td>$work</td><td>$city</td><td>$email</td>";
            $out .= "<td><a href='edit.php?id=$id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
            $out .= "<td><span id='$id' class='del btn btn-sm btn-danger' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
        }
        $out .= "</table>";
        if ($stmt->rowCount() == 0) {
            $out = "";
            $out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
        }
        return $out;
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$id])) {
            echo "1 record deleted.";
        }
    }

//end of class
}


class trabalho extends conexao {


    public function listar_anexos($q) {
        $query = "SELECT * FROM anexos_trabalho WHERE anexos_trabalho.nr_trabalho = ? ORDER BY nr_trabalho";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        $count=0;
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$rs['nome_anexo']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'></span>
                </div> 
                <div class='card-body'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800 text-center'><a href=".$rs['anexo']." target='_blank' title='Baixar anexo'><b><i class='fas fa-cloud-download-alt fa-5x'></i></a></b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
            </div>";
        }
        return $out;
    }



    public function listar_perguntas_alunos($q) {
        $query = "SELECT * FROM perguntas_trabalho WHERE perguntas_trabalho.nr_trabalho = ? ORDER BY nr_pergunta";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        $count=0;
        $out .= "<div class='col-md-12 list-group mb-1 ml-0' style='padding-bottom:15px;'>";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $count++;
            $out .= "   <div class='list-group-item list-group-item-action'> 
                            <div class='row'>
                                
                                <div class='col-md-10'><b>".$count.'. '.$rs['pergunta']."</b></div>
                                <div class='col-md-2 text-right'><b>".$rs['nota']."V</b></div>
                            </div>";

            if ($rs['tipo_pergunta']==2) {
                $a="";
                $b="";
                $c="";
                $d="";
                /*if ($rs['opcao_correcta']=="a") {
                    $a="alert-success";
                }
                if ($rs['opcao_correcta']=="b") {
                    $b="alert-success";
                }
                if ($rs['opcao_correcta']=="c") {
                    $c="alert-success";
                }
                if ($rs['opcao_correcta']=="d") {
                    $d="alert-success";
                }*/
                $out .= "   <div class='row m-2'>
                                <div class='col-md-3 alert ".$a."' ><span  style='cursor:pointer;'>a).".$rs['a']."</span> </div>
                                <div class='col-md-3 alert ".$b."' ><span  style='cursor:pointer;'>b).".$rs['b']."</span> </div>
                                <div class='col-md-3 alert ".$c."' ><span  style='cursor:pointer;'>c).".$rs['c']."</span> </div>
                                <div class='col-md-3 alert ".$d."' ><span  style='cursor:pointer;'>d).".$rs['d']."</span> </div>
                            </div>";
            }else{
                $out .= "   <div class='row m-2'>
                                <div class='col-md-12'><textarea class='input-xs form-control in' name='resposta".$rs['pergunta']."'></textarea></div>
                            </div>";
            }
                $out.="</div>";
        }
        $out.="</div><br>";
        return $out;
    }


    public function novo_trabalho($nr_disciplina, $descricao, $data_limite_entrega, $nota_maxima, $obs) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `trabalho`( `nr_disciplina`, `descricao`, `data_limite_entrega`, `nota_maxima`, `obs`, `criado_por`) VALUES ( ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_disciplina, $descricao, $data_limite_entrega, $nota_maxima, $obs, $usuario_logado])) {
            echo "<meta http-equiv='refresh' content='3'>";
            echo "<p class='text-center alert alert-success'>Trabalho criado com successo!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }


    public function listar_trabalhos($q) {
        $query = "SELECT * FROM trabalho JOIN disciplina ON trabalho.nr_disciplina = disciplina.nr_disciplina WHERE trabalho.nr_disciplina = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q]);
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$_SESSION['nome_disciplina'].' - '.$rs['descricao']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='ver-anexos.php?q=". $rs['nr_trabalho'] ."&q2=".$rs['descricao']."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                </div> 
                <div class='card-body'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Data :<b>" . $rs['data_limite_entrega'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Hora :<b>" . $rs['obs'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
            </div>";
        }
        return $out;
    }

    public function listar_trabalhos_turma($q, $d) {
        $query = "SELECT * FROM trabalho JOIN disciplina ON trabalho.nr_disciplina = disciplina.nr_disciplina JOIN turma ON disciplina.nr_turma = turma.nr_turma JOIN disciplina_professor ON disciplina.nr_disciplina = disciplina_professor.nr_disciplina JOIN professor ON professor.nr_professor = disciplina_professor.nr_professor WHERE turma.nr_turma = ? AND disciplina.nr_disciplina = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$q, $d]);
        $out = "";
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $out .= "<div class='col-xl-3 col-md-4 mb-4'>
            <div class='card shadow h-100'>
                <div class='card-header  d-flex flex-row align-items-center justify-content-between'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$rs['nome_disciplina'].' - '.$rs['descricao']. "</h6><span class='col p-0 m-0 font-weight-bold text-primary py-1 text-right'><a href='trabalho-ver.php?q=". $rs['nr_trabalho'] ."&q2=".$rs['descricao']."&q3=".$rs['nome_disciplina']."' class='text-secondary' title='Ver'><i class='fas fa-eye fa-fw'></i></a></span>
                </div> 
                <div class='card-body'>
                        <div class='col mr-2'>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Data :<b>" . $rs['data_trabalho'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Hora :<b>" . $rs['hora_trabalho'] . "</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Duração :<b>" . $rs['duracao'] . " min</b> </div>";
            $out .= "<div class='h6 mb-0  text-gray-800'>Professor :<b>" . $rs['nome_professor'] . ' ' . $rs['apelido_professor'] . "</b> </div>";
                $out .= "   </div>
                        </div>
                    </div>
            </div>";
        }
        return $out;
    }

    public function novo_anexo($nr_trabalho, $nome_anexo, $anexo) {
        $usuario_logado = $_SESSION['idUsuario'];
        $query = "INSERT INTO `anexos_trabalho`(`nr_trabalho`, `nome_anexo`, `anexo`, `criado_por`) VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute([$nr_trabalho, $nome_anexo, $anexo, $usuario_logado])) {
            echo "<meta http-equiv='refresh' content='3'>";
            echo "<p class='text-center alert alert-success'>Anexo adionado com successo!</p>";
        } else {
            echo "<p class='text-center alert alert-danger'>Erro: " . $stmt->error . "</p>";
        }
    }
}
