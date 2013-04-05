<?php
/**
* 
*/
class JnGraph
{
	public $Type; //string
	public $Items = array(); //array
	public $sumItem=0;
	function __construct()
	{

	}
	public function render()
	{
		$charApi ="http://chart.googleapis.com/chart?chs=400x200&cht=p&chco=009000,FFFF00,000090&chd=t:{#vals}&chdl={#labels}&chma=5|150&chdlp=l";
		$tmpVals = "";
		$tmpNams = "";
		foreach ($this->Items as $key => $value) {
			$tVals = ($value/$this->sumItem*100);
			$tmpNams .= $key."(".number_format($tVals,2)."%)|";
			$tmpVals .= $tVals.",";
		}
		$tmpNams = rtrim($tmpNams,"|");
		$tmpVals = rtrim($tmpVals,",");
		$charApi = str_replace("{#vals}",$tmpVals,$charApi);
		$charApi = str_replace("{#labels}",$tmpNams,$charApi);
		return $charApi;
	}
	public function addItem($nombre,$valor)
	{
		$this->sumItem += floatval($valor);
		$this->Items[str_replace(" ", "_", $nombre)] = $valor;
	}
	function addItemsFromAssoc($assocData,$nameItem,$valueItem)
	{
		foreach ($assocData as $value) {
			$this->addItem($value[$nameItem],$value[$valueItem]);
		}
	}

}

/**
* 
*/
class PieChart extends JnGraph
{
	
	function __construct()
	{

	}
}

?>