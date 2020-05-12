$(document).ready(function(){

	mainUrl = 'http://localhost/clientes/criarte/';
 	//mainUrl = 'http://dados.grupocriarte.com/clientes/criarte/';

	// DatePickers
	// ===============================
	$( "#data_partida" ).datepicker({
		dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
		dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],
		dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		dateFormat: 'dd-mm-yy'
	});

	$( "#data_destino" ).datepicker({
		dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
		dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],
		dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		dateFormat: 'dd-mm-yy'
	});

	$( "#dataViagem" ).datepicker({
		dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
		dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Sx', 'Sa'],
		dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		dateFormat: 'dd-mm-yy'
	});

    // Dropdown
	// ===============================

	$("body").bind("click", function (e) {
		$('a.menu').parent("li").removeClass("open");
	});

	$("a.menu").click(function (e) {
		var $li = $(this).parent("li").toggleClass('open');
		return false;
	});


	
	// Lightbox dos ônibus
	// ===============================

	$(".openLightbox").fancybox();
	
	// Controle dos campos de poltrona
	// ===============================
	
	$("#segundoAndar").val('00');

	$('#primeiroAndar, #segundoAndar').mask('9?9');

	$("#cbSegundoAndar").click(function(){

		if( $(this).attr('checked') != undefined ){
			$("#segundoAndar").removeAttr('disabled');
			$("#segundoAndarEdit").removeAttr('disabled');
		} else {
			$("#segundoAndar").val('00');
			$("#segundoAndar").attr('disabled','disabled');
			$("#segundoAndarEdit").val('00');
			$("#segundoAndarEdit").attr('disabled','disabled');
		}	
	});

	// Busca as cidades de acordo com o estado
	// ===============================
	
	$("#estadoPartida").change(function(){
		$("#cidadePartida").load(mainUrl + '/viagens/select_cidade/' + $(this).val());
	});
	
	$("#estadoDestino").change(function(){
		$("#cidadeDestino").load(mainUrl + '/viagens/select_cidade/' + $(this).val());
	});

	// Limpa os campos de cidade onFocus
	// ===============================
	$("#n_partida, #n_destino").focus(function(){
		if( $(this).val() == 'Criar nova cidade...')
			$(this).val('');
	});
	
	$("#n_partida, #n_destino").blur(function(){
		if( $(this).val() == '')
			$(this).val('Criar nova cidade...');
	});

	// Habilita edição de cidade/estado na viagem
	// ===============================

	$("#btEditarDestino").click(function(){
		$(this).hide();
		$("#editarDestino").val('1');
		$("#camposDestino").show();
	});

	$("#btEditarPartida").click(function(){
		$(this).hide();
		$("#editarPartida").val('1');
		$("#camposPartida").show();
	});

	// Resultado da Pesquisa de viagem
	// ===============================

	$("#pesquisaViagem").click(function(){
		
		$("#resultadoPesquisa").load(mainUrl + '/consulta/pesquisa/' + $('#cidadePartida').val() + '/' + $('#cidadeDestino').val() + '/' + $('#dataViagem').val()	 );
		
		return false;
		
	});

	// Igualar Tamanho dos botões de poltrona e clicagem
	// ===============================

	width = $(".poltronaLivreBt:last, .poltronaOcupadaBt:last").width();
	$(".poltronaLivreBt, .poltronaOcupadaBt").width(width);

	$(".poltronaLivreBt").click(function(){

		$(".poltronaLivreBt").removeClass('primary');
		$(this).addClass('primary');

		$("#poltrona").val( $(this).html() );

		if( $(this).hasClass('ocupadaIda') ){
			$("#checkIda").attr('disabled', 'disabled');
			$("#checkVolta").attr('checked', 'checked');
		} else {
			$("#checkIda").removeAttr('disabled');
		}

		if( $(this).hasClass('ocupadaVolta') ){
			$("#checkVolta").attr('disabled', 'disabled');
			$("#checkIda").attr('checked', 'checked');
		} else {
			$("#checkVolta").removeAttr('disabled');
		}

		return false;
	});
	
	$(".poltronaOcupadaBt").click(function(){

		poltrona = $(this).html();
		num_form = $(".pData" + poltrona).length;
		
		el = $(".pData" + poltrona + ":eq(0)");
		
		$("#id_2").val( el.attr('data-id') );
		$("#poltrona_2").val(poltrona);
		$("#nome_2").val( el.attr('data-nome') );
		$("#telefone_2").val( el.attr('data-telefone') );
		$("#rg_2").val( el.attr('data-rg') );
		$("#embarque_2").val( el.attr('data-embarque') );
		
		if( el.attr('data-ida') == 1 )
			$("#checkIda_2").attr('checked','checked');
		else
			$("#checkIda_2").removeAttr('checked');
			
		if( el.attr('data-volta') == 1 )
			$("#checkVolta_2").attr('checked','checked');
		else
			$("#checkVolta_2").removeAttr('checked');

		if ( num_form > 1 ){
			
			el = $(".pData" + poltrona + ":eq(1)");
		
			$("#id_3").val( el.attr('data-id') );
			$("#poltrona_3").val(poltrona);
			$("#nome_3").val( el.attr('data-nome') );
			$("#telefone_3").val( el.attr('data-telefone') );
			$("#rg_3").val( el.attr('data-rg') );
			$("#embarque_3").val( el.attr('data-embarque') );
			
			if( el.attr('data-ida') == 1 )
				$("#checkIda_3").attr('checked','checked');
			else
				$("#checkIda_3").removeAttr('checked');
				
			if( el.attr('data-volta') == 1 )
				$("#checkVolta_3").attr('checked','checked');
			else
				$("#checkVolta_3").removeAttr('checked');			
			
		}

		return false;
	});

	$(".poltronaVazia, .poltronaSemi").click(function(){
		$( ".p" + $(this).attr('title') ).click();

		$('html,body').animate({
        	scrollTop: $("#fazerReservaForm").offset().top},
        'slow');

		return false;
	});

	// Mascara RG / Telefone
	// ===============================
	$("#rg").bind("keyup blur focus", function(e) {
		e.preventDefault();
		var expre = /[A-Za-z\.\§\£\@\`\Ž\^\~\'\"\!\?\#\$\%\š\¬\_\+\=\.\,\:\;\<\>\|\°\ª\º\]\[\{\}\\ \)\(\*\&\-\/\\]/g;

		if ($(this).val().match(expre))
			$(this).val($(this).val().replace(expre,''));
    });
    
    $("#telefone").mask('(99) 9999-9999');

	// Andar Swap
	// ===============================	
	$("#primeiroAndarBt").click(function(){
		if( !$(this).hasClass('primary') ){
			$(this).addClass('primary');
			$("#segundoAndarBt").removeClass('primary');
			$("#segundoAndar").hide();
			$("#primeiroAndar").show();
		}
	});
	
	$("#segundoAndarBt").click(function(){
		if( !$(this).hasClass('primary') ){
			$(this).addClass('primary');
			$("#primeiroAndarBt").removeClass('primary');
			$("#primeiroAndar").hide();
			$("#segundoAndar").show();
		}
	});

});

/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
	Version: 1.3
*/
(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery)