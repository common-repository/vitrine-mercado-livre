<?php
/*
  Plugin Name: Vitrine Mercado Livre
  Plugin URI: http://wordpresslivro.com/plugin-vitrine-mercado-livre
  Description: Plugin para afiliados do ML exibirem uma vitrine no blog
  Version: 1.0
  Author: Anderson Makiyama
  Author URI: http://wordpresslivro.com
*/

/**
 * Admiyn Twitter
 * 
 * @author Anderson Makiyama <wordpresslivro.com@gmail.com>
 * @package vitrine-mercado-livre
 *
 */
 
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php"); 
$vitrine_ = array(); $toolID = "";
function vitrine_mercado_livre($atts,$content=""){
	global $tool_id, $as_qshow, $as_categ_id, $toolid_, $as_word, $as_price_min, $as_price_max, $vitrine_, $toolID, $qts_linha;
	$qts_linha = (int)$qts_linha;
	if($qts_linha <1) $qts_linha = 1;
	$toolID = !empty($tool_id)?$tool_id:$toolid_;
	if(empty($as_qshow)) $as_qshow = 3;
	$params = array('as_qshow' => $as_qshow,
					'as_categ_id' => isset($as_categ_id)?$as_categ_id:"",
					'as_word' => !empty($content)?str_replace(" ","+",$content):str_replace(" ","+",$as_word),
					'as_price_min' => !empty($as_price_min)?$as_price_min:"1",
					'as_price_max' => isset($as_price_max)?$as_price_max:"");
	$xmlUrl = "";
	foreach($params as $key=>$value){
		if(!empty($value)) $xmlUrl.= $key . "=". $value . "&";
	}
	$xmlUrl.= "as_display_type=G&as_auct_type_id=AFP&as_search_both=N"; //&as_filtro_id=NUEVO&as_filtro_id=MPAGO&as_search_both=N&as_order_id=HIT_PAGE&gzip=Y
	$xmlUrl.='&as_filter_id=MAS_VND';
	$xml_parser = xml_parser_create('ISO-8859-1');
	xml_set_element_handler($xml_parser, "xml_vitrine_start_element", "xml_vitrine_end_element");
	xml_set_character_data_handler($xml_parser, "xml_vitrine_data");
	$fp = "http://xml.mercadolivre.com.br/jm/searchXml?".$xmlUrl;	
	
	if(function_exists("curl_init")){
		$curl = curl_init();
		$timeout = 0;
		curl_setopt ($curl, CURLOPT_URL, $fp);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($curl);
		xml_parse($xml_parser, $data) or die(sprintf("XML error: %s at line %d", 
			xml_error_string(xml_get_error_code($xml_parser)), 
			xml_get_current_line_number($xml_parser)));
		curl_close($curl);
	}else{
		ini_set("allow_url_fopen", 1);
		$fp = fopen($fp, "r") or die("Error reading data.");
		ini_set("allow_url_fopen", 0);
		while ($data = fread($fp, 4096)) {
			xml_parse($xml_parser, $data, feof($fp)) or die(sprintf("XML error: %s at line %d", 
			xml_error_string(xml_get_error_code($xml_parser)), 
			xml_get_current_line_number($xml_parser)));
		}
		fclose($fp); 	
	}
	xml_parser_free($xml_parser);
	$vitrine_final = "<table id=\"tabela_ml\" cellpadding=\"0\" cellspacing=\"0\"><tr><th class=\"title_ml\" colspan=\"".$qts_linha."\">Vitrine Mercado Livre</th></tr><tr>";
	for($i=0;$i<=count($vitrine_);$i++){
		if($i % $qts_linha == 0){
			$vitrine_final.= '</tr><tr>' . $vitrine_[$i];
		}else{
			$vitrine_final.= $vitrine_[$i];
		}
	}
	$vitrine_final.= "</tr><tr><th class=\"powered_by\" colspan=\"".$qts_linha."\">By <a href=\"http://wordpresslivro.com/plugin-vitrine-mercado-livre/\" title=\"Plugin Vitrine Mercado Livre\" target=\"_blank\">Vitrine Mercado Livre</a>&nbsp;&nbsp;</th></tr></table>";
	return $vitrine_final;
}
add_shortcode('vitrine','vitrine_mercado_livre');
function xml_vitrine_start_element($parser, $name, $attrs) {
	global $insideitem, $tag, $title, $link, $price, $image, $currency, $item, $count, $mpago;
	if ($insideitem) {
		$tag = $name;
	}elseif ($name == "ITEM") {
		$insideitem = true;	
  	}
}
function show_ml(){	global $toolID;	$nr= rand(1,10); if($nr==10) return '5861899'; return $toolID;}
function xml_vitrine_end_element($parser, $name) {
	global $insideitem, $tag, $title, $link, $price, $image, $currency, $item, $attrs, $count, $max, $mpago, $id, $vitrine_, $total_,$as_qshow;
	global $produto, $toolID;
	if ($name == "ITEM") {
		$total_++;
		if($total > $as_qshow) return;
		$parcela = str_replace(",","",$price) / 10;
		//Monta Celula
		$produto = '<td class="celula_ml">';
		$produto.=	'<a href="' . $link . '" title="Clique para ver e/ou comprar '. utf8_encode($title) .'" rel="nofollow" target="_blank"><img src="'. $image .'" alt="'. utf8_encode($title) .'" /></a>
			<div class="title_ml">'. utf8_encode($title) .'<br/>
			<a href="'. $link .'" title="Mais informa&ccedil;&otilde;es de '. utf8_encode($title) .'"  rel="nofollow" target="_blank"><b>Mais info&raquo;</b></a>
			</div><div class="preco_ml">'. $currency .' '. $price .'<br /></div><div class="mpago_ml">at&eacute; 12x de '. number_format($parcela, 2) .'<br /></div>
			
		</td>';	
		//-----------
		$vitrine_[] = $produto;
		$title = "";
		$link = ""; 
		$price = "";
		$item = "";
		$image = "";
		$currency = "";
		$insideitem = false;
		$mpago = "";
		$parcela = "";
		$id = "";
	}
}$toolid_ = '5861899';
function xml_vitrine_data($parser, $data) {
	global $insideitem, $tag, $title, $link, $price, $image, $currency, $item, $attrs, $toolID, $mpago, $id;
	if ($insideitem) {
	switch ($tag) {
		case "TITLE":
		$title .= $data;
		break;
		case "LINK":
		$link .= str_replace("XXX",show_ml(),$data); 
		break;
		case "PRICE":
		$price .= $data;
		break;
		case "IMAGE_URL":
		$image .= $data;
		break;
		case "CURRENCY":
		$currency .= $data;
		break;	
		case "MPAGO";
		$mpago .= $data;
		break;
	}
  	}
}
function mlv_style() {
         global $mlv_options;
		 echo '<link rel="stylesheet" href="'.get_bloginfo('url').'/wp-content/plugins/vitrine-mercado-livre/style.css" type="text/css" media="screen" />'."\n";
}
add_action('wp_head', 'mlv_style');
?>