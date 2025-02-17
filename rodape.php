

      </div>
      <!-- End of Main Content -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><i hidden="">Todos direitos reservados</i>Copyright &copy; <a href="mailto:taniamatusse@gmail.com"> tania</a> 2025</span>
          </div>
        </div>
</footer>

    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header " style="background-color: #880f0f;">
          <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Alerta</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Deseja mesmo sair do sistema?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
          <a class="btn btn-sm" style="background-color: #880f0f; color: #fff" href="sair.php">Sim</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Alertas-->
  <script src="js/sweetalert2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>
  <script src="js/stock_funcoes.js"></script>

  

</body>

</html>

<script type="text/javascript">
  function Voltar() {
    window.history.go(-1);
  }
</script>




            <div class="modal fade" id="novo_teste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog " role="document">
                  <div class="modal-content">
                      <div class="modal-header " style="background-color: #880f0f;" hidden>
                        <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Cadastrar Disciplina</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:#fff;">×</span>
                        </button>
                    </div>
                      <form id="criar_novo_teste" method="POST" accept-charset="utf-8">
                          <div class="modal-body">

                              <input type="hidden" id="controlador" name="novo_teste">
                              <div class="row">
                                  <div class="col-md-4" hidden>
                                      <input type="text" class="input-xs form-control in" readonly="" name="nr_disciplina" maxlength="70" value="<?php echo $_SESSION['nr_disciplina']; ?>" placeholder="" required=""  >
                                  </div>  
                                  <div class="col-md-6">
                                    <label for=""> Descrição</label>
                                      <input type="text" class="input-xs form-control in" name="descricao" maxlength="70" value="" placeholder="Ex: Teste 1" required="" >
                                  </div>  
                                  <div class="col-md-6">
                                    <label for=""> Data da avaliação</label>
                                      <input type="date" class="input-xs form-control in" name="data_teste" value="" placeholder="" >
                                  </div> 

                                  <div class="col-md-6">
                                    <label for=""> Hora da avaliação</label>
                                      <input type="time" class="input-xs form-control in" name="hora_teste" value="" placeholder="" >
                                  </div> 

                                  <div class="col-md-6">
                                    <label for=""> Duração</label>
                                      <input type="text" class="input-xs form-control in" name="duracao" value="" placeholder="Minutos, Ex: 120" >
                                  </div> 

                                  <div class="col-md-6">
                                    <label for=""> Nota Máxima</label>
                                      <input type="text" class="input-xs form-control in" name="nota_maxima" value="20" placeholder="Ex: 20v" >
                                  </div>  
                              </div> 
                              <div class="row">
                                  <div class="col-md-12">
                                    <label for=""> Observações</label>
                                      <textarea type="obs" class="input-xs form-control in" name="obs" value="" placeholder=""></textarea>
                                  </div> 

                              </div> 
                          </div>
                          <div class="modal-footer">
                              <button class="btn btn-primary btn-sm" id="ok" name="ok" type="submit"><i class="fas fa-save"></i> Criar</button>
                          </div> 
                      </form> 
                  </div>
              </div>
          </div>



            <div class="modal fade" id="novo_trabalho" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog " role="document">
                  <div class="modal-content">
                      <div class="modal-header " style="background-color: #880f0f;" hidden>
                        <h5 class="modal-title" style="color: #fff;" id="exampleModalLabel">Cadastrar Disciplina</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:#fff;">×</span>
                        </button>
                    </div>
                      <form id="criar_novo_trabalho" method="POST" accept-charset="utf-8">
                          <div class="modal-body">

                              <input type="hidden" id="controlador" name="novo_trabalho">
                              <div class="row">
                                  <div class="col-md-4" hidden>
                                      <input type="text" class="input-xs form-control in" readonly="" name="nr_disciplina" maxlength="70" value="<?php echo $_SESSION['nr_disciplina']; ?>" placeholder="" required=""  >
                                  </div>  
                                  <div class="col-md-6">
                                    <label for=""> Descrição</label>
                                      <input type="text" class="input-xs form-control in" name="descricao" maxlength="70" value="" placeholder="Ex: Trabalho 1" required="" >
                                  </div>  
                                  <div class="col-md-6">
                                    <label for=""> Data limite de Entrega</label>
                                      <input type="date" class="input-xs form-control in" name="data_limite_entrega" value="" placeholder="" >
                                  </div> 

                                  <div class="col-md-6">
                                    <label for=""> Nota Máxima</label>
                                      <input type="text" class="input-xs form-control in" name="nota_maxima" value="20" placeholder="Ex: 20v" >
                                  </div>  
                              </div> 
                              <div class="row">
                                  <div class="col-md-12">
                                    <label for=""> Observações</label>
                                      <textarea type="obs" class="input-xs form-control in" name="obs" value="" placeholder=""></textarea>
                                  </div> 

                              </div> 
                          </div>
                          <div class="modal-footer">
                              <button class="btn btn-primary btn-sm" id="ok" name="ok" type="submit"><i class="fas fa-save"></i> Criar</button>
                          </div> 
                      </form> 
                  </div>
              </div>
          </div>
