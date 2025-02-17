<?php
require_once("principal.php");
$idade_min=Date("Y")-65;
$idade_min=$idade_min."-01-01";
$idade_max=Date('Y')-10;
$idade_max=$idade_max."-12-31";
$validade_min=Date("Y");
$validade_min=$validade_min."-01-01";
$validade_max=Date('Y')+4;
$validade_max=$validade_max."-12-31";
?>


<div class="container-fluid">
  <div id='mensagem'></div>
  <div class="row-fluid">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="divH m-0 font-weight-bold text-primary"><label>Alunos</label></div>
      </div>
      <div class="panel-body ml-4 mr-4">
        <form id="demoform" action="#" method="post">
          <select class="input-xs form-control in " multiple="multiple" size="10" name="duallistbox_demo1[]" title="duallistbox_demo1[]">
            <option value="option1" selected="selected">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
            <option value="option5">Option 5</option>
            <option value="option6">Option 6</option>
            <option value="option7">Option 7</option>
            <option value="option8">Option 8</option>
            <option value="option9">Option 9</option>
            <option value="option0">Option 10</option>
          </select>
          <br>
          <button type="submit" class="btn btn-default btn-block">Submit data</button>
        </form>
        <script>
          var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
          $("#demoform").submit(function() {
            alert($('[name="duallistbox_demo1[]"]').val());
            return false;
          });
        </script>
      </div>
    </div>
  </div>
</div>









<?php
include_once("rodape.php");
?>

<script>
  var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
  $("#demoform").submit(function() {
    alert($('[name="duallistbox_demo1[]"]').val());
    return false;
  });

  var demo2 = $('.demo2').bootstrapDualListbox({
        nonSelectedListLabel: 'Non-selected',
        selectedListLabel: 'Selected',
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false,
        nonSelectedFilter: 'ion ([7-9]|[1][0-2])'
      });
</script>