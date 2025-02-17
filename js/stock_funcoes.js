
  $(document).ready(function(){/*
    $("#searchable").load("includes/load.php");*/
    $("#cadastrarAluno").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
                
            }
        })
    });

    $("#cadastrar_professor").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )

                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });

    $(".settings").submit(function(e){

        $("#dados").load("includes/load_turma.php");
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )

                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }
            }
        })
    });


    $("#criar_novo_teste").submit(function(e){

        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });


    $("#criar_novo_trabalho").submit(function(e){

        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )

                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });



    $("#criar_novo_anexo").submit(function(e){

        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });


    $("#criar_nova_pergunta").submit(function(e){

        $("#dados").load("includes/load_turma.php");
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )

                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });

    $("#actualizar_professor").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/actualizacao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });

    $("#actualizar_aluno").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/actualizacao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });

    $("#cadastrar_funcionario").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
    });

    $("#classe_submit").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            
            $("#dados").load("includes/load_classe.php");
           
        });
    });

    $(".classe_submit_edicao").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/actualizacao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            
            $("#dados").load("includes/load_classe.php");
            
        });
    });
    
    

    $(".turma_submit_edicao").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/actualizacao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            
            $("#dados").load("includes/load_turma.php");
            
        });
    });
    

    $(".disciplina_submit_edicao").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/actualizacao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            
            $("#dados").load("includes/load_disciplina.php");
           
        });
    });
    
    $("#turma_submit").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            $("#dados").load("includes/load_turma.php");
            
        });
    });

    $("#disciplina_submit").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            
            $("#dados").load("includes/load_disciplina.php");
            
        });
    });

    $("#regForm").submit(function(e){
        $('.close').click();
        alert();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/insercao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            $("#searchable").load("includes/load_usuario.php");
                
            });
    });

    
    $(".usuario_submit_edicao").submit(function(e){
        $('.close').click();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:"includes/actualizacao.php",
            data: $(this).serialize(),
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        })
        .done(function(data){
            $("#searchable").load("includes/load_usuario.php");
               
            });
    });

    
    $("#arquivar").click(function(){
        $("#msg").hide();
        var arquivar = $("#arquivar").val();
        alert(arquivar);
        $.ajax({
            type:"POST",
            url:"includes/actualizacao.php",
            data:{arquivar:arquivar},
            success:function(data){                
                var dados = data.split('</p>')   
                dados=dados[0];      
                if(dados.length<=100)  {
                    swal(
                      'Informação!', dados, 'success'
                    )
                    setTimeout(function(){
                        location.reload();
                    },1800)
                }else{
                    swal(
                      'Informação!', dados, 'error'
                    )
                }  
            }
        });
    });

    $("#q").keyup(function(){
        $("#msg").hide();
    let q = $("#q").val();
    if(q !=''){
        $("#table").html('');
        $.ajax({
            type:"POST",
            url:"includes/search.php",
            data:{q:q},
            success:function(data){
                $("#table").html(data);
            }
        });
    } else  {
        $("#table").load("includes/load.php");
        }
    });
}); 