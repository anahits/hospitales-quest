<title><?php print "Recolección de datos";?></title>
<meta charset="UTF-8">
<meta name="description" content="" />
<meta name="keywords" content="" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
<style>
	#header {
		text-align: center;
	}
	#main-content {
		margin-top:20px;
	}
	.form-group {
		padding-left: 20px;
	}
	.form-group.row.col.{
		padding-left: 15px;
		margin-bottom: 1px;
	}
	.input-group {
		padding: 5px;
	}
	.list-group {
		width: auto;
		height: 380px;
		overflow: scroll;
		margin-bottom: 55px;
	}
	.btns{
		flex-direction: column;
		display: flex;
		height: 60px;
		align-self: center;
	}
	.btns button {
		margin-bottom: 10px;
	}
	.btn-circle.btn-lg {
		width: 30px;
		height: 30px;
		padding: 10px 16px;
		font-size: 18px;
		line-height: 1.33;
		border-radius: 25px;
	}
	tr.center-aligned td {
		text-align: center;
		vertical-align: middle;
	}
	ul#medicamentoContainer{
		list-style-type: none;
	}
	.medicSelect {
		border: solid #ede3e3 1px;
		padding: 10px;
	}
	.medicaTipoContainer,.horas,.dias{
		border-style: dashed;
	}
	.onerow {
		margin-bottom: 1rem;
	}
	.radios {
		padding-top: 10px;
	}
	.guardar{
		text-align: center;
		margin-bottom: 20px;
	}
	.warning {
		color: red;
	}
	.estudios {
		width: 75%;
		border: dotted .3px;
	}
	.consultas {
		width: 100%;
	border: dotted .3px;
	}
	.footer {
		height: 100px;
		font-size: 14px;
		text-align: center;
	}
</style>