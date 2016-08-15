<?php

namespace Services;

/**
 * Klasse Lohnsteuer2008
 * 
 * @author Christian Delfs
 */

class Lohnsteuer2008 implements LohnsteuerInterface {

	/** Stand: 2015-11-16 */
	/** ZIVIT D�sseldorf */

	/* EINGABEPARAMETER*/

	protected $AJAHR;
	protected $ALTER1;
	protected $JFREIB;
	protected $JHINZU;
	protected $JRE4;
	protected $JVBEZ;
	protected $KRV;
	protected $LZZ;
	protected $LZZFREIB;
	protected $LZZHINZU;
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

	/** Altersentlastungsbetrag nach Alterseinkünftegesetz in €,<br>
             Cent (2 Dezimalstellen) */
	protected $ALTE;

	/** Arbeitnehmer-Pauschbetrag in EURO */
	protected $ANP;

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents abgerundet */
	protected $ANTEIL1;

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents aufgerundet */
	protected $ANTEIL2;

	/** Bemessungsgrundlage für Altersentlastungsbetrag in €, Cent<br>
             (2 Dezimalstellen) */
	protected $BMG;

	/** Differenz zwischen ST1 und ST2 in EURO */
	protected $DIFF;

	/** Entlastungsbetrag fuer Alleinerziehende in EURO */
	protected $EFA;

	/** Versorgungsfreibetrag in €, Cent (2 Dezimalstellen) */
	protected $FVB;

	/** Versorgungsfreibetrag in €, Cent (2 Dezimalstellen) für die Berechnung<br>
             der Lohnsteuer für den sonstigen Bezug */
	protected $FVBSO;

	/** Zuschlag zum Versorgungsfreibetrag in EURO */
	protected $FVBZ;

	/** Zuschlag zum Versorgungsfreibetrag in EURO fuer die Berechnung<br>
             der Lohnsteuer beim sonstigen Bezug */
	protected $FVBZSO;

	/** Sicherungsfeld für den Zuschlag zum Versorgungsfreibetrag in € für<br>
             die Berechnung der Lohnsteuer für die Vergütung für mehrjährige<br>
             Tätigkeit */
	protected $FVBZOSO;

	/** Maximaler Altersentlastungsbetrag in € */
	protected $HBALTE;

	/** Maßgeblicher maximaler Versorgungsfreibetrag in € */
	protected $HFVB;

	/** Maßgeblicher maximaler Zuschlag zum Versorgungsfreibetrag in €,Cent<br>
             (2 Dezimalstellen) */
	protected $HFVBZ;

	/** Maßgeblicher maximaler Zuschlag zum Versorgungsfreibetrag in €, Cent<br>
             (2 Dezimalstellen) für die Berechnung der Lohnsteuer für den<br>
             sonstigen Bezug */
	protected $HFVBZSO;

	/** Nummer der Tabellenwerte fuer Versorgungsparameter */
	protected $J;

	/** Jahressteuer nach § 51a EStG, aus der Solidaritaetszuschlag und<br>
             Bemessungsgrundlage fuer die Kirchenlohnsteuer ermittelt werden in EURO */
	protected $JBMG;

	/** Auf einen Jahreslohn hochgerechneter LZZFREIB in €, Cent<br>
             (2 Dezimalstellen) */
	protected $JLFREIB;

	/** Auf einen Jahreslohn hochgerechnete LZZHINZU in €, Cent<br>
             (2 Dezimalstellen) */
	protected $JLHINZU;

	/** Jahreswert, dessen Anteil fuer einen Lohnzahlungszeitraum in<br>
             UPANTEIL errechnet werden soll in Cents */
	protected $JW;

	/** Nummer der Tabellenwerte fuer Parameter bei Altersentlastungsbetrag */
	protected $K;

	/** Merker für Berechnung Lohnsteuer für mehrjährige Tätigkeit.<br>
             0 = normale Steuerberechnung<br>
             1 = Steuerberechnung für mehrjährige Tätigkeit<br>
             2 = Steuerberechnung für mehrjährige Tätigkeit Sonderfall nach § 34 Abs. 1 Satz 3 EStG */
	protected $KENNVMT;

	/** Summe der Freibetraege fuer Kinder in EURO */
	protected $KFB;

	/** Kennzahl fuer die Einkommensteuer-Tabellenart:<br>
             1 = Grundtabelle<br>
             2 = Splittingtabelle */
	protected $KZTAB;

	/** Jahreslohnsteuer in EURO */
	protected $LSTJAHR;

	/** Zwischenfelder der Jahreslohnsteuer in Cent */
	protected $LST1;
	protected $LST2;
	protected $LST3;
	protected $LSTOSO;
	protected $LSTSO;

	/** Mindeststeuer fuer die Steuerklassen V und VI in EURO */
	protected $MIST;

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

	/** Bemessungsgrundlage für den Versorgungsfreibetrag in Cent für<br>
             den sonstigen Bezug */
	protected $VBEZBSO;

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

	/** Zu versteuerndes Einkommen gem. § 32a Abs. 1 und 2 EStG €, C<br>
             (2 Dezimalstellen) */
	protected $X;

	/** gem. § 32a Abs. 1 EStG (6 Dezimalstellen) */
	protected $Y;

	/** Auf einen Jahreslohn hochgerechnetes RE4 in €, C (2 Dezimalstellen)<br>
             nach Abzug der Freibeträge nach § 39 b Abs. 2 Satz 3 und 4. */
	protected $ZRE4;

	/** Auf einen Jahreslohn hochgerechnetes RE4 in €, C (2 Dezimalstellen) */
	protected $ZRE4J;

	/** Sicherungsfeld von ZRE4 bei der Berechnung der Lohnsteuer für<br>
             die Vergütung für mehrjährige Tätigkeit in €, C (2 Dezimalstellen) */
	protected $ZRE4OSO;

	/** 1/5 des mehrjähriger Bezugs abzüglich der auf diesen Lohnbestandteil<br>
             entfallenden festen Tabellenfreibeträge in €, C (2 Dezimalstellen) */
	protected $ZRE4VMT;

	/** Auf einen Jahreslohn hochgerechnetes RE4 in €, C (2 Dezimalstellen)<br>
             nach Abzug des Versorgungsfreibetrags und des Alterentlastungsbetrags<br>
             zur Berechnung der Vorsorgepauschale in €, Cent (2 Dezimalstellen) */
	protected $ZRE4VP;

	/** Feste Tabellenfreibeträge (ohne Vorsorgepauschale) in €, Cent<br>
             (2 Dezimalstellen) */
	protected $ZTABFB;

	/** Sicherungsfeld von ZTABFB bei der Berechnung für die Vergütung<br>
             für mehrjährige Tätigkeit in €, Cent (2 Dezimalstellen) */
	protected $ZTABFBOSO;

	/** Auf einen Jahreslohn hochgerechnetes (VBEZ abzueglich FVB) in<br>
             EURO, C (2 Dezimalstellen) */
	protected $ZVBEZ;

	/** Auf einen Jahreslohn hochgerechnetes VBEZ in €, C (2 Dezimalstellen) */
	protected $ZVBEZJ;

	/** Zu versteuerndes Einkommen in €, C (2 Dezimalstellen) */
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
	protected static $ZAHL700;

	/* SETTER */

	
	public function setRE4($arg0) { $this->RE4 = $arg0; }

	
	public function setJHINZU($arg0) { $this->JHINZU = $arg0; }

	
	public function setVKAPA($arg0) { $this->VKAPA = $arg0; }

	
	public function setSTKL($arg0) { $this->STKL = $arg0; }

	
	public function setVBS($arg0) { $this->VBS = $arg0; }

	
	public function setVBEZS($arg0) { $this->VBEZS = $arg0; }

	
	public function setVBEZ($arg0) { $this->VBEZ = $arg0; }

	
	public function setVJAHR($arg0) { $this->VJAHR = $arg0; }

	
	public function setLZZHINZU($arg0) { $this->LZZHINZU = $arg0; }

	
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

	
	public function setLZZFREIB($arg0) { $this->LZZFREIB = $arg0; }

	
	public function setALTER1($arg0) { $this->ALTER1 = $arg0; }

	
	public function setVMT($arg0) { $this->VMT = $arg0; }

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

	
	public function getZVBEZJ() { return $this->ZVBEZJ; }

	
	public function getKENNVMT() { return $this->KENNVMT; }

	
	public function getLST3() { return $this->LST3; }

	
	public function getZTABFB() { return $this->ZTABFB; }

	
	public function getLST2() { return $this->LST2; }

	
	public function getLST1() { return $this->LST1; }

	
	public function getZRE4OSO() { return $this->ZRE4OSO; }

	
	public function getZVE() { return $this->ZVE; }

	
	public function getFVBZ() { return $this->FVBZ; }

	
	public function getSOLZFREI() { return $this->SOLZFREI; }

	
	public function getHFVB() { return $this->HFVB; }

	
	public function getHOCH() { return $this->HOCH; }

	
	public function getLSTJAHR() { return $this->LSTJAHR; }

	
	public function getZRE4VMT() { return $this->ZRE4VMT; }

	
	public function getSOLZJ() { return $this->SOLZJ; }

	
	public function getZZX() { return $this->ZZX; }

	
	public function getLSTSO() { return $this->LSTSO; }

	
	public function getANTEIL2() { return $this->ANTEIL2; }

	
	public function getANTEIL1() { return $this->ANTEIL1; }

	
	public function getVSPMAX2() { return $this->VSPMAX2; }

	
	public function getDIFF() { return $this->DIFF; }

	
	public function getVSPMAX1() { return $this->VSPMAX1; }

	
	public function getZVBEZ() { return $this->ZVBEZ; }

	
	public function getJLHINZU() { return $this->JLHINZU; }

	
	public function getVSP() { return $this->VSP; }

	
	public function getZTABFBOSO() { return $this->ZTABFBOSO; }

	
	public function getZX() { return $this->ZX; }

	
	public function getEFA() { return $this->EFA; }

	
	public function getALTE() { return $this->ALTE; }

	
	public function getFVBZOSO() { return $this->FVBZOSO; }

	
	public function getANP() { return $this->ANP; }

	
	public function getHFVBZSO() { return $this->HFVBZSO; }

	
	public function getSAP() { return $this->SAP; }

	
	public function getRW() { return $this->RW; }

	
	public function getSOLZMIN() { return $this->SOLZMIN; }

	
	public function getKFB() { return $this->KFB; }

	
	public function getFVBZSO() { return $this->FVBZSO; }

	
	public function getJ() { return $this->J; }

	
	public function getHBALTE() { return $this->HBALTE; }

	
	public function getK() { return $this->K; }

	
	public function getFVBSO() { return $this->FVBSO; }

	
	public function getJW() { return $this->JW; }

	
	public function getVHB() { return $this->VHB; }

	
	public function getVSPN() { return $this->VSPN; }

	
	public function getVSPO() { return $this->VSPO; }

	
	public function getX() { return $this->X; }

	
	public function getMIST() { return $this->MIST; }

	
	public function getY() { return $this->Y; }

	
	public function getVBEZB() { return $this->VBEZB; }

	
	public function getBMG() { return $this->BMG; }

	
	public function getVSPVOR() { return $this->VSPVOR; }

	
	public function getST() { return $this->ST; }

	
	public function getVSPKURZ() { return $this->VSPKURZ; }

	
	public function getHFVBZ() { return $this->HFVBZ; }

	
	public function getKZTAB() { return $this->KZTAB; }

	
	public function getZRE4() { return $this->ZRE4; }

	
	public function getJLFREIB() { return $this->JLFREIB; }

	
	public function getJBMG() { return $this->JBMG; }

	
	public function getST2() { return $this->ST2; }

	
	public function getST1() { return $this->ST1; }

	
	public function getFVB() { return $this->FVB; }

	
	public function getVBEZBSO() { return $this->VBEZBSO; }

	
	public function getVERGL() { return $this->VERGL; }

	
	public function getVSP1() { return $this->VSP1; }

	
	public function getZRE4VP() { return $this->ZRE4VP; }

	
	public function getLSTOSO() { return $this->LSTOSO; }

	
	public function getVSP2() { return $this->VSP2; }

	
	public function getZRE4J() { return $this->ZRE4J; }

	function __construct() {
	$this->VSPREST=new BigDecimal(0);
	$this->JHINZU=new BigDecimal(0);
	$this->KENNVMT=0;
	$this->LST3=new BigDecimal(0);
	$this->LST2=new BigDecimal(0);
	$this->LST1=new BigDecimal(0);
	$this->ZRE4OSO=new BigDecimal(0);
	$this->VJAHR=0;
	$this->FVBZ=new BigDecimal(0);
	$this->HFVB=new BigDecimal(0);
	$this->LSTJAHR=new BigDecimal(0);
	$this->STS=new BigDecimal(0);
	$this->STV=new BigDecimal(0);
	$this->SOLZJ=new BigDecimal(0);
	$this->ZZX=new BigDecimal(0);
	$this->SOLZV=new BigDecimal(0);
	$this->ANTEIL2=new BigDecimal(0);
	$this->SOLZS=new BigDecimal(0);
	$this->ANTEIL1=new BigDecimal(0);
	$this->DIFF=new BigDecimal(0);
	$this->VBS=new BigDecimal(0);
	$this->LZZHINZU=new BigDecimal(0);
	$this->BKS=new BigDecimal(0);
	$this->BKV=new BigDecimal(0);
	$this->JLHINZU=new BigDecimal(0);
	$this->VSP=new BigDecimal(0);
	$this->ZKF=new BigDecimal(0);
	$this->ZMVB=0;
	$this->ZX=new BigDecimal(0);
	$this->FVBZOSO=new BigDecimal(0);
	$this->RW=new BigDecimal(0);
	$this->KFB=new BigDecimal(0);
	$this->VBEZ=new BigDecimal(0);
	$this->BK=new BigDecimal(0);
	$this->J=0;
	$this->HBALTE=new BigDecimal(0);
	$this->K=0;
	$this->FVBSO=new BigDecimal(0);
	$this->JW=new BigDecimal(0);
	$this->R=0;
	$this->VSPN=new BigDecimal(0);
	$this->VSPO=new BigDecimal(0);
	$this->X=new BigDecimal(0);
	$this->Y=new BigDecimal(0);
	$this->BMG=new BigDecimal(0);
	$this->RE4=new BigDecimal(0);
	$this->ST=new BigDecimal(0);
	$this->VSPKURZ=new BigDecimal(0);
	$this->HFVBZ=new BigDecimal(0);
	$this->SONSTB=new BigDecimal(0);
	$this->FVB=new BigDecimal(0);
	$this->VERGL=new BigDecimal(0);
	$this->VSP1=new BigDecimal(0);
	$this->LSTOSO=new BigDecimal(0);
	$this->VSP2=new BigDecimal(0);
	$this->ZRE4J=new BigDecimal(0);
	$this->VMT=new BigDecimal(0);
	$this->ZVBEZJ=new BigDecimal(0);
	$this->ZTABFB=new BigDecimal(0);
	$this->ZVE=new BigDecimal(0);
	$this->SOLZFREI=new BigDecimal(0);
	$this->LZZ=0;
	$this->HOCH=new BigDecimal(0);
	$this->JFREIB=new BigDecimal(0);
	$this->JVBEZ=new BigDecimal(0);
	$this->ZRE4VMT=new BigDecimal(0);
	$this->LZZFREIB=new BigDecimal(0);
	$this->LSTSO=new BigDecimal(0);
	$this->STKL=0;
	$this->VSPMAX2=new BigDecimal(0);
	$this->VSPMAX1=new BigDecimal(0);
	$this->ZVBEZ=new BigDecimal(0);
	$this->SOLZLZZ=new BigDecimal(0);
	$this->ZTABFBOSO=new BigDecimal(0);
	$this->ALTER1=0;
	$this->EFA=new BigDecimal(0);
	$this->ALTE=new BigDecimal(0);
	$this->VKAPA=new BigDecimal(0);
	$this->ANP=new BigDecimal(0);
	$this->HFVBZSO=new BigDecimal(0);
	$this->SAP=new BigDecimal(0);
	$this->SOLZMIN=new BigDecimal(0);
	$this->VBEZS=new BigDecimal(0);
	$this->FVBZSO=new BigDecimal(0);
	$this->KRV=0;
	$this->VHB=new BigDecimal(0);
	$this->VBEZM=new BigDecimal(0);
	$this->LSTLZZ=new BigDecimal(0);
	$this->MIST=new BigDecimal(0);
	$this->VBEZB=new BigDecimal(0);
	$this->VSPVOR=new BigDecimal(0);
	$this->KZTAB=0;
	$this->ZRE4=new BigDecimal(0);
	$this->JLFREIB=new BigDecimal(0);
	$this->JBMG=new BigDecimal(0);
	$this->ST2=new BigDecimal(0);
	$this->ST1=new BigDecimal(0);
	$this->STERBE=new BigDecimal(0);
	$this->VBEZBSO=new BigDecimal(0);
	$this->AJAHR=0;
	$this->JRE4=new BigDecimal(0);
	$this->ZRE4VP=new BigDecimal(0);
	self::$ZAHL11=new BigDecimal(11);
	self::$ZAHL10=BigDecimal::$TEN;
	self::$ZAHL12=new BigDecimal(12);
	self::$TAB5=array(BigDecimal::valueOf (0), BigDecimal::valueOf (1900), BigDecimal::valueOf (1824), BigDecimal::valueOf (1748), BigDecimal::valueOf (1672), BigDecimal::valueOf (1596), BigDecimal::valueOf (1520), BigDecimal::valueOf (1444), BigDecimal::valueOf (1368), BigDecimal::valueOf (1292), BigDecimal::valueOf (1216), BigDecimal::valueOf (1140), BigDecimal::valueOf (1064), BigDecimal::valueOf (988), BigDecimal::valueOf (912), BigDecimal::valueOf (836), BigDecimal::valueOf (760), BigDecimal::valueOf (722), BigDecimal::valueOf (684), BigDecimal::valueOf (646), BigDecimal::valueOf (608), BigDecimal::valueOf (570), BigDecimal::valueOf (532), BigDecimal::valueOf (494), BigDecimal::valueOf (456), BigDecimal::valueOf (418), BigDecimal::valueOf (380), BigDecimal::valueOf (342), BigDecimal::valueOf (304), BigDecimal::valueOf (266), BigDecimal::valueOf (228), BigDecimal::valueOf (190), BigDecimal::valueOf (152), BigDecimal::valueOf (114), BigDecimal::valueOf (76), BigDecimal::valueOf (38), BigDecimal::valueOf (0));
	self::$ZAHL100=new BigDecimal(100);
	self::$ZAHL1=BigDecimal::$ONE;
	self::$ZAHL2=new BigDecimal(2);
	self::$ZAHL360=new BigDecimal(360);
	self::$TAB4=array(BigDecimal::valueOf (0.0), BigDecimal::valueOf (0.4), BigDecimal::valueOf (0.384), BigDecimal::valueOf (0.368), BigDecimal::valueOf (0.352), BigDecimal::valueOf (0.336), BigDecimal::valueOf (0.32), BigDecimal::valueOf (0.304), BigDecimal::valueOf (0.288), BigDecimal::valueOf (0.272), BigDecimal::valueOf (0.256), BigDecimal::valueOf (0.24), BigDecimal::valueOf (0.224), BigDecimal::valueOf (0.208), BigDecimal::valueOf (0.192), BigDecimal::valueOf (0.176), BigDecimal::valueOf (0.16), BigDecimal::valueOf (0.152), BigDecimal::valueOf (0.144), BigDecimal::valueOf (0.136), BigDecimal::valueOf (0.128), BigDecimal::valueOf (0.12), BigDecimal::valueOf (0.112), BigDecimal::valueOf (0.104), BigDecimal::valueOf (0.096), BigDecimal::valueOf (0.088), BigDecimal::valueOf (0.08), BigDecimal::valueOf (0.072), BigDecimal::valueOf (0.064), BigDecimal::valueOf (0.056), BigDecimal::valueOf (0.048), BigDecimal::valueOf (0.04), BigDecimal::valueOf (0.032), BigDecimal::valueOf (0.024), BigDecimal::valueOf (0.016), BigDecimal::valueOf (0.008), BigDecimal::valueOf (0.0));
	self::$ZAHL5=new BigDecimal(5);
	self::$TAB3=array(BigDecimal::valueOf (0), BigDecimal::valueOf (900), BigDecimal::valueOf (864), BigDecimal::valueOf (828), BigDecimal::valueOf (792), BigDecimal::valueOf (756), BigDecimal::valueOf (720), BigDecimal::valueOf (684), BigDecimal::valueOf (648), BigDecimal::valueOf (612), BigDecimal::valueOf (576), BigDecimal::valueOf (540), BigDecimal::valueOf (504), BigDecimal::valueOf (468), BigDecimal::valueOf (432), BigDecimal::valueOf (396), BigDecimal::valueOf (360), BigDecimal::valueOf (342), BigDecimal::valueOf (324), BigDecimal::valueOf (306), BigDecimal::valueOf (288), BigDecimal::valueOf (270), BigDecimal::valueOf (252), BigDecimal::valueOf (234), BigDecimal::valueOf (216), BigDecimal::valueOf (198), BigDecimal::valueOf (180), BigDecimal::valueOf (162), BigDecimal::valueOf (144), BigDecimal::valueOf (126), BigDecimal::valueOf (108), BigDecimal::valueOf (90), BigDecimal::valueOf (72), BigDecimal::valueOf (54), BigDecimal::valueOf (36), BigDecimal::valueOf (18), BigDecimal::valueOf (0));
	self::$ZAHL6=new BigDecimal(6);
	self::$ZAHL700=new BigDecimal(700);
	self::$TAB2=array(BigDecimal::valueOf (0), BigDecimal::valueOf (3000), BigDecimal::valueOf (2880), BigDecimal::valueOf (2760), BigDecimal::valueOf (2640), BigDecimal::valueOf (2520), BigDecimal::valueOf (2400), BigDecimal::valueOf (2280), BigDecimal::valueOf (2160), BigDecimal::valueOf (2040), BigDecimal::valueOf (1920), BigDecimal::valueOf (1800), BigDecimal::valueOf (1680), BigDecimal::valueOf (1560), BigDecimal::valueOf (1440), BigDecimal::valueOf (1320), BigDecimal::valueOf (1200), BigDecimal::valueOf (1140), BigDecimal::valueOf (1080), BigDecimal::valueOf (1020), BigDecimal::valueOf (960), BigDecimal::valueOf (900), BigDecimal::valueOf (840), BigDecimal::valueOf (780), BigDecimal::valueOf (720), BigDecimal::valueOf (660), BigDecimal::valueOf (600), BigDecimal::valueOf (540), BigDecimal::valueOf (480), BigDecimal::valueOf (420), BigDecimal::valueOf (360), BigDecimal::valueOf (300), BigDecimal::valueOf (240), BigDecimal::valueOf (180), BigDecimal::valueOf (120), BigDecimal::valueOf (60), BigDecimal::valueOf (0));
	self::$ZAHL3=new BigDecimal(3);
	self::$TAB1=array(BigDecimal::valueOf (0.0), BigDecimal::valueOf (0.4), BigDecimal::valueOf (0.384), BigDecimal::valueOf (0.368), BigDecimal::valueOf (0.352), BigDecimal::valueOf (0.336), BigDecimal::valueOf (0.32), BigDecimal::valueOf (0.304), BigDecimal::valueOf (0.288), BigDecimal::valueOf (0.272), BigDecimal::valueOf (0.256), BigDecimal::valueOf (0.24), BigDecimal::valueOf (0.224), BigDecimal::valueOf (0.208), BigDecimal::valueOf (0.192), BigDecimal::valueOf (0.176), BigDecimal::valueOf (0.16), BigDecimal::valueOf (0.152), BigDecimal::valueOf (0.144), BigDecimal::valueOf (0.136), BigDecimal::valueOf (0.128), BigDecimal::valueOf (0.12), BigDecimal::valueOf (0.112), BigDecimal::valueOf (0.104), BigDecimal::valueOf (0.096), BigDecimal::valueOf (0.088), BigDecimal::valueOf (0.08), BigDecimal::valueOf (0.072), BigDecimal::valueOf (0.064), BigDecimal::valueOf (0.056), BigDecimal::valueOf (0.048), BigDecimal::valueOf (0.04), BigDecimal::valueOf (0.032), BigDecimal::valueOf (0.024), BigDecimal::valueOf (0.016), BigDecimal::valueOf (0.008), BigDecimal::valueOf (0.0));
	self::$ZAHL4=new BigDecimal(4);
	self::$ZAHL9=new BigDecimal(9);
	self::$ZAHL7=new BigDecimal(7);
	self::$ZAHL8=new BigDecimal(8);
	}
	/** PROGRAMMABLAUFPLAN 2008, PAP Seite 10 */
	
	public function main() {

		$this->MRE4JL();
		$this->MRE4();
		$this->MRE4ABZ();
		$this->MZTABFB();
		$this->KENNVMT= 0;
		$this->MLSTJAHR();
		$this->LSTJAHR= $this->ST;
		$this->JW= $this->LSTJAHR->multiply (self::ZAHL100());
		$this->UPANTEIL();
		$this->LSTLZZ= $this->ANTEIL1;
		if($this->ZKF->compareTo (BigDecimal::$ZERO) == 1) {
			$this->ZTABFB= ($this->ZTABFB->add ($this->KFB))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->MLSTJAHR();
			$this->JBMG= $this->ST;
		} else {
			$this->JBMG= $this->LSTJAHR;
		}
		$this->MSOLZ();
		$this->MSONST();
		$this->MVMT();
	}

	/** Ermittlung des Jahresarbeitslohns und der Freibeträge § 39 b Abs. 2 Satz 2 EStG, PAP Seite 11 */
	protected function MRE4JL() {

		if($this->LZZ == 1) {
			$this->ZRE4J= $this->RE4->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZJ= $this->VBEZ->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
			$this->JLFREIB= $this->LZZFREIB->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
			$this->JLHINZU= $this->LZZHINZU->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->LZZ == 2) {
				$this->ZRE4J= ($this->RE4->multiply (self::ZAHL12()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
				$this->ZVBEZJ= ($this->VBEZ->multiply (self::ZAHL12()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
				$this->JLFREIB= ($this->LZZFREIB->multiply (self::ZAHL12()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
				$this->JLHINZU= ($this->LZZHINZU->multiply (self::ZAHL12()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->LZZ == 3) {
					$this->ZRE4J= ($this->RE4->multiply (self::ZAHL360()))->divide (self::ZAHL700(), 2, BigDecimal::$ROUND_DOWN);
					$this->ZVBEZJ= ($this->VBEZ->multiply (self::ZAHL360()))->divide (self::ZAHL700(), 2, BigDecimal::$ROUND_DOWN);
					$this->JLFREIB= ($this->LZZFREIB->multiply (self::ZAHL360()))->divide (self::ZAHL700(), 2, BigDecimal::$ROUND_DOWN);
					$this->JLHINZU= ($this->LZZHINZU->multiply (self::ZAHL360()))->divide (self::ZAHL700(), 2, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ZRE4J= ($this->RE4->multiply (self::ZAHL360()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
					$this->ZVBEZJ= ($this->VBEZ->multiply (self::ZAHL360()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
					$this->JLFREIB= ($this->LZZFREIB->multiply (self::ZAHL360()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
					$this->JLHINZU= ($this->LZZHINZU->multiply (self::ZAHL360()))->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
				}
			}
		}
	}

	/** Freibeträge für Versorgungsbezüge, Altersentlastungsbetrag (§ 39b Abs. 2 Satz 3 EStG), PAP Seite 12 */
	protected function MRE4() {

		if($this->ZVBEZJ->compareTo (BigDecimal::$ZERO) == 0) {
			$this->FVBZ= BigDecimal::$ZERO;
			$this->FVB= BigDecimal::$ZERO;
			$this->FVBZSO= BigDecimal::$ZERO;
			$this->FVBSO= BigDecimal::$ZERO;
		} else {
			if($this->VJAHR < 2006) {
				$this->J= 1;
			} else {
				if($this->VJAHR < 2040) {
					$this->J= $this->VJAHR - 2004;
				} else {
					$this->J= 36;
				}
			}
			if($this->LZZ == 1) {
				$this->VBEZB= ($this->VBEZM->multiply (BigDecimal::valueOf ($this->ZMVB)))->add ($this->VBEZS);/** Achtung! Rechengenauigkeit Division? */
				$this->HFVB= self::TAB2()[$this->J]->divide (self::ZAHL12())->multiply (BigDecimal::valueOf ($this->ZMVB));
				$this->FVBZ= self::TAB3()[$this->J]->divide (self::ZAHL12())->multiply (BigDecimal::valueOf ($this->ZMVB))->setScale (0, BigDecimal::$ROUND_UP);
			} else {
				$this->VBEZB= (($this->VBEZM->multiply (self::ZAHL12()))->add ($this->VBEZS))->setScale (2, BigDecimal::$ROUND_DOWN);
				$this->HFVB= self::TAB2()[$this->J];
				$this->FVBZ= self::TAB3()[$this->J];
			}
			$this->FVB= (($this->VBEZB->multiply (self::TAB1()[$this->J])))->divide (self::ZAHL100())->setScale (2, BigDecimal::$ROUND_UP);
			if($this->FVB->compareTo ($this->HFVB) == 1) {
				$this->FVB = $this->HFVB;
			}
			$this->VBEZBSO= $this->STERBE->add ($this->VKAPA);
			$this->FVBSO= ($this->FVB->add(($this->VBEZBSO->multiply (self::TAB1()[$this->J]))->divide (self::ZAHL100())))->setScale (2, BigDecimal::$ROUND_UP);
			if($this->FVBSO->compareTo (self::TAB2()[$this->J]) == 1) {
				$this->FVBSO = self::TAB2()[$this->J];
			}
			$this->HFVBZSO= ((($this->VBEZB->add($this->VBEZBSO))->divide (self::ZAHL100()))->subtract ($this->FVBSO))->setScale (2, BigDecimal::$ROUND_DOWN);
			if((self::TAB3()[3])->compareTo ($this->HFVBZSO) == 1) {
				$this->FVBZSO = $this->HFVBZSO->setScale(0, BigDecimal::$ROUND_UP);
			} else {
				$this->FVBZSO= self::TAB3()[$this->J];
			}
			$this->HFVBZ= (($this->VBEZB->divide (self::ZAHL100()))->subtract ($this->FVB))->setScale (2, BigDecimal::$ROUND_DOWN);
			if($this->FVBZ->compareTo ($this->HFVBZ) == 1) {
				$this->FVBZ = $this->HFVBZ->setScale (0, BigDecimal::$ROUND_UP);
			}
		}
		$this->MRE4ALTE();
	}

	/** Altersentlastungsbetrag (§ 39b Abs. 2 Satz 3 EStG), PAP Seite 13 */
	protected function MRE4ALTE() {

		if($this->ALTER1 == 0) {
			$this->ALTE= BigDecimal::$ZERO;
		} else {
			if($this->AJAHR < 2006) {
				$this->K= 1;
			} else {
				if($this->AJAHR < 2040) {
					$this->K= $this->AJAHR - 2004;
				} else {
					$this->K= 36;
				}
			}
			$this->BMG= $this->ZRE4J->subtract ($this->ZVBEZJ);
			$this->ALTE= ($this->BMG->multiply (self::TAB4()[$this->K]))->setScale (2, BigDecimal::$ROUND_UP);
			$this->HBALTE= self::TAB5()[$this->K];
			if($this->ALTE->compareTo ($this->HBALTE) == 1) {
				$this->ALTE= $this->HBALTE;
			}
		}
	}

	/** Ermittlung des Jahresarbeitslohns nach Abzug der Freibeträge nach § 39 b Abs. 2 Satz 3 und 4 EStG, PAP Seite 15 */
	protected function MRE4ABZ() {

		$this->ZRE4= ($this->ZRE4J->subtract ($this->FVB)->subtract ($this->ALTE)->subtract ($this->JLFREIB)->add ($this->JLHINZU))->setScale (2, BigDecimal::$ROUND_DOWN);
		if($this->ZRE4->compareTo (BigDecimal::$ZERO) == -1) {
			$this->ZRE4= BigDecimal::$ZERO;
		}
		$this->ZRE4VP= ($this->ZRE4J->subtract ($this->FVB)->subtract ($this->ALTE))->setScale (2, BigDecimal::$ROUND_DOWN);
		if($this->ZRE4VP->compareTo (BigDecimal::$ZERO) == -1) {
			$this->ZRE4VP= BigDecimal::$ZERO;
		}
		$this->ZVBEZ= ($this->ZVBEZJ->subtract ($this->FVB))->setScale (2, BigDecimal::$ROUND_DOWN);
		if($this->ZVBEZ->compareTo (BigDecimal::$ZERO) == -1) {
			$this->ZVBEZ= BigDecimal::$ZERO;
		}
	}

	/** Ermittlung der festen Tabellenfreibeträge (ohne Vorsorgepauschale), PAP Seite 16 */
	protected function MZTABFB() {

		$this->ANP= BigDecimal::$ZERO;
		if($this->ZVBEZ->compareTo (BigDecimal::$ZERO) >= 0) {
			if($this->ZVBEZ->compareTo ($this->FVBZ) == -1) {
				$this->FVBZ= $this->ZVBEZ->setScale (0, BigDecimal::$ROUND_DOWN);
			}
		}
		if($this->STKL < 6) {
			if($this->ZVBEZ->compareTo (BigDecimal::$ZERO) == 1) {
				if(($this->ZVBEZ->subtract ($this->FVBZ))->compareTo (BigDecimal::valueOf (102)) == -1) {
					$this->ANP= ($this->ZVBEZ->subtract ($this->FVBZ))->setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ANP= BigDecimal::valueOf (102);
				}
			}
		} else {
			$this->FVBZ= BigDecimal::valueOf (0);
			$this->FVBZSO= BigDecimal::valueOf (0);
		}
		if($this->STKL < 6) {
			if($this->ZRE4->compareTo ($this->ZVBEZ) == 1) {
				if(($this->ZRE4->subtract ($this->ZVBEZ))->compareTo (BigDecimal::valueOf (920)) == -1) {
					$this->ANP= ($this->ANP->add ($this->ZRE4)->subtract ($this->ZVBEZ))->setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ANP= $this->ANP->add (BigDecimal::valueOf (920));
				}
			}
		}
		$this->KZTAB= 1;
		if($this->STKL == 1) {
			$this->SAP= BigDecimal::valueOf (36);
			$this->KFB= ($this->ZKF->multiply (BigDecimal::valueOf (5808)))->setScale (0, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->STKL == 2) {
				$this->EFA= BigDecimal::valueOf (1308);
				$this->SAP= BigDecimal::valueOf (36);
				$this->KFB= ($this->ZKF->multiply (BigDecimal::valueOf (5808)))->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->STKL == 3) {
					$this->KZTAB= 2;
					$this->SAP= BigDecimal::valueOf (72);
					$this->KFB= ($this->ZKF->multiply (BigDecimal::valueOf (5808)))->setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					if($this->STKL == 4) {
						$this->SAP= BigDecimal::valueOf (36);
						$this->KFB= ($this->ZKF->multiply (BigDecimal::valueOf (2904)))->setScale (0, BigDecimal::$ROUND_DOWN);
					} else {
						$this->KFB= BigDecimal::$ZERO;
					}
				}
			}
		}
		$this->ZTABFB= ($this->EFA->add ($this->ANP)->add ($this->SAP)->add ($this->FVBZ))->setScale (2, BigDecimal::$ROUND_DOWN);
	}

	/** Ermittlung Jahreslohnsteuer, PAP Seite 17 */
	protected function MLSTJAHR() {

		if($this->STKL < 5) {
			$this->UPEVP();
		} else {
			$this->VSP= BigDecimal::$ZERO;
		}
		if($this->KENNVMT == 0) {
			$this->ZVE= ($this->ZRE4->subtract ($this->ZTABFB)->subtract ($this->VSP))->setScale (2, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->KENNVMT == 1) {
				$this->ZVE= $this->ZRE4OSO->subtract ($this->ZTABFBOSO)->add ($this->ZRE4VMT)->subtract ($this->VSP)->setScale (2, BigDecimal::$ROUND_DOWN);
			} else {
				$this->ZVE= ((($this->ZRE4->subtract ($this->ZTABFB))->divide (self::ZAHL5()))->subtract ($this->VSP))->setScale (2, BigDecimal::$ROUND_DOWN);
			}
		}
		if($this->ZVE->compareTo (self::ZAHL1()) == -1) {
			$this->ZVE= BigDecimal::$ZERO;
			$this->X= BigDecimal::$ZERO;
		} else {
			$this->X= $this->ZVE->divide (BigDecimal::valueOf ($this->KZTAB), 0, BigDecimal::$ROUND_DOWN);
		}
		if($this->STKL < 5) {
			$this->UPTAB07();
		} else {
			$this->MST5_6();
		}
	}

	/** Vorsorgepauschale (§ 39b Abs. 2 Satz 6 Nr 3 EStG) nach Alterseinkünftegesetz, PAP Seite 18 */
	protected function UPEVP() {
/** Achtung: Er wird davon ausgegangen, dass<br>
    a) die Rentenversicherungsbemessungsgrenze sich 2008 auf 63.600 erhöht und<br>
    b) der Beitragsatz zur Rentenversicherung gegenüber 2007 unverändert bleibt */
		if($this->KRV > 0) {
			$this->VSP1= BigDecimal::$ZERO;
		} else {
			if($this->ZRE4VP->compareTo (BigDecimal::valueOf (63600)) == 1) {
				$this->ZRE4VP= BigDecimal::valueOf (63600);
			}
			$this->VSP1= ($this->ZRE4VP->multiply (BigDecimal::valueOf (0.32)))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->VSP1= ($this->VSP1->multiply (BigDecimal::valueOf (0.0995)))->setScale (2, BigDecimal::$ROUND_DOWN);
		}
		$this->VSP2= ($this->ZRE4VP->multiply (BigDecimal::valueOf (0.11)))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->VHB= (BigDecimal::valueOf($this->KZTAB)->multiply(BigDecimal::valueOf (1500)))->setScale (2, BigDecimal::$ROUND_DOWN);
		if($this->VSP2->compareTo ($this->VHB) == 1) {
			$this->VSP2= $this->VHB;
		}
		$this->VSPN= ($this->VSP1->add ($this->VSP2))->setScale (0, BigDecimal::$ROUND_UP);
		$this->MVSP();
		if($this->VSPN->compareTo ($this->VSP) == 1) {
			$this->VSP= $this->VSPN->setScale (2, BigDecimal::$ROUND_DOWN);
		}
	}

	/** Vorsorgepauschale (§39b Abs. 2 Satz 6 Nr 3 EStG) Vergleichsberechnung fuer Guenstigerpruefung, PAP Seite 19 */
	protected function MVSP() {

		$this->VSPO= ($this->ZRE4VP->multiply (BigDecimal::valueOf (0.2)))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->VSPVOR= (BigDecimal::valueOf ($this->KZTAB)->multiply (BigDecimal::valueOf (3068)))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->VSPMAX1= BigDecimal::valueOf ($this->KZTAB)->multiply (BigDecimal::valueOf (1334));
		$this->VSPMAX2= BigDecimal::valueOf ($this->KZTAB)->multiply (BigDecimal::valueOf (667));
		$this->VSPKURZ= BigDecimal::valueOf ($this->KZTAB)->multiply (BigDecimal::valueOf (1134));
		if($this->KRV == 1) {
			if($this->VSPO->compareTo ($this->VSPKURZ) == 1) {
				$this->VSP= $this->VSPKURZ;
			} else {
				$this->VSP= $this->VSPO->setScale (0, BigDecimal::$ROUND_DOWN);
			}
		} else {
			$this->UMVSP();
		}
	}

	/** Vorsorgepauschale, PAP Seite 20 */
	protected function UMVSP() {

		$this->VSPVOR= ($this->VSPVOR->subtract ($this->ZRE4VP->multiply (BigDecimal::valueOf (0.16))))->setScale (2, BigDecimal::$ROUND_DOWN);
		if($this->VSPVOR->compareTo (BigDecimal::$ZERO) == -1) {
			$this->VSPVOR= BigDecimal::$ZERO;
		}
		if($this->VSPO->compareTo ($this->VSPVOR) == 1) {
			$this->VSP= $this->VSPVOR;
			$this->VSPREST= $this->VSPO->subtract ($this->VSPVOR);
			if($this->VSPREST->compareTo ($this->VSPMAX1) == 1) {
				$this->VSP= $this->VSP->add ($this->VSPMAX1);
				$this->VSPREST= ($this->VSPREST->subtract ($this->VSPMAX1))->divide (self::ZAHL2(), 2, BigDecimal::$ROUND_UP);
				if($this->VSPREST->compareTo ($this->VSPMAX2) == 1) {
					$this->VSP= ($this->VSP->add ($this->VSPMAX2))->setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->VSP= ($this->VSP->add ($this->VSPREST))->setScale (0, BigDecimal::$ROUND_DOWN);
				}
			} else {
				$this->VSP= ($this->VSP->add ($this->VSPREST))->setScale (0, BigDecimal::$ROUND_DOWN);
			}
		} else {
			$this->VSP= $this->VSPO->setScale (0, BigDecimal::$ROUND_DOWN);
		}
	}

	/** Lohnsteuer fuer die Steuerklassen V und VI (§ 39b Abs. 2 Satz 8 EStG), PAP Seite 21 */
	protected function MST5_6() {

		$this->ZZX= $this->X;
		if($this->ZZX->compareTo (BigDecimal::valueOf (25812)) == 1) {
			$this->ZX= BigDecimal::valueOf (25812);
			$this->UP5_6();
			if($this->ZZX->compareTo (BigDecimal::valueOf (200000)) == 1) {
				$this->ST= ($this->ST->add (BigDecimal::valueOf (73158.96)))->setScale(0, BigDecimal::$ROUND_DOWN);;
				$this->ST= ($this->ST->add (($this->ZZX->subtract (BigDecimal::valueOf (200000)))->multiply (BigDecimal::valueOf (0.45))))->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				$this->ST= ($this->ST->add (($this->ZZX->subtract (BigDecimal::valueOf (25812)))->multiply (BigDecimal::valueOf (0.42))))->setScale (0, BigDecimal::$ROUND_DOWN);
			}
		} else {
			$this->ZX= $this->ZZX;
			$this->UP5_6();
			if($this->ZZX->compareTo (BigDecimal::valueOf (9144)) == 1) {
				$this->VERGL= $this->ST;
				$this->ZX= BigDecimal::valueOf (9144);
				$this->UP5_6();
				$this->HOCH= ($this->ST->add (($this->ZZX->subtract (BigDecimal::valueOf (9144)))->multiply (BigDecimal::valueOf (0.42))))->setScale (0, BigDecimal::$ROUND_DOWN);
				if($this->HOCH->compareTo ($this->VERGL) == -1) {
					$this->ST= $this->HOCH;
				} else {
					$this->ST= $this->VERGL;
				}
			}
		}
	}

	/** Lohnsteuer fuer die Steuerklassen V und VI (§ 39b Abs. 2 Satz 8 EStG), PAP Seite 21 */
	protected function UP5_6() {

		$this->X= ($this->ZX->multiply (BigDecimal::valueOf (1.25)))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->UPTAB07();
		$this->ST1= $this->ST;
		$this->X= ($this->ZX->multiply (BigDecimal::valueOf (0.75)))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->UPTAB07();
		$this->ST2= $this->ST;
		$this->DIFF= ($this->ST1->subtract ($this->ST2))->multiply (self::ZAHL2());
		$this->MIST= ($this->ZX->multiply (BigDecimal::valueOf (0.15)))->setScale (0, BigDecimal::$ROUND_DOWN);
		if($this->MIST->compareTo ($this->DIFF) == 1) {
			$this->ST= $this->MIST;
		} else {
			$this->ST= $this->DIFF;
		}
	}

	/** Solidaritaetszuschlag, PAP Seite 22 */
	protected function MSOLZ() {

		$this->SOLZFREI= BigDecimal::valueOf (972 * $this->KZTAB);
		if($this->JBMG->compareTo ($this->SOLZFREI) == 1) {
			$this->SOLZJ= ($this->JBMG->multiply (BigDecimal::valueOf (5.5)))->divide(self::ZAHL100())->setScale(2, BigDecimal::$ROUND_DOWN);
			$this->SOLZMIN= ($this->JBMG->subtract ($this->SOLZFREI))->multiply (BigDecimal::valueOf (20))->divide (self::ZAHL100())->setScale (2, BigDecimal::$ROUND_DOWN);
			if($this->SOLZMIN->compareTo ($this->SOLZJ) == -1) {
				$this->SOLZJ= $this->SOLZMIN;
			}
			$this->JW= $this->SOLZJ->multiply (self::ZAHL100())->setScale (0, BigDecimal::$ROUND_DOWN);
			$this->UPANTEIL();
			$this->SOLZLZZ= $this->ANTEIL1;
		} else {
			$this->SOLZLZZ= BigDecimal::$ZERO;
		}
		if($this->R > 0) {
			$this->JW= $this->JBMG->multiply (self::ZAHL100());
			$this->UPANTEIL();
			$this->BK= $this->ANTEIL1;
		} else {
			$this->BK= BigDecimal::$ZERO;
		}
	}

	/** Anteil von Jahresbetraegen fuer einen LZZ (§ 39b Abs. 2 Satz 10 EStG), PAP Seite 23 */
	protected function UPANTEIL() {

		if($this->LZZ == 1) {
			$this->ANTEIL1= $this->JW;
			$this->ANTEIL2= $this->JW;
		} else {
			if($this->LZZ == 2) {
				$this->ANTEIL1= $this->JW->divide (self::ZAHL12(), 0, BigDecimal::$ROUND_DOWN);
				$this->ANTEIL2= $this->JW->divide (self::ZAHL12(), 0, BigDecimal::$ROUND_UP);
			} else {
				if($this->LZZ == 3) {
					$this->ANTEIL1= ($this->JW->multiply (self::ZAHL7()))->divide (self::ZAHL360(), 0, BigDecimal::$ROUND_DOWN);
					$this->ANTEIL2= ($this->JW->multiply (self::ZAHL7()))->divide (self::ZAHL360(), 0, BigDecimal::$ROUND_UP);
				} else {
					$this->ANTEIL1= $this->JW->divide (self::ZAHL360(), 0, BigDecimal::$ROUND_DOWN);
					$this->ANTEIL2= $this->JW->divide (self::ZAHL360(), 0, BigDecimal::$ROUND_UP);
				}
			}
		}
	}

	/** Berechnung sonstiger Bezuege nach § 39b Abs. 3 Saetze 1 bis 7 EStG), PAP Seite 24 */
	protected function MSONST() {

		$this->LZZ= 1;
		if($this->ZMVB == 0) {
			$this->ZMVB= 12;
		}
		if($this->SONSTB->compareTo (BigDecimal::$ZERO) == 0) {
			$this->LSTSO= BigDecimal::$ZERO;
			$this->STS= BigDecimal::$ZERO;
			$this->SOLZS= BigDecimal::$ZERO;
			$this->BKS= BigDecimal::$ZERO;
		} else {
			$this->MOSONST();
			$this->ZRE4J= (($this->JRE4->add ($this->SONSTB))->divide (self::ZAHL100()))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZJ= (($this->JVBEZ->add ($this->VBS))->divide (self::ZAHL100()))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->MRE4SONST();
			$this->MLSTJAHR();
			$this->LSTSO= $this->ST->multiply (self::ZAHL100());
			$this->STS= $this->LSTSO->subtract ($this->LSTOSO);
			if($this->STS->compareTo (BigDecimal::$ZERO) == -1) {
				$this->STS= BigDecimal::$ZERO;
			}
			$this->SOLZS= $this->STS->multiply (BigDecimal::valueOf (5.5))->divide (self::ZAHL100(), 0, BigDecimal::$ROUND_DOWN);
			if($this->R > 0) {
				$this->BKS= $this->STS;
			} else {
				$this->BKS= BigDecimal::$ZERO;
			}
		}
	}

	/** Berechnung der Verguetung fuer mehrjaehrige Taetigkeit nach § 39b Abs. 3 Satz 9 EStG), PAP Seite 25 */
	protected function MVMT() {

		if($this->VKAPA->compareTo (BigDecimal::$ZERO) == -1) {
			$this->VKAPA= BigDecimal::$ZERO;
		}
		if(($this->VMT->add ($this->VKAPA))->compareTo (BigDecimal::$ZERO) == 1) {
			if($this->LSTSO->compareTo (BigDecimal::$ZERO) == 0) {
				$this->MOSONST();
				$this->LST1= $this->LSTOSO;
			} else {
				$this->LST1= $this->LSTSO;
			}
			$this->ZRE4OSO= $this->ZRE4;
			$this->ZTABFBOSO= $this->ZTABFB;
			$this->FVBZOSO= $this->FVBZ;
			$this->ZRE4J= (($this->JRE4->add ($this->SONSTB)->add ($this->VMT)->add ($this->VKAPA))->divide (self::ZAHL100()))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZJ= (($this->JVBEZ->add ($this->VBS)->add ($this->VKAPA))->divide (self::ZAHL100()))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->MRE4SONST();
			$this->MLSTJAHR();
			$this->LST3= $this->ST->multiply (self::ZAHL100());
			$this->ZTABFB= ($this->ZTABFB->subtract ($this->FVBZ)->add ($this->FVBZOSO))->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->KENNVMT= 1;
			if(($this->JRE4->add ($this->SONSTB)->subtract ($this->JFREIB)->add ($this->JHINZU))->compareTo (BigDecimal::$ZERO) == -1) {
				$this->KENNVMT= 2;
				$this->MLSTJAHR();
				$this->LST2= $this->ST->multiply (self::ZAHL100());
				$this->STV= $this->LST2->multiply (self::ZAHL5());
			} else {
				$this->ZRE4VMT= ((($this->VMT->divide (self::ZAHL100()))->add ($this->VKAPA->divide (self::ZAHL100()))->subtract ($this->ZTABFB)->add ($this->ZTABFBOSO))->divide (self::ZAHL5()))->setScale (2, BigDecimal::$ROUND_DOWN);
				$this->MLSTJAHR();
				$this->LST2= $this->ST->multiply (self::ZAHL100());
				$this->STV= ($this->LST2->subtract ($this->LST1))->multiply (self::ZAHL5());
			}
			$this->LST3= $this->LST3->subtract ($this->LST1);
			if($this->LST3->compareTo ($this->STV) == -1) {
				$this->STV= $this->LST3;
			}
			if($this->STV->compareTo (BigDecimal::$ZERO) == -1) {
				$this->STV= BigDecimal::$ZERO;
			}
			$this->SOLZV= ($this->STV->multiply (BigDecimal::valueOf (5.5)))->divide (self::ZAHL100(), 0, BigDecimal::$ROUND_DOWN);
			if($this->R > 0) {
				$this->BKV= $this->STV;
			} else {
				$this->BKV= BigDecimal::$ZERO;
			}
		} else {
			$this->STV= BigDecimal::$ZERO;
			$this->SOLZV= BigDecimal::$ZERO;
			$this->BKV= BigDecimal::$ZERO;
		}
	}

	/** Sonderberechnung ohne sonstige Bezüge für Berechnung bei sonstigen Bezügen oder Vergütung für mehrjährige Tätigkeit, PAP Seite 26 */
	protected function MOSONST() {

		$this->ZRE4J= ($this->JRE4->divide (self::ZAHL100()))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->ZVBEZJ= ($this->JVBEZ->divide (self::ZAHL100()))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->JLFREIB= $this->JFREIB->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
		$this->JLHINZU= $this->JHINZU->divide (self::ZAHL100(), 2, BigDecimal::$ROUND_DOWN);
		$this->MRE4();
		$this->MRE4ABZ();
		$this->MZTABFB();
		$this->MLSTJAHR();
		$this->LSTOSO= $this->ST->multiply (self::ZAHL100());
	}

	/** Sonderberechnung mit sonstige Bezüge für Berechnung bei sonstigen Bezügen oder Vergütung für mehrjährige Tätigkeit, PAP Seite 26 */
	protected function MRE4SONST() {

		$this->MRE4();
		$this->FVB= $this->FVBSO;
		$this->MRE4ABZ();
		$this->FVBZ= $this->FVBZSO;
		$this->MZTABFB();
	}

	/** Tarifliche Einkommensteuer §32a EStG, PAP Seite 27 */
	protected function UPTAB07() {

		if($this->X->compareTo (BigDecimal::valueOf (7665)) == -1) {
			$this->ST= BigDecimal::$ZERO;
		} else {
			if($this->X->compareTo (BigDecimal::valueOf (12740)) == -1) {
				$this->Y= ($this->X->subtract (BigDecimal::valueOf (7664)))->divide (BigDecimal::valueOf (10000), 6, BigDecimal::$ROUND_DOWN);
				$this->RW= $this->Y->multiply (BigDecimal::valueOf (883.74));
				$this->RW= $this->RW->add (BigDecimal::valueOf (1500));
				$this->ST= ($this->RW->multiply ($this->Y))->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->X->compareTo (BigDecimal::valueOf (52152)) == -1) {
					$this->Y= ($this->X->subtract (BigDecimal::valueOf (12739)))->divide (BigDecimal::valueOf (10000), 6, BigDecimal::$ROUND_DOWN);
					$this->RW= $this->Y->multiply (BigDecimal::valueOf (228.74));
					$this->RW= $this->RW->add (BigDecimal::valueOf (2397));
					$this->RW= $this->RW->multiply ($this->Y);
					$this->ST= ($this->RW->add (BigDecimal::valueOf (989)))->setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					if($this->X->compareTo (BigDecimal::valueOf (250001)) == -1) {
						$this->ST= (($this->X->multiply (BigDecimal::valueOf (0.42)))->subtract (BigDecimal::valueOf (7914)))->setScale (0, BigDecimal::$ROUND_DOWN);
					} else {
						$this->ST= (($this->X->multiply (BigDecimal::valueOf (0.45)))->subtract (BigDecimal::valueOf (15414)))->setScale (0, BigDecimal::$ROUND_DOWN);
					}
				}
			}
		}
		$this->ST= $this->ST->multiply (BigDecimal::valueOf ($this->KZTAB));
	}

}