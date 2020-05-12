<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Relatório</title>
		<link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" /> <!-- media="print" -->
	</head>
	<body>
		
		<?php $this->load->view($view, $data); ?>
		
		<script type="text/javascript">window.print();</script>
	</body>
</html>