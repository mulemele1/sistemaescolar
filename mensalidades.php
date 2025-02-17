 <!--  -->
<?php 
  include 'principal.php';
  include 'conexao.php';

 
  if(isset($_SESSION['mensagem'])){
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
  }
  
                    
                    if (isset($_GET['ok'])) {
                      $nr_turma=@$_GET['nr_turma'];
                      $resultado = mysqli_query($conectar,"SELECT * FROM aluno where nr_turma='$nr_turma' ORDER BY 'nr_aluno'");
                    }else{
                      $resultado = mysqli_query($conectar,"SELECT * FROM aluno ORDER BY 'nr_aluno'");
                    }
                   
                    

  
?>
<style type="text/css">
  .btn{
    font-size: 10px;
    
  }
</style>
        <!-- Begin Page Content -->
        <div class="container-fluid" >
        <?php
          $query=mysqli_query($conectar,"SELECT * FROM `turma` JOIN `classe` ON `turma`.`classe_turma` = `classe`.`nr_classe`");
        ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class=" m-0 font-weight-bold text-primary"><label>Mensalidades</label></div>

              <div class="row">
                <div class="col text-left" hidden="">
                      <a class="" data-toggle="modal" data-target="#taxas"><button type='button' class='text-left btn btn-sm btn-danger'><span class="fas fa-sm fa-cog" style="font-size: 13px"> Alterar taxas</span> </button></a>
                  </div>
                    <form method="GET" class="" hidden="">
                      <div class="input-group">
                      <select class="form-control in" name="nr_turma" required="">
                 
                        <?php 
                            echo "<option >Turma</option>";
                          while($linhas=mysqli_fetch_array($query)){ 
                            $opt=$_GET['nr_turma'];
                            $i=$_SESSION['nr_turma'];
                            ?>
                                      <option <?php if (trim(@$_SESSION['nr_turma'])==trim($linhas['nr_turma'])): ?>
                                  selected=""
                                <?php endif ?> value = "<?php echo $linhas['nr_turma'] ?>"><?php echo $linhas['nome_classe'].' '.$linhas['nome_turma'] ?></option>;
                                      <?php
                                      }

                                    ?>
                        </select>
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary"  type="submit" name="ok">
                          <i class="fas fa-filter"></i>
                        </button>
                      </div>
                      </div>
                  </form>
              </div>
            </div>
            <!-- Content Row -->
           
          <div class="row">
            <?php if ($_SESSION['usuarioNivelAcesso']==1): ?>
              
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganhos (Mensal)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="" readonly="" style="border: 0;" size="5" id="ganhos_mensal" value="" name=""><?=number_format($administracao->coleta_mes('Ago'),2);?> MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1">Ganhos (Anual) em inscrições</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_ano(),2); ?>  MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1">Ganhos (Anual) em Mensalidade</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_mensalidades(),2); ?> MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-upper case mb-1">Total</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id=""><input type="" readonly="" style="border: 0;" size="5" id="ganhos_anual" value="" name=""><?=number_format($administracao->coleta_mensalidades()+$administracao->coleta_ano(),2); ?> MZN</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php endif ?>
            <!-- Pending Requests Card Example 
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pedidos pendentes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->
          </div>
            <div class="card-body">
              <div class="table-responsive">
                
                <table class="table table-bordered table-striped" id="dataTable" style="font-size: 14px" >
                  <thead>
              
                    <th>Nome do Estudante</th>
                    <th>Matrícula</th>
                    
                    <th>Fev</th>
                    <th>Mar</th>
                    <th>Abr</th>
                    <th>Mai</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Ago</th>
                    <th>Sep</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Colecta</th>
                    
                    </tr>
                  </thead>
                  <tbody class="searchable">
                  
                <?php 
                
                  
                  while($linhas = mysqli_fetch_array($resultado)){
                    echo "<tr>";
                      $nr_aluno=$linhas['nr_aluno'];
                      echo "<td>".$linhas['nome_aluno'].' '.$linhas['apelido_aluno']."</td>";
                                  
                      $Mensal = @mysqli_query($conectar,"SELECT * FROM mensalidades WHERE nr_aluno='$nr_aluno'");
                      $Est = mysqli_fetch_array($Mensal);
                      $taxas = @mysqli_query($conectar,"SELECT * FROM inscricao_detalhes WHERE nr_aluno='$nr_aluno'");
                      $taxas = mysqli_fetch_assoc($taxas);
                      $mes=0;
                      ?>
                      
                      <td>
                        <button type="button" href="#" class="btn btn-xs btn-success btn-block" style="background:green" ><i class="" data-toggle="tooltip" title="Detalhes do pagamento"></i><?= $taxas['valor_inscricao'] ?></button>
                      </td>
                      <td><?php if(empty($Est['Fev'])){ ?>
                          
                          <button type="button" href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = @mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Fev'");
                            $rs = mysqli_fetch_array($MensalDetalhes);
                            $mes++;
                          ?>
                          
                          <button type="button" href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Fev" data-whatever2="<?php echo $Est['Fev'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Mar'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Fev'])){ ?> disabled="" <?php } ?>  href="#fazerPagamento"  class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Mar" data-whatever2="<?php echo $Est['Mar'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Mar'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          
                          <button type="button" <?php if(empty($Est['Fev'])) echo "Disabled" ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Mar" data-whatever2="<?php echo $Est['Mar'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Abr'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Mar'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Abr" data-whatever2="<?php echo $Est['Abr'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Abr'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Mar'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Abr" data-whatever2="<?php echo $Est['Abr'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>
                                  
                      <td><?php if(empty($Est['Mai'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Abr'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Mai" data-whatever2="<?php echo $Est['Mai'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Mai'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Abr'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Mai" data-whatever2="<?php echo $Est['Mai'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                                  <td><?php if(empty($Est['Jun'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Mai'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Jun" data-whatever2="<?php echo $Est['Jun'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Jun'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Mai'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Jun" data-whatever2="<?php echo $Est['Jun'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                                  <td><?php if(empty($Est['Jul'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Jun'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Jul" data-whatever2="<?php echo $Est['Jul'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Jul'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Jun'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Jul" data-whatever2="<?php echo $Est['Jul'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Ago'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Jul'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Ago" data-whatever2="<?php echo $Est['Ago'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Ago'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Jul'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Ago" data-whatever2="<?php echo $Est['Ago'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                      <td><?php if(empty($Est['Sete'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Ago'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Sete" data-whatever2="<?php echo $Est['Sete'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Sete'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Ago'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Sete" data-whatever2="<?php echo $Est['Sete'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>

                                  <td><?php if(empty($Est['Outu'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Sete'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Outu" data-whatever2="<?php echo $Est['Outu'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Outu'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Sete'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class="btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Outu" data-whatever2="<?php echo $Est['Outu'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>     

                                  <td><?php if(empty($Est['Nov'])){ ?>
                          
                          <button type="button" <?php if(empty($Est['Outu'])){ ?> disabled="" <?php } ?> href="#fazerPagamento" class="btn btn-xs btn-danger btn-block" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Nov" data-whatever2="<?php echo $Est['Nov'];  ?>"><i data-toggle="tooltip" title="Fazer pagamento"></i><b>x</b></button>

                        <?php }else { 

                            $MensalDetalhes = mysqli_query($conectar,"SELECT * from conf_mensalidades JOIN tabela_usuarios ON conf_mensalidades.criado_por = tabela_usuarios.id_usuario where nr_aluno='$nr_aluno' AND mes='Nov'");
                            $rs = mysqli_fetch_array($MensalDetalhes);

                            $mes++;
                          ?>
                          <button type="button" <?php if(empty($Est['Outu'])){ ?> disabled="" <?php } ?> href="#anularPagamento" class=" btn btn-xs btn-success btn-block" style="background:green" data-whatever4="<?php echo $rs['recibo'];  ?>"  data-whatever9="<?php echo $rs['nome'];  ?>"  data-whatever8="<?php echo $rs['data_deposito'];  ?>" data-whatever5="<?php echo $rs['data_criacao'];  ?>" data-whatever3="<?php echo $linhas['nome_aluno'];?>" data-toggle="modal" data-whatever="<?php echo $linhas['nr_aluno'];?>" data-whatever1="Nov" data-whatever2="<?php echo $Est['Nov'];  ?>"><i class="" data-toggle="tooltip" title="Detalhes do pagamento"><?= @$taxas['valor_mensalidade'] ?></i></button>
                          
                        <?php } ?>
                      </td>      
                      <td>
                        <input type="button" class=" btn btn-xs btn-success btn-block" style="background:green" id="colecta" value="<?=$taxas['valor_inscricao']+$mes*$taxas['valor_mensalidade']; ?>"></input>
                      </td>                 

                                              
                      <?php
                    
                    echo "</tr>";
                  }
                ?>
              </tbody>
              </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

  <!-- Footer -->
<?php 
  include 'rodape.php';
?>
  
<div class="modal fade" id="anularPagamento" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Pagamento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
      <form name="form" id="cadastrar_professor" enctype="multipart/form-data">
        <input type="hidden" name="anular_pagamento" class="form-control" >
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="nr_aluno" class="form-control" id="nr_aluno">
          </div>
          <div class="form-group">

            <input type="hidden" name="Mes" class="form-control" id="Mes">
          </div>
          <div class="form-group">
            <label>Numero do recibo</label>
            <input type="text" readonly="" name="recibo" class="form-control" id="recibo">
          </div>
          <div class="form-group">
          <label>Data do depósito</label>
            <input type="text" readonly="" name="data_deposito" class="form-control" id="data_deposito">
          </div>
          <div class="form-group">
          <label>Data da confirmação</label>
            <input type="text" readonly="" name="data" class="form-control" id="data">
          </div>
          <div class="form-group">
          <label>Pagamento confirmado pr</label>
            <input type="text" readonly="" name="usuario_conf" id="usuario_conf" class="form-control">
          </div>
          <div class="form-group">  
            <input type="hidden" name="Estado" class="form-control" id="Estado">
          </div>
          <div class="alert alert-danger hidden " hidden><span class=""></span> Tens a certeza que desejas anular o pagamento da Mensalidade deste mês?</div>
        </div>
        <div class="modal-footer ">
        <?php if ($_SESSION['usuarioNivelAcesso']=='5' or $_SESSION['usuarioNivelAcesso']=='1') { ?>
          <button type="submit"  class="btn btn-danger left" name="Save"><span class="glyphicon glyphicon-ok-sign"></span> Anular </button>
        <?php } ?>
        </div>
      </form>
    </div> 
  </div>
</div> 
<!-- Fim Modal anularPagamento -->

<script type="text/javascript">
        $('#anularPagamento').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var nr_aluno = button.data('whatever') 
          var M = button.data('whatever1') 
          var E = button.data('whatever2')
          var nome_aluno = button.data('whatever3')
          var recibo = button.data('whatever4') 
          var usuario_conf = button.data('whatever9') 
          var data = button.data('whatever5')  
          var data_deposito = button.data('whatever8')   
          var modal = $(this)
          //modal.find('.modal-title').text('Anular o pagamento do(a): ' + nome_aluno)
          modal.find('#nr_aluno').val(nr_aluno)
          modal.find('#Mes').val(M)
          modal.find('#Estado').val(E)
          modal.find('#recibo').val(recibo)
          modal.find('#usuario_conf').val(usuario_conf)
          modal.find('#data_deposito').val(data_deposito)
          modal.find('#data').val(data)
          
          })
</script>




<div class="modal fade" id="fazerPagamento" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação do pagamento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
      <form name="form" method="POST" id="cadastrarAluno" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" name="nr_aluno" class="form-control" id="nr_aluno">
            <input type="hidden" name="fazer_pagamento" class="form-control" >
          </div>
          <div class="form-group">
            <input type="hidden" name="Mes" class="form-control" id="Mes">
          </div>
          <div class="form-group">  
            <input type="hidden" name="Estado" class="form-control" id="Estado">
          </div>
          <div class="form-group">
          <label>Número do recibo</label>  
            <input type="number"  size="50px" autofocus="" required maxlength="13" name="recibo" class="form-control" id="recibo">
          </div>
          <div class="form-group">
          <label>Data do depósito</label>  
            <input type="date"  size="50px"  required  name="data_deposito" class="form-control" id="data_deposito">
          </div>
        </div>
        <div class="modal-footer ">
          <button type="submit" class="btn btn-success" name="Confirmar"><span class="fas fa-save"></span> Ok </button>
        </div>
      </form>
    </div> 
  </div>
</div> 
<!-- Fim Modal fazerPagamento -->

<script type="text/javascript">
        $('#fazerPagamento').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var nr_aluno = button.data('whatever') 
          var Mes = button.data('whatever1') 
          var Estado = button.data('whatever2')
          var nome_aluno = button.data('whatever3')   
          var modal = $(this)
          //modal.find('.modal-title').text('Confimar pagamento do(a): ' + nome_aluno)
          modal.find('#nr_aluno').val(nr_aluno)
          modal.find('#Mes').val(Mes)
          modal.find('#Estado').val(Estado)
          
          })
        $(document).ready(function(){
        })
</script>