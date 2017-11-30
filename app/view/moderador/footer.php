        <footer class="footer">
            <div class="container-fluid">
                <!--nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav-->
                <p class="copyright pull-right">
                    &copy; 2017 <a href="https://projecao.br/faculdade">Fábrica de Software</a>, desenvolvendo web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
	
	<script type="text/javascript">
	$(function() {
		$.getJSON("aluno.php", function (data){
        	
        	var itens = [];
        	
        	$(data).each(function (key, value){
        		itens.push(value.matricula + " - " + value.nome);
				//itens.push(value.id);
        	});
        	
        	$( "#nome_aluno" ).autocomplete({
        		minlength: 2,
        		autofocus: true,
            	source: itens,
				focus: function (event, ui) {
					$("#nome_aluno").val(ui.item.value);
					for(var i =0; i < itens.length; i++){
						var usuario = data[i].matricula + " - " + data[i].nome;
            			if(ui.item.value == usuario){
            				$("#id_aluno").val(data[i].id);
							return false;
            			}
            		}
				},
            	select: function (event, ui) { 
            		for(var i =0; i < itens.length; i++){
						var usuario = data[i].matricula + " - " + data[i].nome;
            			if(ui.item.value == usuario){
            				$("#id_aluno").val(data[i].id);
							return false;
            			}
            		}
            	}
            });
        });
		function disciplinacurso(curso){
			$.ajax({
				type: 'GET',
				url: 'enviardisciplina.php',
				data: {
					acao: curso
				},
				dataType: 'json',
				success: function(data){
					console.log(data);
					//alert(data[0].disciplina);
					$('#disciplinacurso').find("option").remove();
					$('#disciplinacurso').append("<option value=''> -- Escolha a Disciplina -- </option>");
					for(var i = 0; i < data.length; i++){
						$('#disciplinacurso').append("<option value='" + data[i].idDisciplina + "'>" + data[i].disciplina + "</option>");
						//alert(data[0].disciplina);
					}
				}
			});
		}
		$('#cursodisciplina').change(function(){
			var curso = this.value;
			disciplinacurso(curso);
		});
		$('#cursodisciplinas').change(function(){
			var curso = this.value;
			disciplinacurso(curso);
		});
		$('#email_user').focusout(function(){
			var valid = true;  
			var emails = $(this).val().replace(';', ',').split(",");  
		  
			jQuery.each(emails, function () {  
				if (jQuery.trim(this) != ''){  
					if (!jQuery.trim(this).match(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i))  
						valid = false;  
				}  
			});  
			if(valid == false){
				alert('Email não válido');
				$(this).val('');
			}
		});
		$('#tabela_usuario').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por páginas",
				"zeroRecords": "Nada Encontrado - Desculpe",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro disponível",
				"infoFiltered": "(Filtrado do total de _MAX_ registro(s))",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo"
				},
				"search": "Pesquisar"
			}
		});
		$('#tabela_curso').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por páginas",
				"zeroRecords": "Nada Encontrado - Desculpe",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro disponível",
				"infoFiltered": "(Filtrado do total de _MAX_ registro(s))",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo"
				},
				"search": "Pesquisar"
			}
		});
		$('#tabela_disciplina').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por páginas",
				"zeroRecords": "Nada Encontrado - Desculpe",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro disponível",
				"infoFiltered": "(Filtrado do total de _MAX_ registro(s))",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo"
				},
				"search": "Pesquisar"
			}
		});
		$('#tabela_arquivo').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por páginas",
				"zeroRecords": "Nada Encontrado - Desculpe",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro disponível",
				"infoFiltered": "(Filtrado do total de _MAX_ registro(s))",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo"
				},
				"search": "Pesquisar"
			}
		});
		$("#senha_user").keyup(function(){
			if($(this).val().length > 3){
				if($('#senha_user2').val() == $(this).val()){
					$('#senha_user2').css("border-color", "#2eb82e");
					$('#submit_btn_editar').attr('disabled',false);
					$("#error_senha2").text("");
				}else{
					if($('#senha_user2').val() != ''){
						$('#senha_user2').css("border-color", "#FF0000");
						$('#submit_btn_editar').attr('disabled',true);
						$("#error_senha2").text("Senhas não Correspondentes!");
					}
				}
			}
		});
		$("#senha_user").focusout(function(){
			if($(this).val().length <= 3){
				$('#senha_user').css("border-color", "#FF0000");
				$('#submit_btn_editar').attr('disabled',true);
				$("#error_senha").text("Mínimo 4 digitos!");
			}else{
				$('#senha_user').css("border-color", "#2eb82e");
				$('#submit_btn_editar').attr('disabled',false);
				$("#error_senha").text("");
			}
		});
		$("#senha_user2").keyup(function(){
    		if($(this).val().length > 3){
				if($('#senha_user').val() != $(this).val()){
					$(this).css("border-color", "#FF0000");
					$('#submit_btn_editar').attr('disabled',true);
					$("#error_senha2").text("Senhas não Correspondentes!");
				}else{
					$(this).css("border-color", "#2eb82e");
					$('#submit_btn_editar').attr('disabled',false);
					$("#error_senha2").text("");
				}
			}
		});
		$('#submit_btn_editar').click(function(){
			if($('#senha_user').val() != $('#senha_user2').val()){
    			$("#senha_user2").css("border-color", "#FF0000");
    			$('#submit_btn_editar').attr('disabled',true);
    			$("#error_senha2").text("Senhas não correspondetes!");
    			$("#formAddUsuario").submit(function(){
         			return false;
         		});
			}
		});
	});
	</script>
	
	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();
			
			documento = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
			if(documento == '?pg=home' || documento == ''){
				notificacao();
			}
			
    	});
		function notificacao(){
			$.notify({
            	icon: 'pe-7s-gift',
            	message: "Bem-Vindo ao <b>Sistema de Repositório</b>."

            },{
                type: 'info',
                timer: 1000
            });
		}
	</script>

</html>