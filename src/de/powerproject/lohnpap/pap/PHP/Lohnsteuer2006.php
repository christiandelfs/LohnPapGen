<?php

namespace Services;

/**
 * Klasse Lohnsteuer2006
 * 
 * @author Christian Delfs
 */

class Lohnsteuer2006 implements LohnsteuerInterface {


	/* EINGABEPARAMETER*/

	protected $AJAHR;
	protected $ALTER1;
	protected $HINZUR;
	protected $JFREIB;
	protected $JHINZU;
	protected $JRE4;
	protected $JVBEZ;
	protected $KRV;
	protected $LZZ;
	protected $R;
	protected $RE4;
	protected $SONSTB;
	protected $STERBE;
	protected $STKL;
	protected $VBEZ;
	protected $VBEZM;
	protected $VBEZS;
	protected $VBS;
	protected $VJAHR;
	protected $VKAPA;
	protected $VMT;
	protected $WFUNDF;
	protected $ZKF;
	protected $ZMVB;

	/* AUSGABEPARAMETER*/

	protected $BK;
	protected $BKS;
	protected $BKV;
	protected $LSTLZZ;
	protected $SOLZLZZ;
	protected $SOLZS;
	protected $SOLZV;
	protected $STS;
	protected $STV;

	/* INTERNE FELDER*/

	/** Altersentlastungsbetrag nach Alterseinkuenftegesetz in Cents */
	protected $ALTE;

	/** Arbeitnehmer-Pauschbetrag in EURO */
	protected $ANP;

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents abgerundet */
	protected $ANTEIL1;

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents aufgerundet */
	protected $ANTEIL2;

	/** Bemessungsgrundlage fuer Altersentlastungsbetrag in Cents */
	protected $BMG;

	/** Differenz zwischen ST1 und ST2 in EURO */
	protected $DIFF;

	/** Entlastungsbetrag fuer Alleinerziehende in EURO */
	protected $EFA;

	/** Versorgungsfreibetrag in Cents */
	protected $FVB;

	/** Zuschlag zum Versorgungsfreibetrag in EURO */
	protected $FVBZ;

	/** Massgeblich maximaler Versorgungsfreibetrag in Cents */
	protected $HFVB;

	/** Nummer der Tabellenwerte fuer Versorgungsparameter */
	protected $J;

	/** Jahressteuer nach § 51a EStG, aus der Solidaritaetszuschlag und<br>
             Bemessungsgrundlage fuer die Kirchenlohnsteuer ermittelt werden in EURO */
	protected $JBMG;

	/** Jahreswert, dessen Anteil fuer einen Lohnzahlungszeitraum in<br>
             UPANTEIL errechnet werden soll in Cents */
	protected $JW;

	/** Nummer der Tabellenwerte fuer Parameter bei Altersentlastungsbetrag */
	protected $K;

	/** Kennzeichen bei Verguetung fuer mehrjaehrige Taetigkeit<br>
             0 = beim Vorwegabzug ist ZRE4VP zu beruecksichtigen<br>
             1 = beim Vorwegabzug ist ZRE4VP1 zu beruecksichtigen */
	protected $KENNZ;

	/** Summe der Freibetraege fuer Kinder in EURO */
	protected $KFB;

	/** Kennzahl fuer die Einkommensteuer-Tabellenart:<br>
             1 = Grundtabelle<br>
             2 = Splittingtabelle */
	protected $KZTAB;

	/** Jahreslohnsteuer in EURO */
	protected $LSTJAHR;

	/** Zwischenfelder der Jahreslohnsteuer in Cents */
	protected $LST1;
	protected $LST2;
	protected $LST3;

	/** Mindeststeuer fuer die Steuerklassen V und VI in EURO */
	protected $MIST;

	/** Arbeitslohn des Lohnzahlungszeitraums nach Abzug der Freibetraege<br>
             fuer Versorgungsbezuege, des Altersentlastungsbetrags und des<br>
             in der Lohnsteuerkarte eingetragenen Freibetrags und Hinzurechnung<br>
             eines Hinzurechnungsbetrags in Cents. Entspricht dem Arbeitslohn,<br>
             fuer den die Lohnsteuer im personellen Verfahren aus der<br>
             zum Lohnzahlungszeitraum gehoerenden Tabelle abgelesen wuerde */
	protected $RE4LZZ;

	/** Arbeitslohn des Lohnzahlungszeitraums nach Abzug der Freibetraege<br>
             fuer Versorgungsbezuege und des Altersentlastungsbetrags in<br>
             Cents zur Berechnung der Vorsorgepauschale */
	protected $RE4LZZV;

	/** Rechenwert in Gleitkommadarstellung */
	protected $RW;

	/** Sonderausgaben-Pauschbetrag in EURO */
	protected $SAP;

	/** Freigrenze fuer den Solidaritaetszuschlag in EURO */
	protected $SOLZFREI;

	/** Solidaritaetszuschlag auf die Jahreslohnsteuer in EURO, C (2 Dezimalstellen) */
	protected $SOLZJ;

	/** Zwischenwert fuer den Solidaritaetszuschlag auf die Jahreslohnsteuer<br>
             in EURO, C (2 Dezimalstellen) */
	protected $SOLZMIN;

	/** Tarifliche Einkommensteuer in EURO */
	protected $ST;

	/** Tarifliche Einkommensteuer auf das 1,25-fache ZX in EURO */
	protected $ST1;

	/** Tarifliche Einkommensteuer auf das 0,75-fache ZX in EURO */
	protected $ST2;

	/** Bemessungsgrundlage fuer den Versorgungsfreibetrag in Cents */
	protected $VBEZB;

	/** Hoechstbetrag der Vorsorgepauschale nach Alterseinkuenftegesetz in EURO, C */
	protected $VHB;

	/** Vorsorgepauschale in EURO, C (2 Dezimalstellen) */
	protected $VSP;

	/** Vorsorgepauschale nach Alterseinkuenftegesetz in EURO, C */
	protected $VSPN;

	/** Zwischenwert 1 bei der Berechnung der Vorsorgepauschale nach<br>
             dem Alterseinkuenftegesetz in EURO, C (2 Dezimalstellen) */
	protected $VSP1;

	/** Zwischenwert 2 bei der Berechnung der Vorsorgepauschale nach<br>
             dem Alterseinkuenftegesetz in EURO, C (2 Dezimalstellen) */
	protected $VSP2;

	/** Hoechstbetrag der Vorsorgepauschale nach § 10c Abs. 3 EStG in EURO */
	protected $VSPKURZ;

	/** Hoechstbetrag der Vorsorgepauschale nach § 10c Abs. 2 Nr. 2 EStG in EURO */
	protected $VSPMAX1;

	/** Hoechstbetrag der Vorsorgepauschale nach § 10c Abs. 2 Nr. 3 EStG in EURO */
	protected $VSPMAX2;

	/** Vorsorgepauschale nach § 10c Abs. 2 Satz 2 EStG vor der Hoechstbetragsberechnung<br>
             in EURO, C (2 Dezimalstellen) */
	protected $VSPO;

	/** Fuer den Abzug nach § 10c Abs. 2 Nrn. 2 und 3 EStG verbleibender<br>
             Rest von VSPO in EURO, C (2 Dezimalstellen) */
	protected $VSPREST;

	/** Hoechstbetrag der Vorsorgepauschale nach § 10c Abs. 2 Nr. 1 EStG<br>
             in EURO, C (2 Dezimalstellen) */
	protected $VSPVOR;

	/** Zu versteuerndes Einkommen gem. § 32a Abs. 1 und 2 EStG<br>
             (2 Dezimalstellen) */
	protected $X;

	/** gem. § 32a Abs. 1 EStG (6 Dezimalstellen) */
	protected $Y;

	/** Auf einen Jahreslohn hochgerechnetes RE4LZZ in EURO, C (2 Dezimalstellen) */
	protected $ZRE4;

	/** Auf einen Jahreslohn hochgerechnetes RE4LZZV zur Berechnung<br>
             der Vorsorgepauschale in EURO, C (2 Dezimalstellen) */
	protected $ZRE4VP;

	/** Sicherungsfeld von ZRE4VP in EURO,C bei der Berechnung des Vorwegabzugs<br>
             fuer die Verguetung fuer mehrjaehrige Taetigkeit */
	protected $ZRE4VP1;

	/** Feste Tabellenfreibetraege (ohne Vorsorgepauschale) in EURO */
	protected $ZTABFB;

	/** Auf einen Jahreslohn hochgerechnetes (VBEZ abzueglich FVB) in<br>
             EURO, C (2 Dezimalstellen) */
	protected $ZVBEZ;

	/** Zu versteuerndes Einkommen in EURO */
	protected $ZVE;

	/** Zwischenfelder zu X fuer die Berechnung der Steuer nach § 39b<br>
             Abs. 2 Satz 8 EStG in EURO. */
	protected $ZX;
	protected $ZZX;
	protected $HOCH;
	protected $VERGL;

	/* KONSTANTEN */

	/** Tabelle fuer die Vomhundertsaetze des Versorgungsfreibetrags */
	protected static $TAB1;

	/** Tabelle fuer die Hoechstbetrage des Versorgungsfreibetrags */
	protected static $TAB2;

	/** Tabelle fuer die Zuschlaege zum Versorgungsfreibetrag */
	protected static $TAB3;

	/** Tabelle fuer die Vomhundertsaetze des Altersentlastungsbetrags */
	protected static $TAB4;

	/** Tabelle fuer die Hoechstbetraege des Altersentlastungsbetrags */
	protected static $TAB5;

	/** Zahlenkonstanten fuer im Plan oft genutzte BigDecimal Werte */
	protected static $ZAHL0;
	protected static $ZAHL1;
	protected static $ZAHL2;
	protected static $ZAHL3;
	protected static $ZAHL4;
	protected static $ZAHL5;
	protected static $ZAHL6;
	protected static $ZAHL7;
	protected static $ZAHL8;
	protected static $ZAHL9;
	protected static $ZAHL10;
	protected static $ZAHL11;
	protected static $ZAHL12;
	protected static $ZAHL100;
	protected static $ZAHL360;

	/* SETTER */

	
	public function setRE4($arg0) { $this->RE4 = $arg0; }

	
	public function setJHINZU($arg0) { $this->JHINZU = $arg0; }

	
	public function setVKAPA($arg0) { $this->VKAPA = $arg0; }

	
	public function setSTKL($arg0) { $this->STKL = $arg0; }

	
	public function setVBS($arg0) { $this->VBS = $arg0; }

	
	public function setVBEZS($arg0) { $this->VBEZS = $arg0; }

	
	public function setVBEZ($arg0) { $this->VBEZ = $arg0; }

	
	public function setVJAHR($arg0) { $this->VJAHR = $arg0; }

	
	public function setHINZUR($arg0) { $this->HINZUR = $arg0; }

	
	public function setLZZ($arg0) { $this->LZZ = $arg0; }

	
	public function setKRV($arg0) { $this->KRV = $arg0; }

	
	public function setJFREIB($arg0) { $this->JFREIB = $arg0; }

	
	public function setSONSTB($arg0) { $this->SONSTB = $arg0; }

	
	public function setJVBEZ($arg0) { $this->JVBEZ = $arg0; }

	
	public function setR($arg0) { $this->R = $arg0; }

	
	public function setSTERBE($arg0) { $this->STERBE = $arg0; }

	
	public function setAJAHR($arg0) { $this->AJAHR = $arg0; }

	
	public function setZKF($arg0) { $this->ZKF = $arg0; }

	
	public function setJRE4($arg0) { $this->JRE4 = $arg0; }

	
	public function setZMVB($arg0) { $this->ZMVB = $arg0; }

	
	public function setVBEZM($arg0) { $this->VBEZM = $arg0; }

	
	public function setALTER1($arg0) { $this->ALTER1 = $arg0; }

	
	public function setVMT($arg0) { $this->VMT = $arg0; }

	
	public function setWFUNDF($arg0) { $this->WFUNDF = $arg0; }

	/* GETTER */

	
	public function getSTS() { return $this->STS; }

	
	public function getSTV() { return $this->STV; }

	
	public function getLSTLZZ() { return $this->LSTLZZ; }

	
	public function getBK() { return $this->BK; }

	
	public function getSOLZV() { return $this->SOLZV; }

	
	public function getBKS() { return $this->BKS; }

	
	public function getBKV() { return $this->BKV; }

	
	public function getSOLZLZZ() { return $this->SOLZLZZ; }

	
	public function getSOLZS() { return $this->SOLZS; }


	
	public function getVSPREST() { return $this->VSPREST; }

	
	public function getLST3() { return $this->LST3; }

	
	public function getZTABFB() { return $this->ZTABFB; }

	
	public function getLST2() { return $this->LST2; }

	
	public function getLST1() { return $this->LST1; }

	
	public function getZVE() { return $this->ZVE; }

	
	public function getFVBZ() { return $this->FVBZ; }

	
	public function getSOLZFREI() { return $this->SOLZFREI; }

	
	public function getHFVB() { return $this->HFVB; }

	
	public function getHOCH() { return $this->HOCH; }

	
	public function getLSTJAHR() { return $this->LSTJAHR; }

	
	public function getSOLZJ() { return $this->SOLZJ; }

	
	public function getZZX() { return $this->ZZX; }

	
	public function getANTEIL2() { return $this->ANTEIL2; }

	
	public function getANTEIL1() { return $this->ANTEIL1; }

	
	public function getVSPMAX2() { return $this->VSPMAX2; }

	
	public function getDIFF() { return $this->DIFF; }

	
	public function getVSPMAX1() { return $this->VSPMAX1; }

	
	public function getZVBEZ() { return $this->ZVBEZ; }

	
	public function getVSP() { return $this->VSP; }

	
	public function getZX() { return $this->ZX; }

	
	public function getEFA() { return $this->EFA; }

	
	public function getKENNZ() { return $this->KENNZ; }

	
	public function getALTE() { return $this->ALTE; }

	
	public function getANP() { return $this->ANP; }

	
	public function getSAP() { return $this->SAP; }

	
	public function getRW() { return $this->RW; }

	
	public function getSOLZMIN() { return $this->SOLZMIN; }

	
	public function getKFB() { return $this->KFB; }

	
	public function getJ() { return $this->J; }

	
	public function getK() { return $this->K; }

	
	public function getJW() { return $this->JW; }

	
	public function getVHB() { return $this->VHB; }

	
	public function getVSPN() { return $this->VSPN; }

	
	public function getZRE4VP1() { return $this->ZRE4VP1; }

	
	public function getVSPO() { return $this->VSPO; }

	
	public function getRE4LZZV() { return $this->RE4LZZV; }

	
	public function getX() { return $this->X; }

	
	public function getMIST() { return $this->MIST; }

	
	public function getRE4LZZ() { return $this->RE4LZZ; }

	
	public function getY() { return $this->Y; }

	
	public function getVBEZB() { return $this->VBEZB; }

	
	public function getBMG() { return $this->BMG; }

	
	public function getVSPVOR() { return $this->VSPVOR; }

	
	public function getST() { return $this->ST; }

	
	public function getVSPKURZ() { return $this->VSPKURZ; }

	
	public function getKZTAB() { return $this->KZTAB; }

	
	public function getZRE4() { return $this->ZRE4; }

	
	public function getJBMG() { return $this->JBMG; }

	
	public function getST2() { return $this->ST2; }

	
	public function getST1() { return $this->ST1; }

	
	public function getFVB() { return $this->FVB; }

	
	public function getVERGL() { return $this->VERGL; }

	
	public function getVSP1() { return $this->VSP1; }

	
	public function getZRE4VP() { return $this->ZRE4VP; }

	
	public function getVSP2() { return $this->VSP2; }

	function __construct() {
	$this->VSPREST=new BigDecimal(0);
	$this->JHINZU=new BigDecimal(0);
	$this->LST3=new BigDecimal(0);
	$this->ZTABFB=new BigDecimal(0);
	$this->LST2=new BigDecimal(0);
	$this->LST1=new BigDecimal(0);
	$this->ZVE=new BigDecimal(0);
	$this->VJAHR=0;
	$this->FVBZ=new BigDecimal(0);
	$this->SOLZFREI=new BigDecimal(0);
	$this->HFVB=new BigDecimal(0);
	$this->LZZ=0;
	$this->HOCH=new BigDecimal(0);
	$this->JFREIB=new BigDecimal(0);
	$this->LSTJAHR=new BigDecimal(0);
	$this->JVBEZ=new BigDecimal(0);
	$this->STS=new BigDecimal(0);
	$this->STV=new BigDecimal(0);
	$this->SOLZJ=new BigDecimal(0);
	$this->ZZX=new BigDecimal(0);
	$this->SOLZV=new BigDecimal(0);
	$this->ANTEIL2=new BigDecimal(0);
	$this->SOLZS=new BigDecimal(0);
	$this->ANTEIL1=new BigDecimal(0);
	$this->STKL=0;
	$this->VSPMAX2=new BigDecimal(0);
	$this->DIFF=new BigDecimal(0);
	$this->VSPMAX1=new BigDecimal(0);
	$this->VBS=new BigDecimal(0);
	$this->ZVBEZ=new BigDecimal(0);
	$this->BKS=new BigDecimal(0);
	$this->BKV=new BigDecimal(0);
	$this->SOLZLZZ=new BigDecimal(0);
	$this->VSP=new BigDecimal(0);
	$this->ZKF=new BigDecimal(0);
	$this->ZMVB=0;
	$this->ALTER1=0;
	$this->ZX=new BigDecimal(0);
	$this->EFA=new BigDecimal(0);
	$this->KENNZ=0;
	$this->ALTE=new BigDecimal(0);
	$this->VKAPA=new BigDecimal(0);
	$this->ANP=new BigDecimal(0);
	$this->SAP=new BigDecimal(0);
	$this->RW=new BigDecimal(0);
	$this->SOLZMIN=new BigDecimal(0);
	$this->KFB=new BigDecimal(0);
	$this->VBEZS=new BigDecimal(0);
	$this->VBEZ=new BigDecimal(0);
	$this->BK=new BigDecimal(0);
	$this->J=0;
	$this->K=0;
	$this->JW=new BigDecimal(0);
	$this->KRV=0;
	$this->VHB=new BigDecimal(0);
	$this->R=0;
	$this->VSPN=new BigDecimal(0);
	$this->ZRE4VP1=new BigDecimal(0);
	$this->VSPO=new BigDecimal(0);
	$this->RE4LZZV=new BigDecimal(0);
	$this->VBEZM=new BigDecimal(0);
	$this->LSTLZZ=new BigDecimal(0);
	$this->X=new BigDecimal(0);
	$this->MIST=new BigDecimal(0);
	$this->RE4LZZ=new BigDecimal(0);
	$this->Y=new BigDecimal(0);
	$this->VBEZB=new BigDecimal(0);
	$this->WFUNDF=new BigDecimal(0);
	$this->BMG=new BigDecimal(0);
	$this->VSPVOR=new BigDecimal(0);
	$this->RE4=new BigDecimal(0);
	$this->ST=new BigDecimal(0);
	$this->VSPKURZ=new BigDecimal(0);
	$this->HINZUR=new BigDecimal(0);
	$this->KZTAB=0;
	$this->ZRE4=new BigDecimal(0);
	$this->SONSTB=new BigDecimal(0);
	$this->JBMG=new BigDecimal(0);
	$this->ST2=new BigDecimal(0);
	$this->ST1=new BigDecimal(0);
	$this->STERBE=new BigDecimal(0);
	$this->FVB=new BigDecimal(0);
	$this->AJAHR=0;
	$this->VERGL=new BigDecimal(0);
	$this->JRE4=new BigDecimal(0);
	$this->VSP1=new BigDecimal(0);
	$this->ZRE4VP=new BigDecimal(0);
	$this->VSP2=new BigDecimal(0);
	$this->VMT=new BigDecimal(0);
	self::$ZAHL11=new BigDecimal(11);
	self::$ZAHL10=new BigDecimal(10);
	self::$ZAHL12=new BigDecimal(12);
	self::$TAB5=array(0, 1900, 1824, 1748, 1672, 1596, 1520, 1444, 1368, 1292, 1216, 1140, 1064, 988, 912, 836, 760, 722, 684, 646, 608, 570, 532, 494, 456, 418, 380, 342, 304, 266, 228, 190, 152, 114, 76, 38, 0);
	self::$ZAHL100=new BigDecimal(100);
	self::$ZAHL1=new BigDecimal(1);
	self::$ZAHL2=new BigDecimal(2);
	self::$ZAHL0=new BigDecimal(0);
	self::$ZAHL360=new BigDecimal(360);
	self::$TAB4=array(0.0, 0.400, 0.384, 0.368, 0.352, 0.336, 0.320, 0.304, 0.288, 0.272, 0.256, 0.240, 0.224, 0.208, 0.192, 0.176, 0.160, 0.152, 0.144, 0.136, 0.128, 0.120, 0.112, 0.104, 0.096, 0.088, 0.080, 0.072, 0.064, 0.056, 0.048, 0.040, 0.032, 0.024, 0.016, 0.008, 0.000);
	self::$ZAHL5=new BigDecimal(5);
	self::$TAB3=array(0, 900, 864, 828, 792, 756, 720, 684, 648, 612, 576, 540, 504, 468, 432, 396, 360, 342, 324, 306, 288, 270, 252, 234, 216, 198, 180, 162, 144, 126, 108, 90, 72, 54, 36, 18, 0);
	self::$ZAHL6=new BigDecimal(6);
	self::$TAB2=array(0, 3000, 2880, 2760, 2640, 2520, 2400, 2280, 2160, 2040, 1920, 1800, 1680, 1560, 1440, 1320, 1200, 1140, 1080, 1020, 960, 900, 840, 780, 720, 660, 600, 540, 480, 420, 360, 300, 240, 180, 120, 60, 0);
	self::$ZAHL3=new BigDecimal(3);
	self::$TAB1=array(0.0, 0.400, 0.384, 0.368, 0.352, 0.336, 0.320, 0.304, 0.288, 0.272, 0.256, 0.240, 0.224, 0.208, 0.192, 0.176, 0.160, 0.152, 0.144, 0.136, 0.128, 0.120, 0.112, 0.104, 0.096, 0.088, 0.080, 0.072, 0.064, 0.056, 0.048, 0.040, 0.032, 0.024, 0.016, 0.008, 0.000);
	self::$ZAHL4=new BigDecimal(4);
	self::$ZAHL9=new BigDecimal(9);
	self::$ZAHL7=new BigDecimal(7);
	self::$ZAHL8=new BigDecimal(8);
	}
	/** PROGRAMMABLAUFPLAN 2006 */
	
	public function main() {

		$this->MRE4LZZ();
		$this->KENNZ = 0;
		$this->RE4LZZ = $this->RE4->subtract($this->FVB)->subtract($this->ALTE)->subtract($this->WFUNDF)->add($this->HINZUR);
		$this->RE4LZZV = $this->RE4->subtract($this->FVB)->subtract($this->ALTE);
		$this->MRE4();
		$this->MZTABFB();
		$this->MLSTJAHR();
		$this->LSTJAHR = $this->ST;
		$this->JW = $this->LSTJAHR->multiply(self::ZAHL100());
		$this->UPANTEIL();
		$this->LSTLZZ = $this->ANTEIL1;
		if($this->ZKF->compareTo(self::ZAHL0()) == 1) {
			$this->ZTABFB = $this->ZTABFB->add($this->KFB);
			$this->MLSTJAHR();
			$this->JBMG = $this->ST;
		} else {
			$this->JBMG = $this->LSTJAHR;
		}
		$this->MSOLZ();
		$this->MSONST();
		$this->MVMT();
	}

	/** Freibetraege fuer Versorgungsbezuege, Altersentlastungsbetrag (§39b Abs. 2 Satz 2 EStG) <br>
         PAP Seite 10 */
	protected function MRE4LZZ() {

		if($this->VBEZ->compareTo(self::ZAHL0()) == 0) {
			$this->FVBZ = self::ZAHL0();
			$this->FVB = self::ZAHL0();
		} else {
			if($this->VJAHR < 2006) {
				$this->J = 1;
			} else {
				if($this->VJAHR < 2040) {
					$this->J = $this->VJAHR - 2004;
				} else {
					$this->J = 36;
				}
			}
			if($this->LZZ == 1) {
				if((($this->STERBE->add($this->VKAPA))->compareTo(self::ZAHL0())) == 1) {
					$this->VBEZB = ($this->VBEZM->multiply(BigDecimal::valueOf($this->ZMVB)))->add($this->VBEZS);
					$this->HFVB = BigDecimal::valueOf(self::TAB2()[$this->J] * 100);
					$this->FVBZ = BigDecimal::valueOf(self::TAB3()[$this->J]);
				} else {
					$this->VBEZB = ($this->VBEZM->multiply(BigDecimal::valueOf($this->ZMVB)))->add($this->VBEZS);
					$this->HFVB = BigDecimal::valueOf(self::TAB2()[$this->J] / 12 * $this->ZMVB * 100);
					$this->FVBZ = (BigDecimal::valueOf(self::TAB3()[$this->J] / 12 * $this->ZMVB))->setScale(0, BigDecimal::$ROUND_UP);
				}
			} else {
				$this->VBEZB = (($this->VBEZM->multiply(self::ZAHL12()))->add($this->VBEZS))->setScale(2, BigDecimal::$ROUND_DOWN);
				$this->HFVB = BigDecimal::valueOf(self::TAB2()[$this->J] * 100);
				$this->FVBZ = BigDecimal::valueOf(self::TAB3()[$this->J]);
			}
			$this->FVB = ($this->VBEZB->multiply(BigDecimal::valueOf(self::TAB1()[$this->J])))->setScale(0, BigDecimal::$ROUND_UP);
			if($this->FVB->compareTo($this->HFVB) == 1) {
				$this->FVB = $this->HFVB;
			} else {
			}
			$this->JW = $this->FVB;
			$this->UPANTEIL();
			$this->FVB = $this->ANTEIL2;
		}
		if($this->ALTER1 == 0) {
			$this->ALTE = self::ZAHL0();
		} else {
			if($this->AJAHR < 2006) {
				$this->K = 1;
			} else {
				if($this->AJAHR < 2040) {
					$this->K = $this->AJAHR - 2004;
				} else {
					$this->K = 36;
				}
			}
			$this->BMG = $this->RE4->subtract($this->VBEZ);
			$this->ALTE = ($this->BMG->multiply(BigDecimal::valueOf(self::TAB4()[$this->K])))->setScale(0, BigDecimal::$ROUND_UP);
			$this->JW = BigDecimal::valueOf(self::TAB5()[$this->K] * 100);
			$this->UPANTEIL();
			if($this->ALTE->compareTo($this->ANTEIL2) == 1) {
				$this->ALTE = $this->ANTEIL2;
			} else {
			}
		}
	}

	/** Massgeblicher Arbeitslohn fuer die Jahreslohnsteuer <br>
         PAP Seite 12 */
	protected function MRE4() {

		if($this->LZZ == 1) {
			$this->ZRE4 = $this->RE4LZZ->divide(self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
			$this->ZRE4VP = $this->RE4LZZV->divide(self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZ = ($this->VBEZ->subtract($this->FVB))->divide(self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->LZZ == 2) {
				$this->ZRE4 = (($this->RE4LZZ->add(BigDecimal::valueOf(0.67)))->multiply(BigDecimal::valueOf(0.12)))->setScale(2, BigDecimal::$ROUND_DOWN);
				$this->ZRE4VP = (($this->RE4LZZV->add(BigDecimal::valueOf(0.67)))->multiply(BigDecimal::valueOf(0.12)))->setScale(2, BigDecimal::$ROUND_DOWN);
				$this->ZVBEZ = (($this->VBEZ->subtract($this->FVB)->add(BigDecimal::valueOf(0.67)))->multiply(BigDecimal::valueOf(0.12)))->setScale(2, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->LZZ == 3) {
					$this->ZRE4 = (($this->RE4LZZ->add(BigDecimal::valueOf(0.89)))->multiply(BigDecimal::valueOf(3.6/7.0)))->setScale(2, BigDecimal::$ROUND_DOWN);
					$this->ZRE4VP = (($this->RE4LZZV->add(BigDecimal::valueOf(0.89)))->multiply(BigDecimal::valueOf(3.6/7.0)))->setScale(2, BigDecimal::$ROUND_DOWN);
					$this->ZVBEZ = (($this->VBEZ->subtract($this->FVB)->add(BigDecimal::valueOf(0.89)))->multiply(BigDecimal::valueOf(3.6/7.0)))->setScale(2, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ZRE4 = (($this->RE4LZZ->add(BigDecimal::valueOf(0.56)))->multiply(BigDecimal::valueOf(3.6)))->setScale(2, BigDecimal::$ROUND_DOWN);
					$this->ZRE4VP = (($this->RE4LZZV->add(BigDecimal::valueOf(0.56)))->multiply(BigDecimal::valueOf(3.6)))->setScale(2, BigDecimal::$ROUND_DOWN);
					$this->ZVBEZ = (($this->VBEZ->subtract($this->FVB)->add(BigDecimal::valueOf(0.56)))->multiply(BigDecimal::valueOf(3.6)))->setScale(2, BigDecimal::$ROUND_DOWN);
				}
			}
		}
		if($this->ZRE4->compareTo(self::ZAHL0()) == -1) {
			$this->ZRE4 = self::ZAHL0();
		} else {
		}
		if($this->ZVBEZ->compareTo(self::ZAHL0()) == -1) {
			$this->ZVBEZ = self::ZAHL0();
		} else {
		}
	}

	/** Ermittlung der festen Tabellenfreibetraege (ohne Vorsorgepauschale)<br>
         PAP Seite 13 */
	protected function MZTABFB() {

		$this->ANP = self::ZAHL0();
		if($this->ZVBEZ->compareTo(self::ZAHL0()) == 1) {
			if($this->ZVBEZ->compareTo($this->FVBZ) == -1) {/** Fehler im PAP? double -> int, Nachkommastellen abschneiden */
				$this->FVBZ = $this->ZVBEZ->setScale(0, BigDecimal::$ROUND_DOWN);
			} else {
			}
		} else {
		}
		if($this->STKL < 6) {
			if($this->ZVBEZ->compareTo(self::ZAHL0()) == 1) {
				if(($this->ZVBEZ->subtract($this->FVBZ))->compareTo(BigDecimal::valueOf(102)) == -1) {/** Fehler im PAP? double -> int, Nachkommastellen abschneiden */
					$this->ANP = ($this->ZVBEZ->subtract($this->FVBZ))->setScale(0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ANP = BigDecimal::valueOf(102);
				}
			} else {
			}
		} else {
		}
		if($this->STKL < 6) {
			if($this->ZRE4->compareTo($this->ZVBEZ) == 1) {
				if(($this->ZRE4->subtract($this->ZVBEZ))->compareTo(BigDecimal::valueOf(920)) == -1) {/** Fehler im PAP? double -> int, Nachkommastellen abschneiden */
					$this->ANP = ($this->ANP->add($this->ZRE4)->subtract($this->ZVBEZ))->setScale(0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ANP = $this->ANP->add(BigDecimal::valueOf(920));
				}
			} else {
			}
		} else {
		}
		$this->KZTAB = 1;
		if($this->STKL == 1) /** ZKF ist double und KFB ist integer. Nachkommastellen abschneiden! 4x!!! */{
			$this->SAP = BigDecimal::valueOf(36);
			$this->KFB = ($this->ZKF->multiply(BigDecimal::valueOf(5808)))->setScale(0, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->STKL == 2) {
				$this->EFA = BigDecimal::valueOf(1308);
				$this->SAP = BigDecimal::valueOf(36);
				$this->KFB = ($this->ZKF->multiply(BigDecimal::valueOf(5808)))->setScale(0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->STKL == 3) {
					$this->KZTAB = 2;
					$this->SAP = BigDecimal::valueOf(72);
					$this->KFB = ($this->ZKF->multiply(BigDecimal::valueOf(5808)))->setScale(0, BigDecimal::$ROUND_DOWN);
				} else {
					if($this->STKL == 4) {
						$this->SAP = BigDecimal::valueOf(36);
						$this->KFB = ($this->ZKF->multiply(BigDecimal::valueOf(2904)))->setScale(0, BigDecimal::$ROUND_DOWN);
					} else {
						$this->KFB = self::ZAHL0();
					}
				}
			}
		}
		$this->ZTABFB = $this->EFA->add($this->ANP)->add($this->SAP)->add($this->FVBZ);
	}

	/** Ermittlung Jahreslohnsteuer<br>
         PAP Seite 14 */
	protected function MLSTJAHR() {

		if($this->STKL < 5) {
			$this->UPEVP();
		} else {
			$this->VSP = self::ZAHL0();
		}/** ZVE ist in EURO, ZRE4 in EURO,Cent */
		$this->ZVE = ($this->ZRE4->subtract($this->ZTABFB)->subtract($this->VSP))->setScale(0, BigDecimal::$ROUND_DOWN);
		if($this->ZVE->compareTo(self::ZAHL1()) == -1) {
			$this->ZVE = self::ZAHL0();
			$this->X = self::ZAHL0();
		} else {
			$this->X = $this->ZVE->divide(BigDecimal::valueOf($this->KZTAB), 0, BigDecimal::$ROUND_DOWN);
		}
		if($this->STKL < 5) {
			$this->UPTAB05();
		} else {
			$this->MST5_6();
		}
	}

	/** Vorsorgepauschale (§39b Abs. 2 Satz 6 Nr 3 EStG) <br>
         PAP Seite 15 */
	protected function UPEVP() {

		if($this->KRV == 1) {
			$this->VSP1 = self::ZAHL0();
		} else {
			if($this->ZRE4VP->compareTo(BigDecimal::valueOf(63000)) == 1) {
				$this->ZRE4VP = BigDecimal::valueOf(63000);
			} else {
			}
			$this->VSP1 = ($this->ZRE4VP->multiply(BigDecimal::valueOf(0.24)))->setScale(2, BigDecimal::$ROUND_DOWN);
			$this->VSP1 = ($this->VSP1->multiply(BigDecimal::valueOf(0.0975)))->setScale(2, BigDecimal::$ROUND_DOWN);
		}
		$this->VSP2 = $this->ZRE4VP->multiply(BigDecimal::valueOf(0.11));
		$this->VHB = BigDecimal::valueOf(1500 * $this->KZTAB);
		if($this->VSP2->compareTo($this->VHB) == 1) {
			$this->VSP2 = $this->VHB;
		} else {
		}/** Erst auf 2 nachkommastellen kuerzen, dann aufrunden, sonst <br>
             wird die Jahreslohnsteuer ggf. um 1 EUR zu hoch angesetzt.<br>
             Hinweis: wieder aufgehoben, da bei VSP1 eine Rundung fehlte. */
		$this->VSPN = ($this->VSP1->add($this->VSP2))->setScale(0, BigDecimal::$ROUND_UP);
		$this->MVSP();
		if($this->VSPN->compareTo($this->VSP) == 1) {
			$this->VSP = $this->VSPN->setScale(2, BigDecimal::$ROUND_DOWN);
		} else {
		}
	}

	/** Vorsorgepauschale (§39b Abs. 2 Satz 6 Nr 3 EStG) Vergleichsberechnung <br>
         fuer Guenstigerpruefung<br>
         PAP Seite 16 */
	protected function MVSP() {

		if($this->KENNZ == 1) {
			$this->VSPO = $this->ZRE4VP1->multiply(BigDecimal::valueOf(0.2));
		} else {
			$this->VSPO = $this->ZRE4VP->multiply(BigDecimal::valueOf(0.2));
		}
		$this->VSPVOR = BigDecimal::valueOf($this->KZTAB * 3068);
		$this->VSPMAX1 = BigDecimal::valueOf($this->KZTAB * 1334);
		$this->VSPMAX2 = BigDecimal::valueOf($this->KZTAB * 667);
		$this->VSPKURZ = BigDecimal::valueOf($this->KZTAB * 1134);
		if($this->KRV == 1) {
			if($this->VSPO->compareTo($this->VSPKURZ) == 1) {
				$this->VSP = $this->VSPKURZ;
			} else {
				$this->VSP = $this->VSPO->setScale(2, BigDecimal::$ROUND_UP);
			}
		} else {
			$this->UMVSP();
		}
	}

	/** Vorsorgepauschale<br>
         PAP Seite 17 */
	protected function UMVSP() {

		if($this->KENNZ == 1) {
			$this->VSPVOR = $this->VSPVOR->subtract($this->ZRE4VP1->multiply(BigDecimal::valueOf(0.16)));
		} else {
			$this->VSPVOR = $this->VSPVOR->subtract($this->ZRE4VP->multiply(BigDecimal::valueOf(0.16)));
		}
		if($this->VSPVOR->compareTo(self::ZAHL0()) == -1) {
			$this->VSPVOR = self::ZAHL0();
		} else {
		}
		if($this->VSPO->compareTo($this->VSPVOR) == 1) {
			$this->VSP = $this->VSPVOR;
			$this->VSPREST = $this->VSPO->subtract($this->VSPVOR);
			if($this->VSPREST->compareTo($this->VSPMAX1) == 1) {
				$this->VSP = $this->VSP->add($this->VSPMAX1);
				$this->VSPREST = ($this->VSPREST->subtract($this->VSPMAX1))->divide(self::ZAHL2(), 2, BigDecimal::$ROUND_UP);
				if($this->VSPREST->compareTo($this->VSPMAX2) == 1) {
					$this->VSP = ($this->VSP->add($this->VSPMAX2))->setScale(0, BigDecimal::$ROUND_UP);
				} else {
					$this->VSP = ($this->VSP->add($this->VSPREST))->setScale(0, BigDecimal::$ROUND_UP);
				}
			} else {
				$this->VSP = ($this->VSP->add($this->VSPREST))->setScale(0, BigDecimal::$ROUND_UP);
			}
		} else {
			$this->VSP = $this->VSPO->setScale(0, BigDecimal::$ROUND_UP);
		}
	}

	/** Lohnsteuer fuer die Steuerklassen V und VI (§ 39b Abs. 2 Satz 8 EStG)<br>
         PAP Seite 18 */
	protected function MST5_6() {

		$this->ZZX = $this->X;
		if($this->ZZX->compareTo(BigDecimal::valueOf(25812)) == 1) {
			$this->ZX = BigDecimal::valueOf(25812);
			$this->UP5_6();
			$this->ST = ($this->ST->add(($this->ZZX->subtract(BigDecimal::valueOf(25812)))->multiply(BigDecimal::valueOf(0.42))))->setScale(0, BigDecimal::$ROUND_DOWN);
		} else {
			$this->ZX = $this->ZZX;
			$this->UP5_6();
			if($this->ZZX->compareTo(BigDecimal::valueOf(9144)) == 1) {
				$this->VERGL = $this->ST;
				$this->ZX = BigDecimal::valueOf(9144);
				$this->UP5_6();
				$this->HOCH = ($this->ST->add(($this->ZZX->subtract(BigDecimal::valueOf(9144)))->multiply(BigDecimal::valueOf(0.42))))->setScale(0, BigDecimal::$ROUND_DOWN);
				if($this->HOCH->compareTo($this->VERGL) == -1) {
					$this->ST = $this->HOCH;
				} else {
					$this->ST = $this->VERGL;
				}
			} else {
			}
		}
	}

	/** Lohnsteuer fuer die Steuerklassen V und VI (§ 39b Abs. 2 Satz 8 EStG)<br>
         PAP Seite 18 */
	protected function UP5_6() {

		$this->X = $this->ZX->multiply(BigDecimal::valueOf(1.25));
		$this->UPTAB05();
		$this->ST1 = $this->ST;
		$this->X = $this->ZX->multiply(BigDecimal::valueOf(0.75));
		$this->UPTAB05();
		$this->ST2 = $this->ST;
		$this->DIFF = ($this->ST1->subtract($this->ST2))->multiply(self::ZAHL2());
		$this->MIST = ($this->ZX->multiply(BigDecimal::valueOf(0.15)))->setScale(0, BigDecimal::$ROUND_DOWN);
		if($this->MIST->compareTo($this->DIFF) == 1) {
			$this->ST = $this->MIST;
		} else {
			$this->ST = $this->DIFF;
		}
	}

	/** Solidaritaetszuschlag<br>
         PAP Seite 19 */
	protected function MSOLZ() {

		$this->SOLZFREI = BigDecimal::valueOf(972 * $this->KZTAB);
		if($this->JBMG->compareTo($this->SOLZFREI) == 1) {
			$this->SOLZJ = ($this->JBMG->multiply(BigDecimal::valueOf(5.5/100)))->setScale(2, BigDecimal::$ROUND_DOWN);
			$this->SOLZMIN = ($this->JBMG->subtract($this->SOLZFREI))->multiply(BigDecimal::valueOf(20.0/100.0));
			if($this->SOLZMIN->compareTo($this->SOLZJ) == -1) {
				$this->SOLZJ = $this->SOLZMIN;
			} else {
			}
			$this->JW = $this->SOLZJ->multiply(self::ZAHL100())->setScale(0, BigDecimal::$ROUND_DOWN);
			$this->UPANTEIL();
			$this->SOLZLZZ = $this->ANTEIL1;
		} else {
			$this->SOLZLZZ = self::ZAHL0();
		}
		if($this->R > 0) {
			$this->JW = $this->JBMG->multiply(self::ZAHL100());
			$this->UPANTEIL();
			$this->BK = $this->ANTEIL1;
		} else {
			$this->BK = self::ZAHL0();
		}
	}

	/** Anteil von Jahresbetraegen fuer einen LZZ (§ 39b Abs. 2 Satz 10 EStG)<br>
         PAP Seite 20 */
	protected function UPANTEIL() {

		if($this->LZZ == 1) {
			$this->ANTEIL1 = $this->JW;
			$this->ANTEIL2 = $this->JW;
		} else {
			if($this->LZZ == 2) {
				$this->ANTEIL1 = $this->JW->divide(self::ZAHL12(), 0, BigDecimal::$ROUND_DOWN);
				$this->ANTEIL2 = $this->JW->divide(self::ZAHL12(), 0, BigDecimal::$ROUND_UP);
			} else {
				if($this->LZZ == 3) {
					$this->ANTEIL1 = ($this->JW->multiply(self::ZAHL7()))->divide(self::ZAHL360(), 0, BigDecimal::$ROUND_DOWN);
					$this->ANTEIL2 = ($this->JW->multiply(self::ZAHL7()))->divide(self::ZAHL360(), 0, BigDecimal::$ROUND_UP);
				} else {
					$this->ANTEIL1 = $this->JW->divide(self::ZAHL360(), 0, BigDecimal::$ROUND_DOWN);
					$this->ANTEIL2 = $this->JW->divide(self::ZAHL360(), 0, BigDecimal::$ROUND_UP);
				}
			}
		}
	}

	/** Berechnung sonstiger Bezuege nach § 39b Abs. 3 Saetze 1 bis 7 EStG)<br>
         PAP Seite 21 */
	protected function MSONST() {

		if($this->SONSTB->compareTo(self::ZAHL0()) == 1) {
			$this->LZZ = 1;
			$this->VBEZ = $this->JVBEZ;
			$this->RE4 = $this->JRE4;
			$this->MRE4LZZ();
			$this->MRE4LZZ2();
			$this->MLSTJAHR();
			$this->LST1 = $this->ST->multiply(self::ZAHL100());
			$this->VBEZ = $this->JVBEZ->add($this->VBS);
			$this->RE4 = $this->JRE4->add($this->SONSTB);
			$this->VBEZS = $this->VBEZS->add($this->STERBE);
			$this->MRE4LZZ();
			$this->MRE4LZZ2();
			$this->MLSTJAHR();
			$this->LST2 = $this->ST->multiply(self::ZAHL100());
			$this->STS = $this->LST2->subtract($this->LST1);
			$this->SOLZS = $this->STS->multiply(BigDecimal::valueOf(5.5))->divide(self::ZAHL100(), 0, BigDecimal::$ROUND_DOWN);
			if($this->R > 0) {
				$this->BKS = $this->STS;
			} else {
				$this->BKS = self::ZAHL0();
			}
		} else {
			$this->STS = self::ZAHL0();
			$this->SOLZS = self::ZAHL0();
			$this->BKS = self::ZAHL0();
		}
	}

	/** Berechnung sonstiger Bezuege nach § 39b Abs. 3 Saetze 1 bis 7 EStG)<br>
         PAP Seite 21 */
	protected function MRE4LZZ2() {

		$this->RE4LZZ = $this->RE4->subtract($this->FVB)->subtract($this->ALTE)->subtract($this->JFREIB)->add($this->JHINZU);
		$this->RE4LZZV = $this->RE4->subtract($this->FVB)->subtract($this->ALTE);
		$this->MRE4();
		$this->MZTABFB();
	}

	/** Berechnung der Verguetung fuer mehrjaehrige Taetigkeit nach § 39b Abs. 3 Satz 9 EStG)<br>
         PAP Seite 22 */
	protected function MVMT() {

		if(($this->VMT->add($this->VKAPA))->compareTo(self::ZAHL0()) == 1) {
			$this->LZZ = 1;
			$this->VBEZ = $this->JVBEZ->add($this->VBS);
			$this->RE4 = $this->JRE4->add($this->SONSTB);
			$this->MRE4LZZ();
			$this->MRE4LZZ2();
			$this->MLSTJAHR();
			$this->LST1 = $this->ST->multiply(self::ZAHL100());
			$this->VMT = $this->VMT->add($this->VKAPA);
			$this->VBEZS = $this->VBEZS->add($this->VKAPA);
			$this->VBEZ = $this->VBEZ->add($this->VKAPA);
			$this->RE4 = $this->JRE4->add($this->SONSTB)->add($this->VMT);
			$this->MRE4LZZ();
			$this->MRE4LZZ2();
			$this->KENNZ = 1;
			$this->ZRE4VP1 = $this->ZRE4VP;
			$this->MLSTJAHR();
			$this->LST3 = $this->ST->multiply(self::ZAHL100());
			$this->VBEZ = $this->VBEZ->subtract($this->VKAPA);
			$this->RE4 = $this->JRE4->add($this->SONSTB);
			$this->MRE4LZZ();
			if(($this->RE4->subtract($this->JFREIB)->add($this->JHINZU))->compareTo(self::ZAHL0()) == -1) {
				$this->RE4 = $this->RE4->subtract($this->JFREIB)->add($this->JHINZU);
				$this->JFREIB = self::ZAHL0();
				$this->JHINZU = self::ZAHL0();
				$this->RE4 = ($this->RE4->add($this->VMT))->divide(self::ZAHL5(), 0, BigDecimal::$ROUND_DOWN);
				$this->MRE4LZZ2();
				$this->MLSTJAHR();
				$this->LST2 = $this->ST->multiply(self::ZAHL100());
				$this->STV = $this->LST2->multiply(self::ZAHL5());
			} else {
				$this->RE4 = $this->RE4->add($this->VMT->divide(self::ZAHL5(), 0, BigDecimal::$ROUND_DOWN));
				$this->MRE4LZZ2();
				$this->MLSTJAHR();
				$this->LST2 = $this->ST->multiply(self::ZAHL100());
				$this->STV = ($this->LST2->subtract($this->LST1))->multiply(self::ZAHL5());
			}
			$this->LST3 = $this->LST3->subtract($this->LST1);
			if($this->LST3->compareTo($this->STV) == -1) {
				$this->STV = $this->LST3;
			} else {
			}
			$this->SOLZV = ($this->STV->multiply(BigDecimal::valueOf(5.5)))->divide(self::ZAHL100(), 0, BigDecimal::$ROUND_DOWN);
			if($this->R > 0) {
				$this->BKV = $this->STV;
			} else {
				$this->BKV = self::ZAHL0();
			}
		} else {
			$this->STV = self::ZAHL0();
			$this->SOLZV = self::ZAHL0();
			$this->BKV = self::ZAHL0();
		}
	}

	/** Berechnung der Verguetung fuer mehrjaehrige Taetigkeit nach § 39b Abs. 3 Satz 9 EStG)<br>
         PAP Seite 23 */
	protected function UPTAB05() {

		if($this->X->compareTo(BigDecimal::valueOf(7665)) == -1) {
			$this->ST = self::ZAHL0();
		} else {
			if($this->X->compareTo(BigDecimal::valueOf(12740)) == -1) {
				$this->Y = ($this->X->subtract(BigDecimal::valueOf(7664)))->divide(BigDecimal::valueOf(10000), 6, BigDecimal::$ROUND_DOWN);
				$this->RW = $this->Y->multiply(BigDecimal::valueOf(883.74));
				$this->RW = $this->RW->add(BigDecimal::valueOf(1500));
				$this->ST = ($this->RW->multiply($this->Y))->setScale(0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->X->compareTo(BigDecimal::valueOf(52152)) == -1) {
					$this->Y = ($this->X->subtract(BigDecimal::valueOf(12739)))->divide(BigDecimal::valueOf(10000), 6, BigDecimal::$ROUND_DOWN);
					$this->RW = $this->Y->multiply(BigDecimal::valueOf(228.74));
					$this->RW = $this->RW->add(BigDecimal::valueOf(2397));
					$this->RW = $this->RW->multiply($this->Y);
					$this->ST = ($this->RW->add(BigDecimal::valueOf(989)))->setScale(0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ST = (($this->X->multiply(BigDecimal::valueOf(0.42)))->subtract(BigDecimal::valueOf(7914)))->setScale(0, BigDecimal::$ROUND_DOWN);
				}
			}
		}
		$this->ST = $this->ST->multiply(BigDecimal::valueOf($this->KZTAB));
	}

}