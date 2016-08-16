<?php

namespace Kununu\Services;

/**
* Klasse Lohnsteuer
*
* @author     Christian Delfs
*/

class Lohnsteuer {
	public static function calc($name, $calc) {
		$result = array();
		if($name != null && class_exists($name,true)) {
			$lohnsteuer = new $name();
			$lohnsteuer->berechnen($calc);
			$avSatz = array('2015'=>0.015,'2016'=>0.015);
        	$avSatz = new BigDecimal($avSatz[$calc['Jahr']]);
        	//$kvSatz = array('2015'=>0.0775,'2016'=>0.073);
        	//$kvSatz = new BigDecimal($kvSatz[$calc['Jahr']])->add((new BigDecimal($calc['ZusatzKV']))->divide(new BigDecimal(100),4));
        	$kvSatz = (new BigDecimal($calc['Krankenversicherungssatz']))->divide(new BigDecimal(2),4)->add(new BigDecimal($calc['ZusatzKV']))->divide(new BigDecimal(100),4);
        	$result['Krankenversicherungssatz'] = $kvSatz->toString();
        	$month = new BigDecimal($calc['Zeitraum'] == 'Monatlich' ? 12 : 1);
			$income = (new BigDecimal($calc['Einkommen']))->multiply($month);
			$result['BruttoeinkommenJahr'] = $income->toString();
			$ls = $lohnsteuer->getLSTLZZ()->divide(new BigDecimal(100),2);
			$result['LohnsteuerJahr'] = $ls->multiply($month)->toString();
			$result['LohnsteuerLaufendj'] = 0;
			$result['LohnsteuerEinmalj'] = 0;
			$result['LohnsteuerMehrj'] = 0;
			$sz = $lohnsteuer->getSOLZLZZ()->divide(new BigDecimal(100),2);
			$result['SolidaritaetszuschlagJahr'] = $sz->multiply($month)->toString();
			$ks = $lohnsteuer->getBK()->divide(new BigDecimal(100),2);
			$result['KirchensteuerJahr'] = $ks->multiply((new BigDecimal($calc['Kirchensteuer']))->divide(new BigDecimal(100),2))->multiply($month)->toString();
			$incomeKv = $income->compareTo($lohnsteuer->getBBGKVPV()) == 1 ? $lohnsteuer->getBBGKVPV() : $income;
			
			if($calc['Krankenversicherung'] == 'privat versichert') {
				//$result['KrankenversicherungJahr'] = $incomeKv->multiply($lohnsteuer->getKVSATZAN())->toString();
				$result['KrankenversicherungJahr'] = $incomeKv->multiply($kvSatz)->toString();
				$result['PflegeversicherungJahr'] = $incomeKv->multiply($lohnsteuer->getPVSATZAN())->toString();
			}else{
				$result['KrankenversicherungJahr'] = (new BigDecimal($calc['Praemie'],2))->multiply(new BigDecimal(12))->toString();
				$result['PflegeversicherungJahr'] = "0.00";
			}
			
			$incomeRv = $income->compareTo($lohnsteuer->getBBGRV()) == 1 ? $lohnsteuer->getBBGRV() : $income;
			
			if($calc['Rente']){
				$result['RentenversicherungJahr'] = $incomeRv->multiply($lohnsteuer->getRVSATZAN())->toString();
			}else{
				$result['RentenversicherungJahr'] = "0.00";
			}
			
			$result['ArbeitslosenversicherungJahr'] = $incomeRv->multiply($avSatz)->toString();
			$result['SteuernJahr'] = $result['LohnsteuerJahr'] + $result['SolidaritaetszuschlagJahr'] + $result['KirchensteuerJahr'];
			$result['SozialversicherungJahr'] = $result['RentenversicherungJahr'] + $result['KrankenversicherungJahr'] + $result['PflegeversicherungJahr'] + $result['ArbeitslosenversicherungJahr'];
			$result['NettoeinkommenJahr'] = $result['BruttoeinkommenJahr'] - $result['SteuernJahr'] - $result['SozialversicherungJahr'];
			
			$month = new BigDecimal($calc['Zeitraum'] == 'Monatlich' ? 1 : 12);
			$result['BruttoeinkommenMonat'] = (new BigDecimal($calc['Einkommen']))->divide($month,2)->toString();
			$result['Lohnsteuer'] = $ls->divide($month,2)->toString();
			$result['LohnsteuerLaufend'] = 0;
			$result['LohnsteuerEinmal'] = 0;
			$result['LohnsteuerMehr'] = 0;
			$result['SolidaritaetszuschlagMonat'] = $sz->divide($month,2)->toString();
			$result['KirchensteuerMonat'] = $ks->multiply((new BigDecimal($calc['Kirchensteuer']))->divide(new BigDecimal(100),2))->divide($month,2)->toString();
			
			if($calc['Krankenversicherung'] == 'privat versichert') {
				$result['KrankenversicherungMonat'] = $calc['Praemie'];
				$result['PflegeversicherungMonat'] = "0.00";
			}else{
				$result['KrankenversicherungMonat'] = $incomeKv->multiply($kvSatz)->divide(new BigDecimal(12),2)->toString();
				$result['PflegeversicherungMonat'] = $incomeKv->multiply($lohnsteuer->getPVSATZAN())->divide(new BigDecimal(12),2)->toString();
			}
			
			if($calc['Rente']){
				$result['RentenversicherungMonat'] = $incomeRv->multiply($lohnsteuer->getRVSATZAN())->divide(new BigDecimal(12),2)->toString();
			}else{
				$result['RentenversicherungMonat'] = "0.00";
			}
			
			$result['ArbeitslosenversicherungMonat'] = $incomeRv->multiply($avSatz)->divide(new BigDecimal(12),2)->toString();
			$result['SteuernMonat'] = $result['Lohnsteuer'] + $result['SolidaritaetszuschlagMonat'] + $result['KirchensteuerMonat'];
			$result['SozialversicherungMonat'] = $result['RentenversicherungMonat'] + $result['KrankenversicherungMonat'] + $result['PflegeversicherungMonat'] + $result['ArbeitslosenversicherungMonat'];
			$result['NettoeinkommenMonat'] = $result['BruttoeinkommenMonat'] - $result['SteuernMonat'] - $result['SozialversicherungMonat'];
		}
		return $result;
	}
}