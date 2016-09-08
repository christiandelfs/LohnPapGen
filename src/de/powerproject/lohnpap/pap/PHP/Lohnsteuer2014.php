<?php

namespace Services;

/**
 * Klasse Lohnsteuer2014
 * 
 * @author Christian Delfs
 */

class Lohnsteuer2014 implements LohnsteuerInterface {

	/** Stand: 2013-11-18, 10:25 */
	/** ZIVIT Düsseldorf */

	/* EINGABEPARAMETER*/

	protected $af;
	protected $AJAHR;
	protected $ALTER1;
	protected $ENTSCH;
	protected $f;
	protected $JFREIB;
	protected $JHINZU;
	protected $JRE4;
	protected $JVBEZ;
	protected $KRV;
	protected $LZZ;
	protected $LZZFREIB;
	protected $LZZHINZU;
	protected $PKPV;
	protected $PKV;
	protected $PVS;
	protected $PVZ;
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
	protected $JRE4ENT;
	protected $SONSTENT;

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
	protected $VKVLZZ;
	/** Neu 2014 Ursprünglich INTERNAL definiert */
	protected $VKVSONST;
	/** Neu 2014 Ursprünglich INTERNAL definiert */

	/* INTERNE FELDER*/

	/** spezielles ZVE f. Einkommensteuer-Berechnung, dieses darf negativ werden. */
	protected $zveEkSt;
	protected $zveGemeinsam;

	/** Altersentlastungsbetrag nach Alterseinkünftegesetz in €,<br>
             Cent (2 Dezimalstellen) */
	protected $ALTE;

	/** Arbeitnehmer-Pauschbetrag in EURO */
	protected $ANP;

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents abgerundet */
	protected $ANTEIL1;

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

	/** Maximaler Altersentlastungsbetrag in € */
	protected $HBALTE;

	/** Massgeblicher maximaler Versorgungsfreibetrag in € */
	protected $HFVB;

	/** Massgeblicher maximaler Zuschlag zum Versorgungsfreibetrag in €,Cent<br>
             (2 Dezimalstellen) */
	protected $HFVBZ;

	/** Massgeblicher maximaler Zuschlag zum Versorgungsfreibetrag in €, Cent<br>
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
			 2 = entfällt */
	protected $KENNVMT;

	/** Summe der Freibetraege fuer Kinder in EURO */
	protected $KFB;

	/** Beitragssatz des Arbeitgebers zur Krankenversicherung */
	protected $KVSATZAG;

	/** Beitragssatz des Arbeitnehmers zur Krankenversicherung */
	protected $KVSATZAN;

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

	/** Beitragssatz des Arbeitgebers zur Pflegeversicherung */
	protected $PVSATZAG;

	/** Beitragssatz des Arbeitnehmers zur Pflegeversicherung */
	protected $PVSATZAN;

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

	/** Zwischenfeld zur Ermittlung der Steuer auf Vergütungen für mehrjährige Tätigkeit */
	protected $STOVMT;

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

	/** Vorsorgepauschale mit Teilbeträgen für die gesetzliche Kranken- und <br>
			 soziale Pflegeversicherung nach fiktiven Beträgen oder ggf. für die<br>
			 private Basiskrankenversicherung und private Pflege-Pflichtversicherung <br>
			 in Euro, Cent (2 Dezimalstellen) */
	protected $VSP3;

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

	/** Auf einen Jahreslohn hochgerechnetes RE4 in €, C (2 Dezimalstellen)<br>
             nach Abzug des Versorgungsfreibetrags und des Alterentlastungsbetrags<br>
             zur Berechnung der Vorsorgepauschale in €, Cent (2 Dezimalstellen) */
	protected $ZRE4VP;

	/** Feste Tabellenfreibeträge (ohne Vorsorgepauschale) in €, Cent<br>
             (2 Dezimalstellen) */
	protected $ZTABFB;

	/** Auf einen Jahreslohn hochgerechnetes (VBEZ abzueglich FVB) in<br>
             EURO, C (2 Dezimalstellen) */
	protected $ZVBEZ;

	/** Auf einen Jahreslohn hochgerechnetes VBEZ in €, C (2 Dezimalstellen) */
	protected $ZVBEZJ;

	/** Zu versteuerndes Einkommen in €, C (2 Dezimalstellen) */
	protected $ZVE;

	/** Zwischenfelder zu X fuer die Berechnung der Steuer nach § 39b<br>
             Abs. 2 Satz 7 EStG in € */
	protected $ZX;
	protected $ZZX;
	protected $HOCH;
	protected $VERGL;

	/** Jahreswert der berücksichtigten Beiträge zur privaten Basis-Krankenversicherung und <br>
			  privaten Pflege-Pflichtversicherung (ggf. auch die Mindestvorsorgepauschale) in Cent. */
	protected $VKV;

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
	protected static $ZAHL500;
	protected static $ZAHL700;
	protected static $ZAHL1000;

	/** Rentenbemessungs-Grenze neue Bundesländer in EUR */

	/** Neuer Wert  2014 */
	protected static $RENTBEMESSUNGSGR_OST;

	/** Rentenbemessungs-Grenze alte Bundesländer in EUR */

	/** Neuer Wert 2014 */
	protected static $RENTBEMESSUNGSGR_WEST;

	/* SETTER */

	
	public function setJHINZU($arg0) { $this->JHINZU = $arg0; }

	
	public function setVKAPA($arg0) { $this->VKAPA = $arg0; }

	
	public function setVBEZS($arg0) { $this->VBEZS = $arg0; }

	
	public function setVBEZ($arg0) { $this->VBEZ = $arg0; }

	
	public function setVJAHR($arg0) { $this->VJAHR = $arg0; }

	
	public function setJRE4ENT($arg0) { $this->JRE4ENT = $arg0; }

	
	public function setPVS($arg0) { $this->PVS = $arg0; }

	
	public function setLZZ($arg0) { $this->LZZ = $arg0; }

	
	public function setKRV($arg0) { $this->KRV = $arg0; }

	
	public function setJFREIB($arg0) { $this->JFREIB = $arg0; }

	
	public function setJVBEZ($arg0) { $this->JVBEZ = $arg0; }

	
	public function setR($arg0) { $this->R = $arg0; }

	
	public function setPVZ($arg0) { $this->PVZ = $arg0; }

	
	public function setVBEZM($arg0) { $this->VBEZM = $arg0; }

	
	public function setLZZFREIB($arg0) { $this->LZZFREIB = $arg0; }

	
	public function setRE4($arg0) { $this->RE4 = $arg0; }

	
	public function setPKPV($arg0) { $this->PKPV = $arg0; }

	
	public function setSTKL($arg0) { $this->STKL = $arg0; }

	
	public function setaf($arg0) { $this->af = $arg0; }

	
	public function setf($arg0) { $this->f = $arg0; }

	
	public function setVBS($arg0) { $this->VBS = $arg0; }

	
	public function setLZZHINZU($arg0) { $this->LZZHINZU = $arg0; }

	
	public function setSONSTB($arg0) { $this->SONSTB = $arg0; }

	
	public function setSTERBE($arg0) { $this->STERBE = $arg0; }

	
	public function setAJAHR($arg0) { $this->AJAHR = $arg0; }

	
	public function setZKF($arg0) { $this->ZKF = $arg0; }

	
	public function setJRE4($arg0) { $this->JRE4 = $arg0; }

	
	public function setZMVB($arg0) { $this->ZMVB = $arg0; }

	
	public function setSONSTENT($arg0) { $this->SONSTENT = $arg0; }

	
	public function setALTER1($arg0) { $this->ALTER1 = $arg0; }

	
	public function setPKV($arg0) { $this->PKV = $arg0; }

	
	public function setVMT($arg0) { $this->VMT = $arg0; }

	
	public function setENTSCH($arg0) { $this->ENTSCH = $arg0; }

	
	public function setKVZ($arg0) {  }// required for newer calculator

	/* GETTER */

	
	public function getVKVLZZ() { return $this->VKVLZZ; }

	
	public function getSTS() { return $this->STS; }

	
	public function getSTV() { return $this->STV; }

	
	public function getLSTLZZ() { return $this->LSTLZZ; }

	
	public function getBK() { return $this->BK; }

	
	public function getSOLZV() { return $this->SOLZV; }

	
	public function getBKS() { return $this->BKS; }

	
	public function getBKV() { return $this->BKV; }

	
	public function getVKVSONST() { return $this->VKVSONST; }

	
	public function getSOLZLZZ() { return $this->SOLZLZZ; }

	
	public function getSOLZS() { return $this->SOLZS; }

	
	public function getWVFRBM() {  return null; }// required for newer calculator

	
	public function getWVFRB() {  return null; }// required for newer calculator

	
	public function getVFRB() {  return null; }// required for newer calculator

	
	public function getWVFRBO() {  return null; }// required for newer calculator

	
	public function getVFRBS2() {  return null; }// required for newer calculator

	
	public function getVFRBS1() {  return null; }// required for newer calculator


	
	public function getVSPREST() { return $this->VSPREST; }

	
	public function getZVBEZJ() { return $this->ZVBEZJ; }

	public function getzveGemeinsam() { return $this->zveGemeinsam; }

	
	public function getKVSATZAN() { return $this->KVSATZAN; }

	
	public function getKENNVMT() { return $this->KENNVMT; }

	
	public function getLST3() { return $this->LST3; }

	
	public function getZTABFB() { return $this->ZTABFB; }

	
	public function getLST2() { return $this->LST2; }

	
	public function getLST1() { return $this->LST1; }

	
	public function getKVSATZAG() { return $this->KVSATZAG; }

	
	public function getZVE() { return $this->ZVE; }

	
	public function getFVBZ() { return $this->FVBZ; }

	
	public function getSOLZFREI() { return $this->SOLZFREI; }

	
	public function getHFVB() { return $this->HFVB; }

	
	public function getHOCH() { return $this->HOCH; }

	
	public function getLSTJAHR() { return $this->LSTJAHR; }

	
	public function getPVSATZAG() { return $this->PVSATZAG; }

	
	public function getPVSATZAN() { return $this->PVSATZAN; }

	
	public function getSOLZJ() { return $this->SOLZJ; }

	
	public function getZZX() { return $this->ZZX; }

	
	public function getLSTSO() { return $this->LSTSO; }

	
	public function getANTEIL1() { return $this->ANTEIL1; }

	
	public function getVSPMAX2() { return $this->VSPMAX2; }

	
	public function getDIFF() { return $this->DIFF; }

	
	public function getVSPMAX1() { return $this->VSPMAX1; }

	
	public function getZVBEZ() { return $this->ZVBEZ; }

	
	public function getJLHINZU() { return $this->JLHINZU; }

	
	public function getVSP() { return $this->VSP; }

	public function getzveEkSt() { return $this->zveEkSt; }

	
	public function getZX() { return $this->ZX; }

	
	public function getVKV() { return $this->VKV; }

	
	public function getEFA() { return $this->EFA; }

	
	public function getALTE() { return $this->ALTE; }

	
	public function getANP() { return $this->ANP; }

	
	public function getHFVBZSO() { return $this->HFVBZSO; }

	
	public function getSAP() { return $this->SAP; }

	
	public function getRW() { return $this->RW; }

	
	public function getSOLZMIN() { return $this->SOLZMIN; }

	
	public function getKFB() { return $this->KFB; }

	
	public function getSTOVMT() { return $this->STOVMT; }

	
	public function getVSP3() { return $this->VSP3; }

	
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

	
	public function getTBSVORV() { return null; }// required for newer calculator

	
	public function getRVSATZAN() { return null; }// required for newer calculator

	
	public function getBBGKVPV() { return null; }// required for newer calculator

	
	public function getGFB() { return null; }// required for newer calculator

	
	public function getW3STKL5() { return null; }// required for newer calculator

	
	public function getBBGRV() { return null; }// required for newer calculator

	
	public function getW2STKL5() { return null; }// required for newer calculator

	
	public function getW1STKL5() { return null; }// required for newer calculator

	function __construct() {
	$this->VSPREST=new BigDecimal(0);
	$this->JHINZU=new BigDecimal(0);
	$this->KVSATZAN=new BigDecimal(0);
	$this->KENNVMT=0;
	$this->LST3=new BigDecimal(0);
	$this->LST2=new BigDecimal(0);
	$this->LST1=new BigDecimal(0);
	$this->KVSATZAG=new BigDecimal(0);
	$this->VJAHR=0;
	$this->FVBZ=new BigDecimal(0);
	$this->HFVB=new BigDecimal(0);
	$this->PVS=0;
	$this->LSTJAHR=new BigDecimal(0);
	$this->STS=new BigDecimal(0);
	$this->PVSATZAG=new BigDecimal(0);
	$this->STV=new BigDecimal(0);
	$this->PVSATZAN=new BigDecimal(0);
	$this->PVZ=0;
	$this->SOLZJ=new BigDecimal(0);
	$this->ZZX=new BigDecimal(0);
	$this->SOLZV=new BigDecimal(0);
	$this->SOLZS=new BigDecimal(0);
	$this->ANTEIL1=new BigDecimal(0);
	$this->af=1;
	$this->DIFF=new BigDecimal(0);
	$this->VBS=new BigDecimal(0);
	$this->LZZHINZU=new BigDecimal(0);
	$this->BKS=new BigDecimal(0);
	$this->BKV=new BigDecimal(0);
	$this->JLHINZU=new BigDecimal(0);
	$this->VSP=new BigDecimal(0);
	$this->ZKF=new BigDecimal(0);
	$this->zveEkSt=new BigDecimal(0);
	$this->ZMVB=0;
	$this->VKVSONST=new BigDecimal(0);
	$this->ZX=new BigDecimal(0);
	$this->VKV=new BigDecimal(0);
	$this->RW=new BigDecimal(0);
	$this->KFB=new BigDecimal(0);
	$this->VSP3=new BigDecimal(0);
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
	$this->PKPV=new BigDecimal(0);
	$this->f=1.0;
	$this->HFVBZ=new BigDecimal(0);
	$this->SONSTB=new BigDecimal(0);
	$this->FVB=new BigDecimal(0);
	$this->VERGL=new BigDecimal(0);
	$this->VSP1=new BigDecimal(0);
	$this->LSTOSO=new BigDecimal(0);
	$this->VSP2=new BigDecimal(0);
	$this->SONSTENT=BigDecimal::ZERO();
	$this->ZRE4J=new BigDecimal(0);
	$this->VMT=new BigDecimal(0);
	$this->ENTSCH=new BigDecimal(0);
	$this->ZVBEZJ=new BigDecimal(0);
	$this->zveGemeinsam=new BigDecimal(0);
	$this->ZTABFB=new BigDecimal(0);
	$this->ZVE=new BigDecimal(0);
	$this->SOLZFREI=new BigDecimal(0);
	$this->LZZ=0;
	$this->HOCH=new BigDecimal(0);
	$this->JFREIB=new BigDecimal(0);
	$this->JVBEZ=new BigDecimal(0);
	$this->LZZFREIB=new BigDecimal(0);
	$this->LSTSO=new BigDecimal(0);
	$this->VKVLZZ=new BigDecimal(0);
	$this->STKL=0;
	$this->VSPMAX2=new BigDecimal(0);
	$this->VSPMAX1=new BigDecimal(0);
	$this->ZVBEZ=new BigDecimal(0);
	$this->SOLZLZZ=new BigDecimal(0);
	$this->ALTER1=0;
	$this->PKV=0;
	$this->EFA=new BigDecimal(0);
	$this->ALTE=new BigDecimal(0);
	$this->VKAPA=new BigDecimal(0);
	$this->ANP=new BigDecimal(0);
	$this->HFVBZSO=new BigDecimal(0);
	$this->SAP=new BigDecimal(0);
	$this->SOLZMIN=new BigDecimal(0);
	$this->VBEZS=new BigDecimal(0);
	$this->STOVMT=new BigDecimal(0);
	$this->FVBZSO=new BigDecimal(0);
	$this->JRE4ENT=BigDecimal::ZERO();
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
	self::$ZAHL10=BigDecimal::TEN();
	self::$ZAHL12=new BigDecimal(12);
	self::$TAB5=array(BigDecimal::valueOf (0), BigDecimal::valueOf (1900),                  BigDecimal::valueOf (1824), BigDecimal::valueOf (1748),                  BigDecimal::valueOf (1672), BigDecimal::valueOf (1596),                  BigDecimal::valueOf (1520), BigDecimal::valueOf (1444),                  BigDecimal::valueOf (1368), BigDecimal::valueOf (1292),                  BigDecimal::valueOf (1216), BigDecimal::valueOf (1140),                  BigDecimal::valueOf (1064), BigDecimal::valueOf (988),                  BigDecimal::valueOf (912), BigDecimal::valueOf (836),                  BigDecimal::valueOf (760), BigDecimal::valueOf (722),                  BigDecimal::valueOf (684), BigDecimal::valueOf (646),                  BigDecimal::valueOf (608), BigDecimal::valueOf (570),                  BigDecimal::valueOf (532), BigDecimal::valueOf (494),                  BigDecimal::valueOf (456), BigDecimal::valueOf (418),                  BigDecimal::valueOf (380), BigDecimal::valueOf (342),                  BigDecimal::valueOf (304), BigDecimal::valueOf (266),                  BigDecimal::valueOf (228), BigDecimal::valueOf (190),                  BigDecimal::valueOf (152), BigDecimal::valueOf (114),                  BigDecimal::valueOf (76), BigDecimal::valueOf (38),                  BigDecimal::valueOf (0));
	self::$ZAHL1000=new BigDecimal(1000);
	self::$ZAHL100=new BigDecimal(100);
	self::$ZAHL360=new BigDecimal(360);
	self::$ZAHL700=new BigDecimal(700);
	self::$ZAHL500=new BigDecimal(500);
	self::$ZAHL1=BigDecimal::ONE();
	self::$ZAHL2=new BigDecimal(2);
	self::$RENTBEMESSUNGSGR_OST=new BigDecimal(60000);
	self::$ZAHL0=BigDecimal::ZERO();
	self::$TAB4=array(BigDecimal::valueOf (0.0), BigDecimal::valueOf (0.4),                  BigDecimal::valueOf (0.384), BigDecimal::valueOf (0.368),                  BigDecimal::valueOf (0.352), BigDecimal::valueOf (0.336),                  BigDecimal::valueOf (0.32), BigDecimal::valueOf (0.304),                  BigDecimal::valueOf (0.288), BigDecimal::valueOf (0.272),                  BigDecimal::valueOf (0.256), BigDecimal::valueOf (0.24),                  BigDecimal::valueOf (0.224), BigDecimal::valueOf (0.208),                  BigDecimal::valueOf (0.192), BigDecimal::valueOf (0.176),                  BigDecimal::valueOf (0.16), BigDecimal::valueOf (0.152),                  BigDecimal::valueOf (0.144), BigDecimal::valueOf (0.136),                  BigDecimal::valueOf (0.128), BigDecimal::valueOf (0.12),                  BigDecimal::valueOf (0.112), BigDecimal::valueOf (0.104),                  BigDecimal::valueOf (0.096), BigDecimal::valueOf (0.088),                  BigDecimal::valueOf (0.08), BigDecimal::valueOf (0.072),                  BigDecimal::valueOf (0.064), BigDecimal::valueOf (0.056),                  BigDecimal::valueOf (0.048), BigDecimal::valueOf (0.04),                  BigDecimal::valueOf (0.032), BigDecimal::valueOf (0.024),                  BigDecimal::valueOf (0.016), BigDecimal::valueOf (0.008),                  BigDecimal::valueOf (0.0));
	self::$ZAHL5=new BigDecimal(5);
	self::$RENTBEMESSUNGSGR_WEST=new BigDecimal(71400);
	self::$TAB3=array(BigDecimal::valueOf (0), BigDecimal::valueOf (900),                  BigDecimal::valueOf (864), BigDecimal::valueOf (828),                  BigDecimal::valueOf (792), BigDecimal::valueOf (756),                  BigDecimal::valueOf (720), BigDecimal::valueOf (684),                  BigDecimal::valueOf (648), BigDecimal::valueOf (612),                  BigDecimal::valueOf (576), BigDecimal::valueOf (540),                  BigDecimal::valueOf (504), BigDecimal::valueOf (468),                  BigDecimal::valueOf (432), BigDecimal::valueOf (396),                  BigDecimal::valueOf (360), BigDecimal::valueOf (342),                  BigDecimal::valueOf (324), BigDecimal::valueOf (306),                  BigDecimal::valueOf (288), BigDecimal::valueOf (270),                  BigDecimal::valueOf (252), BigDecimal::valueOf (234),                  BigDecimal::valueOf (216), BigDecimal::valueOf (198),                  BigDecimal::valueOf (180), BigDecimal::valueOf (162),                  BigDecimal::valueOf (144), BigDecimal::valueOf (126),                  BigDecimal::valueOf (108), BigDecimal::valueOf (90),                  BigDecimal::valueOf (72), BigDecimal::valueOf (54),                  BigDecimal::valueOf (36), BigDecimal::valueOf (18),                  BigDecimal::valueOf (0));
	self::$ZAHL6=new BigDecimal(6);
	self::$TAB2=array(BigDecimal::valueOf (0), BigDecimal::valueOf (3000),                  BigDecimal::valueOf (2880), BigDecimal::valueOf (2760),                  BigDecimal::valueOf (2640), BigDecimal::valueOf (2520),                  BigDecimal::valueOf (2400), BigDecimal::valueOf (2280),                  BigDecimal::valueOf (2160), BigDecimal::valueOf (2040),                  BigDecimal::valueOf (1920), BigDecimal::valueOf (1800),                  BigDecimal::valueOf (1680), BigDecimal::valueOf (1560),                  BigDecimal::valueOf (1440), BigDecimal::valueOf (1320),                  BigDecimal::valueOf (1200), BigDecimal::valueOf (1140),                  BigDecimal::valueOf (1080), BigDecimal::valueOf (1020),                  BigDecimal::valueOf (960), BigDecimal::valueOf (900),                  BigDecimal::valueOf (840), BigDecimal::valueOf (780),                  BigDecimal::valueOf (720), BigDecimal::valueOf (660),                  BigDecimal::valueOf (600), BigDecimal::valueOf (540),                  BigDecimal::valueOf (480), BigDecimal::valueOf (420),                  BigDecimal::valueOf (360), BigDecimal::valueOf (300),                  BigDecimal::valueOf (240), BigDecimal::valueOf (180),                  BigDecimal::valueOf (120), BigDecimal::valueOf (60),                  BigDecimal::valueOf (0));
	self::$ZAHL3=new BigDecimal(3);
	self::$TAB1=array(BigDecimal::valueOf (0.0), BigDecimal::valueOf (0.4),                BigDecimal::valueOf (0.384), BigDecimal::valueOf (0.368),                BigDecimal::valueOf (0.352), BigDecimal::valueOf (0.336),                BigDecimal::valueOf (0.32), BigDecimal::valueOf (0.304),                BigDecimal::valueOf (0.288), BigDecimal::valueOf (0.272),                BigDecimal::valueOf (0.256), BigDecimal::valueOf (0.24),                BigDecimal::valueOf (0.224), BigDecimal::valueOf (0.208),                BigDecimal::valueOf (0.192), BigDecimal::valueOf (0.176),                BigDecimal::valueOf (0.16), BigDecimal::valueOf (0.152),                BigDecimal::valueOf (0.144), BigDecimal::valueOf (0.136),                BigDecimal::valueOf (0.128), BigDecimal::valueOf (0.12),                BigDecimal::valueOf (0.112), BigDecimal::valueOf (0.104),                BigDecimal::valueOf (0.096), BigDecimal::valueOf (0.088),                BigDecimal::valueOf (0.08), BigDecimal::valueOf (0.072),                BigDecimal::valueOf (0.064), BigDecimal::valueOf (0.056),                BigDecimal::valueOf (0.048), BigDecimal::valueOf (0.04),                BigDecimal::valueOf (0.032), BigDecimal::valueOf (0.024),                BigDecimal::valueOf (0.016), BigDecimal::valueOf (0.008),                BigDecimal::valueOf (0.0));
	self::$ZAHL4=new BigDecimal(4);
	self::$ZAHL9=new BigDecimal(9);
	self::$ZAHL7=new BigDecimal(7);
	self::$ZAHL8=new BigDecimal(8);
	}
	/** PROGRAMMABLAUFPLAN, PAP Seite 12 */
	
	public function main() {

		$this->MRE4JL();
		$this->VBEZBSO= BigDecimal::ZERO();
		$this->KENNVMT= 0;
		$this->MRE4();
		$this->MRE4ABZ();
		$this->MZTABFB();
		$this->MLSTJAHR();
		$this->LSTJAHR= $this->ST->multiply(BigDecimal::valueOf($this->f))->setScale(0,BigDecimal::$ROUND_DOWN);
		$this->JW= $this->LSTJAHR->multiply(self::$ZAHL100);
		$this->UPLSTLZZ();
		$this->UPVKVLZZ();
		if($this->ZKF->compareTo (BigDecimal::ZERO()) == 1) {
			$this->ZTABFB= $this->ZTABFB->add ($this->KFB)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->MRE4ABZ();
			$this->MLSTJAHR();
			$this->JBMG= $this->ST->multiply(BigDecimal::valueOf($this->f))->setScale(0, BigDecimal::$ROUND_DOWN);
		} else {
			$this->JBMG= $this->LSTJAHR;
		}
		$this->MSOLZ();
		$this->MSONST();
		$this->MVMT();
	}

	/** Ermittlung des Jahresarbeitslohns nach § 39 b Abs. 2 Satz 2 EStG, PAP Seite 12 */
	protected function MRE4JL() {

		if($this->LZZ == 1) {
			$this->ZRE4J= $this->RE4->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZJ= $this->VBEZ->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			$this->JLFREIB= $this->LZZFREIB->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			$this->JLHINZU= $this->LZZHINZU->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->LZZ == 2) {
				$this->ZRE4J= $this->RE4->multiply (self::$ZAHL12)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				$this->ZVBEZJ= $this->VBEZ->multiply (self::$ZAHL12)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				$this->JLFREIB= $this->LZZFREIB->multiply (self::$ZAHL12)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				$this->JLHINZU= $this->LZZHINZU->multiply (self::$ZAHL12)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->LZZ == 3) {
					$this->ZRE4J= $this->RE4->multiply (self::$ZAHL360)->divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
					$this->ZVBEZJ= $this->VBEZ->multiply (self::$ZAHL360)->divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
					$this->JLFREIB= $this->LZZFREIB->multiply (self::$ZAHL360)->divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
					$this->JLHINZU= $this->LZZHINZU->multiply (self::$ZAHL360)->divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ZRE4J= $this->RE4->multiply (self::$ZAHL360)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
					$this->ZVBEZJ= $this->VBEZ->multiply (self::$ZAHL360)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
					$this->JLFREIB= $this->LZZFREIB->multiply (self::$ZAHL360)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
					$this->JLHINZU= $this->LZZHINZU->multiply (self::$ZAHL360)->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				}
			}
		}
		if($this->af == 0) {
			$this->f= 1;
		}
	}

	/** Freibeträge für Versorgungsbezüge, Altersentlastungsbetrag (§ 39b Abs. 2 Satz 3 EStG), PAP Seite 13 */
	protected function MRE4() {

		if($this->ZVBEZJ->compareTo (BigDecimal::ZERO()) == 0) {
			$this->FVBZ= BigDecimal::ZERO();
			$this->FVB= BigDecimal::ZERO();
			$this->FVBZSO= BigDecimal::ZERO();
			$this->FVBSO= BigDecimal::ZERO();
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
				$this->VBEZB= $this->VBEZM->multiply (BigDecimal::valueOf ($this->ZMVB))->add ($this->VBEZS);
				$this->HFVB= self::$TAB2[$this->J]->divide (self::$ZAHL12)->multiply (BigDecimal::valueOf ($this->ZMVB));
				$this->FVBZ= self::$TAB3[$this->J]->divide (self::$ZAHL12)->multiply (BigDecimal::valueOf ($this->ZMVB))->setScale (0, BigDecimal::$ROUND_UP);
			} else {
				$this->VBEZB= $this->VBEZM->multiply (self::$ZAHL12)->add ($this->VBEZS)->setScale (2, BigDecimal::$ROUND_DOWN);
				$this->HFVB= self::$TAB2[$this->J];
				$this->FVBZ= self::$TAB3[$this->J];
			}
			$this->FVB= $this->VBEZB->multiply (self::$TAB1[$this->J])->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_UP);
			if($this->FVB->compareTo ($this->HFVB) == 1) {
				$this->FVB = $this->HFVB;
			}
			$this->FVBSO= $this->FVB->add($this->VBEZBSO->multiply (self::$TAB1[$this->J]))->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_UP);
			if($this->FVBSO->compareTo (self::$TAB2[$this->J]) == 1) {
				$this->FVBSO = self::$TAB2[$this->J];
			}
			$this->HFVBZSO= $this->VBEZB->add($this->VBEZBSO)->divide (self::$ZAHL100)->subtract ($this->FVBSO)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->FVBZSO= $this->FVBZ->add($this->VBEZBSO)->divide (self::$ZAHL100)->setScale (0, BigDecimal::$ROUND_UP);
			if($this->FVBZSO->compareTo ($this->HFVBZSO) == 1) {
				$this->FVBZSO = $this->HFVBZSO->setScale(0, BigDecimal::$ROUND_UP);
			}
			if($this->FVBZSO->compareTo (self::$TAB3[$this->J]) == 1) {
				$this->FVBZSO = self::$TAB3[$this->J];
			}
			$this->HFVBZ= $this->VBEZB->divide (self::$ZAHL100)->subtract ($this->FVB)->setScale (2, BigDecimal::$ROUND_DOWN);
			if($this->FVBZ->compareTo ($this->HFVBZ) == 1) {
				$this->FVBZ = $this->HFVBZ->setScale (0, BigDecimal::$ROUND_UP);
			}
		}
		$this->MRE4ALTE();
	}

	/** Altersentlastungsbetrag (§ 39b Abs. 2 Satz 3 EStG), PAP Seite 14 */
	protected function MRE4ALTE() {

		if($this->ALTER1 == 0) {
			$this->ALTE= BigDecimal::ZERO();
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
			$this->BMG= $this->ZRE4J->subtract ($this->ZVBEZJ);/** Lt. PAP muss hier auf ganze EUR gerundet werden */
			$this->ALTE = $this->BMG->multiply(self::$TAB4[$this->K])->setScale(0, BigDecimal::$ROUND_UP);
			$this->HBALTE= self::$TAB5[$this->K];
			if($this->ALTE->compareTo ($this->HBALTE) == 1) {
				$this->ALTE= $this->HBALTE;
			}
		}
	}

	/** Ermittlung des Jahresarbeitslohns nach Abzug der Freibeträge nach § 39 b Abs. 2 Satz 3 und 4 EStG, PAP Seite 16 */
	protected function MRE4ABZ() {

		$this->ZRE4= $this->ZRE4J->subtract ($this->FVB)->subtract   ($this->ALTE)->subtract ($this->JLFREIB)->add ($this->JLHINZU)->setScale (2, BigDecimal::$ROUND_DOWN);
		if($this->ZRE4->compareTo (BigDecimal::ZERO()) == -1) {
			$this->ZRE4= BigDecimal::ZERO();
		}
		$this->ZRE4VP= $this->ZRE4J;
		if($this->KENNVMT == 2) {
			$this->ZRE4VP = $this->ZRE4VP->subtract($this->ENTSCH->divide(self::$ZAHL100))->setScale(2,BigDecimal::$ROUND_DOWN);
		}
		$this->ZVBEZ = $this->ZVBEZJ->subtract($this->FVB)->setScale(2, BigDecimal::$ROUND_DOWN);
		if($this->ZVBEZ->compareTo(BigDecimal::ZERO()) == -1) {
			$this->ZVBEZ = BigDecimal::ZERO();
		}
	}

	/** Ermittlung der festen Tabellenfreibeträge (ohne Vorsorgepauschale), PAP Seite 17 */
	protected function MZTABFB() {

		$this->ANP= BigDecimal::ZERO();
		if($this->ZVBEZ->compareTo (BigDecimal::ZERO()) >= 0 && $this->ZVBEZ->compareTo($this->FVBZ) == -1) {
			$this->FVBZ = BigDecimal::valueOf($this->ZVBEZ->longValue());
		}
		if($this->STKL < 6) {
			if($this->ZVBEZ->compareTo (BigDecimal::ZERO()) == 1) {
				if($this->ZVBEZ->subtract ($this->FVBZ)->compareTo (BigDecimal::valueOf (102)) == -1) {
					$this->ANP= $this->ZVBEZ->subtract ($this->FVBZ)->setScale (0, BigDecimal::$ROUND_UP);
				} else {
					$this->ANP= BigDecimal::valueOf (102);
				}
			}
		} else {
			$this->FVBZ= BigDecimal::valueOf (0);
			$this->FVBZSO= BigDecimal::valueOf (0);
		}
		if($this->STKL < 6) {
			if($this->ZRE4->compareTo($this->ZVBEZ) == 1) {
				if($this->ZRE4->subtract($this->ZVBEZ)->compareTo(self::$ZAHL1000) == -1) {
					$this->ANP = $this->ANP->add($this->ZRE4)->subtract($this->ZVBEZ)->setScale(0,BigDecimal::$ROUND_UP);
				} else {
					$this->ANP = $this->ANP->add(self::$ZAHL1000);
				}
			}
		}
		$this->KZTAB= 1;
		if($this->STKL == 1) {
			$this->SAP= BigDecimal::valueOf (36);
			$this->KFB= $this->ZKF->multiply (BigDecimal::valueOf (7008))->setScale (0, BigDecimal::$ROUND_DOWN);
		} else {
			if($this->STKL == 2) {
				$this->EFA= BigDecimal::valueOf (1308);
				$this->SAP= BigDecimal::valueOf (36);
				$this->KFB= $this->ZKF->multiply (BigDecimal::valueOf (7008))->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->STKL == 3) {
					$this->KZTAB= 2;
					$this->SAP= BigDecimal::valueOf (36);
					$this->KFB= $this->ZKF->multiply (BigDecimal::valueOf (7008))->setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					if($this->STKL == 4) {
						$this->SAP= BigDecimal::valueOf (36);
						$this->KFB= $this->ZKF->multiply (BigDecimal::valueOf (3504))->setScale (0, BigDecimal::$ROUND_DOWN);
					} else {
						if($this->STKL == 5) {
							$this->SAP= BigDecimal::valueOf (36);
							$this->KFB= BigDecimal::ZERO();
						} else {
							$this->KFB= BigDecimal::ZERO();
						}
					}
				}
			}
		}
		$this->ZTABFB= $this->EFA->add ($this->ANP)->add ($this->SAP)->add ($this->FVBZ)->setScale (2, BigDecimal::$ROUND_DOWN);
	}

	/** Ermittlung Jahreslohnsteuer, PAP Seite 18 */
	protected function MLSTJAHR() {

		$this->UPEVP();
		if($this->KENNVMT != 1) {
			$this->ZVE= $this->ZRE4->subtract ($this->ZTABFB)->subtract ($this->VSP)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->UPMLST();
		} else {
			$this->ZVE= $this->ZRE4->subtract ($this->ZTABFB)->subtract ($this->VSP)->subtract ($this->VMT)->divide (self::$ZAHL100)->subtract ($this->VKAPA)->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
			if($this->ZVE->compareTo (BigDecimal::ZERO()) == -1) {
				 $this->ZVE = $this->ZVE->add($this->VMT->divide(self::$ZAHL100))->add($this->VKAPA->divide(self::$ZAHL100))->divide(self::$ZAHL5)->setScale(2,BigDecimal::$ROUND_DOWN);
				$this->UPMLST();
				$this->ST= $this->ST->multiply (self::$ZAHL5)->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				$this->UPMLST();
				$this->STOVMT= $this->ST;
				$this->ZVE= $this->ZVE->add($this->VMT->add ($this->VKAPA))->divide (self::$ZAHL500)->setScale (2, BigDecimal::$ROUND_DOWN);
				$this->UPMLST();
				$this->ST= $this->ST->subtract ($this->STOVMT)->multiply (self::$ZAHL5)->add ($this->STOVMT)->setScale (0, BigDecimal::$ROUND_DOWN);
			}
		}
	}

	protected function UPVKVLZZ() {

		$this->UPVKV();
		$this->JW = $this->VKV;
		$this->UPANTEIL();
		$this->VKVLZZ = $this->ANTEIL1;
	}

	protected function UPVKV() {

		if($this->PKV > 0) {
			if($this->VSP2->compareTo($this->VSP3) == 1) {
				$this->VKV = $this->VSP2->multiply(self::$ZAHL100);
			} else {
				$this->VKV = $this->VSP3->multiply(self::$ZAHL100);
			}
		} else {
			$this->VKV = BigDecimal::ZERO();
		}
	}

	protected function UPLSTLZZ() {

		$this->JW = $this->LSTJAHR->multiply(self::$ZAHL100);
		$this->UPANTEIL();
		$this->LSTLZZ = $this->ANTEIL1;
	}

	/** PAP Seite 20 Ermittlung der Jahreslohnsteuer aus dem Einkommensteuertarif */
	protected function UPMLST() {

		if($this->ZVE->compareTo (self::$ZAHL1) == -1) {
			$this->ZVE= BigDecimal::ZERO();
			$this->X= BigDecimal::ZERO();
		} else {
			$this->X= $this->ZVE->divide (BigDecimal::valueOf($this->KZTAB))->setScale (0, BigDecimal::$ROUND_DOWN);
		}
		if($this->STKL < 5) {
			$this->UPTAB14();/** Neu 2014 */
		} else {
			$this->MST5_6();
		}
	}

	/** Vorsorgepauschale (§ 39b Absatz 2 Satz 5 Nummer 3 und Absatz 4 EStG)<br>
  			Achtung: Es wird davon ausgegangen, dass	<br>
  				a) Es wird davon ausge-gangen, dassa) für die BBG (Ost) 60.000 Euro und für die BBG (West) 71.400 Euro festgelegt wird sowie<br>
  				b) der Beitragssatz zur Rentenversicherung auf 18,9 % gesenkt wird.<br>
  			<br>
  			PAP Seite 21 */
	/** Neu 2014 */
	protected function UPEVP() {

		if($this->KRV > 1) {
			$this->VSP1= BigDecimal::ZERO();
		} else {
			if($this->KRV == 0) {/** Neuer Wert 2014 */
				if($this->ZRE4VP->compareTo(self::$RENTBEMESSUNGSGR_WEST) == 1) {
					$this->ZRE4VP = self::$RENTBEMESSUNGSGR_WEST;
				}
			} else {/** Neuer Wert 2014 */
				if($this->ZRE4VP->compareTo(self::$RENTBEMESSUNGSGR_OST) == 1) {
					$this->ZRE4VP = self::$RENTBEMESSUNGSGR_OST;
				}
			}/** Neuer Wert 2014 */
			$this->VSP1 = $this->ZRE4VP->multiply(BigDecimal::valueOf(0.56))->setScale(2,BigDecimal::$ROUND_DOWN);
			$this->VSP1 = $this->VSP1->multiply(BigDecimal::valueOf(0.0945))->setScale(2,BigDecimal::$ROUND_DOWN);
		}
		$this->VSP2 = $this->ZRE4VP->multiply(BigDecimal::valueOf(0.12))->setScale(2,BigDecimal::$ROUND_DOWN);
		if($this->STKL == 3) {
			$this->VHB = BigDecimal::valueOf(3000);
		} else {
			$this->VHB = BigDecimal::valueOf(1900);
		}
		if($this->VSP2->compareTo ($this->VHB) == 1) {
			$this->VSP2= $this->VHB;
		}
		$this->VSPN= $this->VSP1->add ($this->VSP2)->setScale (0, BigDecimal::$ROUND_UP);
		$this->MVSP();
		if($this->VSPN->compareTo ($this->VSP) == 1) {
			$this->VSP= $this->VSPN->setScale (2, BigDecimal::$ROUND_DOWN);
		}
	}

	/** Vorsorgepauschale (§39b Abs. 2 Satz 5 Nr 3 EStG) Vergleichsberechnung fuer Guenstigerpruefung, PAP Seite 22 */
	/** Neu 2014 */
	protected function MVSP() {
/** Neuer Wert 2014 */
		if($this->ZRE4VP->compareTo( BigDecimal::valueOf(48600) ) == 1) {/** Neuer Wert 2014 */
			$this->ZRE4VP = BigDecimal::valueOf(48600);
		}
		if($this->PKV > 0) {
			if($this->STKL == 6) {
				$this->VSP3 = BigDecimal::ZERO();
			} else {
				$this->VSP3 = $this->PKPV->multiply(self::$ZAHL12)->divide(self::$ZAHL100);
				if($this->PKV == 2) {
					$this->KVSATZAG = BigDecimal::valueOf(0.07)->setScale(5);
					if($this->PVS == 1) {
						$this->PVSATZAG = BigDecimal::valueOf(0.00525)->setScale(5);
					} else {
						$this->PVSATZAG = BigDecimal::valueOf(0.01025)->setScale(5);
					}
					$this->VSP3 = $this->VSP3->subtract($this->ZRE4VP->multiply($this->KVSATZAG->add($this->PVSATZAG)))->setScale(2, BigDecimal::$ROUND_DOWN);
				}
			}
		} else {
			$this->KVSATZAN = BigDecimal::valueOf(0.079)->setScale(5);
			if($this->PVS == 1) {
				$this->PVSATZAN = BigDecimal::valueOf(0.01525)->setScale(5);
			} else {
				$this->PVSATZAN = BigDecimal::valueOf(0.01025)->setScale(5);
			}
			if($this->PVZ == 1) {
				$this->PVSATZAN = $this->PVSATZAN->add(BigDecimal::valueOf(0.0025));
			}
			$this->VSP3 = $this->ZRE4VP->multiply($this->KVSATZAN->add($this->PVSATZAN))->setScale(2, BigDecimal::$ROUND_DOWN);
		}
		$this->VSP = $this->VSP3->add($this->VSP1)->setScale(0, BigDecimal::$ROUND_UP);
	}

	protected function UMVSP() {

		$this->VSPVOR = $this->VSPVOR->subtract($this->ZRE4VP->multiply(BigDecimal::valueOf(0.16)))->setScale(2, BigDecimal::$ROUND_DOWN);
		if($this->VSPVOR->compareTo(BigDecimal::ZERO()) == -1) {
			$this->VSPVOR = BigDecimal::ZERO();
		}
		if($this->VSPO->compareTo($this->VSPVOR) == 1) {
			$this->VSP = $this->VSPVOR;
			$this->VSPREST = $this->VSPO->subtract($this->VSPVOR);
			if($this->VSPREST->compareTo($this->VSPMAX1) == 1) {
				$this->VSP = $this->VSP->add($this->VSPMAX1);
				$this->VSPREST = $this->VSPREST->subtract($this->VSPMAX1)->divide(self::$ZAHL2, 2,BigDecimal::$ROUND_UP);
				if($this->VSPREST->compareTo($this->VSPMAX2) == 1) {
					$this->VSP = $this->VSP->add($this->VSPMAX2)->setScale(0,BigDecimal::$ROUND_DOWN);
				} else {
					$this->VSP = $this->VSP->add($this->VSPREST)->setScale(0,BigDecimal::$ROUND_DOWN);
				}
			} else {
				$this->VSP = $this->VSP->add($this->VSPREST)->setScale(0, BigDecimal::$ROUND_DOWN);
			}
		} else {
			$this->VSP = $this->VSPO->setScale(0, BigDecimal::$ROUND_DOWN);
		}
	}

	/** Lohnsteuer fuer die Steuerklassen V und VI (§ 39b Abs. 2 Satz 7 EStG), PAP Seite 23 */
	/** Neu 2014 */
	protected function MST5_6() {

		$this->ZZX= $this->X;
		if($this->ZZX->compareTo (BigDecimal::valueOf (26441)) == 1) {
			$this->ZX= BigDecimal::valueOf (26441);
			$this->UP5_6();
			if($this->ZZX->compareTo (BigDecimal::valueOf (200584)) == 1) {
				$this->ST= $this->ST->add (BigDecimal::valueOf (200584)->subtract (BigDecimal::valueOf (26441)))->multiply (BigDecimal::valueOf (0.42))->setScale (0, BigDecimal::$ROUND_DOWN);
				$this->ST= $this->ST->add ($this->ZZX->subtract (BigDecimal::valueOf (200584)))->multiply (BigDecimal::valueOf (0.45))->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				$this->ST= $this->ST->add ($this->ZZX->subtract (BigDecimal::valueOf (26441)))->multiply (BigDecimal::valueOf (0.42))->setScale (0, BigDecimal::$ROUND_DOWN);
			}
		} else {
			$this->ZX= $this->ZZX;
			$this->UP5_6();
			if($this->ZZX->compareTo (BigDecimal::valueOf (9763)) == 1) /** Neuer Wert 2014 */{
				$this->VERGL= $this->ST;
				$this->ZX= BigDecimal::valueOf (9763);/** Neuer Wert 2014 */
				$this->UP5_6();
				$this->HOCH= $this->ST->add ($this->ZZX->subtract (BigDecimal::valueOf (9763)))->multiply (BigDecimal::valueOf (0.42))->setScale (0, BigDecimal::$ROUND_DOWN);/** Neuer Wert 2014 */
				if($this->HOCH->compareTo ($this->VERGL) == -1) {
					$this->ST= $this->HOCH;
				} else {
					$this->ST= $this->VERGL;
				}
			}
		}
	}

	/** Unterprogramm zur Lohnsteuer fuer die Steuerklassen V und VI (§ 39b Abs. 2 Satz 7 EStG), PAP Seite 24 */
	protected function UP5_6() {

		$this->X= $this->ZX->multiply (BigDecimal::valueOf (1.25))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->UPTAB14();/** Neu 2014 */
		$this->ST1= $this->ST;
		$this->X= $this->ZX->multiply (BigDecimal::valueOf (0.75))->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->UPTAB14();/** Neu 2014 */
		$this->ST2= $this->ST;
		$this->DIFF= $this->ST1->subtract ($this->ST2)->multiply (self::$ZAHL2);
		$this->MIST= $this->ZX->multiply (BigDecimal::valueOf (0.14))->setScale (0, BigDecimal::$ROUND_DOWN);
		if($this->MIST->compareTo ($this->DIFF) == 1) {
			$this->ST= $this->MIST;
		} else {
			$this->ST= $this->DIFF;
		}
	}

	/** Solidaritaetszuschlag, PAP Seite 25 */
	protected function MSOLZ() {

		$this->SOLZFREI= BigDecimal::valueOf (972 * $this->KZTAB);
		if($this->JBMG->compareTo ($this->SOLZFREI) == 1) {
			$this->SOLZJ= $this->JBMG->multiply (BigDecimal::valueOf (5.5))->divide(self::$ZAHL100)->setScale(2, BigDecimal::$ROUND_DOWN);
			$this->SOLZMIN= $this->JBMG->subtract ($this->SOLZFREI)->multiply (BigDecimal::valueOf (20))->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
			if($this->SOLZMIN->compareTo ($this->SOLZJ) == -1) {
				$this->SOLZJ= $this->SOLZMIN;
			}
			$this->JW= $this->SOLZJ->multiply (self::$ZAHL100)->setScale (0, BigDecimal::$ROUND_DOWN);
			$this->UPANTEIL();
			$this->SOLZLZZ= $this->ANTEIL1;
		} else {
			$this->SOLZLZZ= BigDecimal::ZERO();
		}
		if($this->R > 0) {
			$this->JW= $this->JBMG->multiply (self::$ZAHL100);
			$this->UPANTEIL();
			$this->BK= $this->ANTEIL1;
		} else {
			$this->BK= BigDecimal::ZERO();
		}
	}

	/** Anteil von Jahresbetraegen fuer einen LZZ (§ 39b Abs. 2 Satz 9 EStG), PAP Seite 26 */
	protected function UPANTEIL() {

		if($this->LZZ == 1) {
			$this->ANTEIL1= $this->JW;
		} else {
			if($this->LZZ == 2) {
				$this->ANTEIL1= $this->JW->divide (self::$ZAHL12, 0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->LZZ == 3) {
					$this->ANTEIL1= $this->JW->multiply (self::$ZAHL7)->divide (self::$ZAHL360, 0, BigDecimal::$ROUND_DOWN);
				} else {
					$this->ANTEIL1= $this->JW->divide (self::$ZAHL360, 0, BigDecimal::$ROUND_DOWN);
				}
			}
		}
	}

	/** Berechnung sonstiger Bezuege nach § 39b Abs. 3 Saetze 1 bis 8 EStG), PAP Seite 27 */
	protected function MSONST() {

		$this->LZZ= 1;
		if($this->ZMVB == 0) {
			$this->ZMVB= 12;
		}
		if($this->SONSTB->compareTo (BigDecimal::ZERO()) == 0) {
			$this->VKVSONST= BigDecimal::ZERO();
			$this->LSTSO= BigDecimal::ZERO();
			$this->STS= BigDecimal::ZERO();
			$this->SOLZS= BigDecimal::ZERO();
			$this->BKS= BigDecimal::ZERO();
		} else {
			$this->MOSONST();
			$this->UPVKV();
			$this->VKVSONST = $this->VKV;
			$this->ZRE4J= $this->JRE4->add ($this->SONSTB)->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZJ= $this->JVBEZ->add ($this->VBS)->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->VBEZBSO= $this->STERBE;
			$this->MRE4SONST();
			$this->MLSTJAHR();
			$this->UPVKV();
			$this->VKVSONST = $this->VKV->subtract($this->VKVSONST);
			$this->LSTSO= $this->ST->multiply (self::$ZAHL100);/** lt. PAP muss hier auf ganze EUR aufgerundet werden, <br>
        			allerdings muss der Wert in Cent vorgehalten werden,<br>
        			deshalb nach dem Aufrunden auf ganze EUR durch 'divide(ZAHL100, 0, BigDecimal.ROUND_DOWN)'<br>
        			wieder die Multiplikation mit 100 */
			$this->STS = $this->LSTSO->subtract($this->LSTOSO)->multiply(BigDecimal::valueOf($this->f))->divide(self::$ZAHL100, 0, BigDecimal::$ROUND_DOWN)->multiply(self::$ZAHL100);
			if($this->STS->compareTo (BigDecimal::ZERO()) == -1) {
				$this->STS= BigDecimal::ZERO();
			}
			$this->SOLZS= $this->STS->multiply (BigDecimal::valueOf (5.5))->divide (self::$ZAHL100, 0, BigDecimal::$ROUND_DOWN);
			if($this->R > 0) {
				$this->BKS= $this->STS;
			} else {
				$this->BKS= BigDecimal::ZERO();
			}
		}
	}

	/** Berechnung der Verguetung fuer mehrjaehrige Taetigkeit nach § 39b Abs. 3 Satz 9 und 10 EStG), PAP Seite 28 */
	protected function MVMT() {

		if($this->VKAPA->compareTo (BigDecimal::ZERO()) == -1) {
			$this->VKAPA= BigDecimal::ZERO();
		}
		if($this->VMT->add ($this->VKAPA)->compareTo (BigDecimal::ZERO()) == 1) {
			if($this->LSTSO->compareTo (BigDecimal::ZERO()) == 0) {
				$this->MOSONST();
				$this->LST1= $this->LSTOSO;
			} else {
				$this->LST1= $this->LSTSO;
			}
			$this->VBEZBSO= $this->STERBE->add ($this->VKAPA);
			$this->ZRE4J= $this->JRE4->add ($this->SONSTB)->add ($this->VMT)->add ($this->VKAPA)->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->ZVBEZJ= $this->JVBEZ->add ($this->VBS)->add ($this->VKAPA)->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
			$this->KENNVMT = 2;
			$this->MRE4SONST();
			$this->MLSTJAHR();
			$this->LST3= $this->ST->multiply (self::$ZAHL100);
			$this->MRE4ABZ();
			$this->ZRE4VP = $this->ZRE4VP->subtract($this->JRE4ENT->divide(self::$ZAHL100))->subtract($this->SONSTENT->divide(self::$ZAHL100));
			$this->KENNVMT= 1;
			$this->MLSTJAHR();
			$this->LST2= $this->ST->multiply (self::$ZAHL100);
			$this->STV= $this->LST2->subtract ($this->LST1);
			$this->LST3= $this->LST3->subtract ($this->LST1);
			if($this->LST3->compareTo ($this->STV) == -1) {
				$this->STV= $this->LST3;
			}
			if($this->STV->compareTo (BigDecimal::ZERO()) == -1) {
				$this->STV= BigDecimal::ZERO();
			} else {/** lt. PAP muss hier auf ganze EUR abgerundet werden.<br>
   	        	Allerdings muss auch hier der Wert in Cent vorgehalten werden,<br>
        			weshalb nach dem Aufrunden auf ganze EUR durch 'divide(ZAHL100, 0, BigDecimal.ROUND_DOWN)'<br>
        			wieder die Multiplikation mit 100 erfolgt. */
				$this->STV = $this->STV->multiply(BigDecimal::valueOf($this->f))->divide(self::$ZAHL100, 0, BigDecimal::$ROUND_DOWN)->multiply(self::$ZAHL100);
			}
			$this->SOLZV= $this->STV->multiply (BigDecimal::valueOf (5.5))->divide (self::$ZAHL100)->setScale (0, BigDecimal::$ROUND_DOWN);
			if($this->R > 0) {
				$this->BKV= $this->STV;
			} else {
				$this->BKV= BigDecimal::ZERO();
			}
		} else {
			$this->STV= BigDecimal::ZERO();
			$this->SOLZV= BigDecimal::ZERO();
			$this->BKV= BigDecimal::ZERO();
		}
	}

	/** Sonderberechnung ohne sonstige Bezüge für Berechnung bei sonstigen Bezügen oder Vergütung für mehrjährige Tätigkeit, PAP Seite 29 */
	protected function MOSONST() {

		$this->ZRE4J= $this->JRE4->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->ZVBEZJ= $this->JVBEZ->divide (self::$ZAHL100)->setScale (2, BigDecimal::$ROUND_DOWN);
		$this->JLFREIB= $this->JFREIB->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
		$this->JLHINZU= $this->JHINZU->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
		$this->MRE4();
		$this->MRE4ABZ();
		$this->ZRE4VP = $this->ZRE4VP->subtract($this->JRE4ENT->divide(self::$ZAHL100));
		$this->MZTABFB();
		$this->MLSTJAHR();
		$this->LSTOSO= $this->ST->multiply (self::$ZAHL100);
	}

	/** Sonderberechnung mit sonstige Bezüge für Berechnung bei sonstigen Bezügen oder Vergütung für mehrjährige Tätigkeit, PAP Seite 29 */
	protected function MRE4SONST() {

		$this->MRE4();
		$this->FVB= $this->FVBSO;
		$this->MRE4ABZ();
		$this->ZRE4VP = $this->ZRE4VP->subtract($this->JRE4ENT->divide(self::$ZAHL100))->subtract($this->SONSTENT->divide(self::$ZAHL100));
		$this->FVBZ= $this->FVBZSO;
		$this->MZTABFB();
	}

	/** Tarifliche Einkommensteuer §32a EStG, PAP Seite 30 */
	/** Neu 2014 */
	protected function UPTAB14() {

		if($this->X->compareTo (BigDecimal::valueOf (8355)) == -1) /** Neuer Wert 2014 */{
			$this->ST= BigDecimal::ZERO();
		} else {
			if($this->X->compareTo (BigDecimal::valueOf (13470)) == -1) {
				$this->Y= $this->X->subtract (BigDecimal::valueOf (8354))->divide (BigDecimal::valueOf (10000), 6, BigDecimal::$ROUND_DOWN);/** Neuer Wert 2014 */
				$this->RW= $this->Y->multiply (BigDecimal::valueOf (974.58));/** Neuer Wert 2014 */
				$this->RW= $this->RW->add (BigDecimal::valueOf (1400));
				$this->ST= $this->RW->multiply ($this->Y)->setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				if($this->X->compareTo (BigDecimal::valueOf (52882)) == -1) {
					$this->Y= $this->X->subtract (BigDecimal::valueOf (13469))->divide (BigDecimal::valueOf (10000), 6, BigDecimal::$ROUND_DOWN);
					$this->RW= $this->Y->multiply (BigDecimal::valueOf (228.74));
					$this->RW= $this->RW->add (BigDecimal::valueOf (2397));
					$this->RW= $this->RW->multiply ($this->Y);
					$this->ST= $this->RW->add (BigDecimal::valueOf (971))->setScale (0, BigDecimal::$ROUND_DOWN);/** Neuer Wert 2014 */
				} else {
					if($this->X->compareTo (BigDecimal::valueOf (250731)) == -1) {/** Neuer Wert 2014 */
						$this->ST= $this->X->multiply (BigDecimal::valueOf (0.42))->subtract (BigDecimal::valueOf (8239))->setScale (0, BigDecimal::$ROUND_DOWN);
					} else {/** Neuer Wert 2014 */
						$this->ST= $this->X->multiply (BigDecimal::valueOf (0.45))->subtract (BigDecimal::valueOf (15761))->setScale (0, BigDecimal::$ROUND_DOWN);
					}
				}
			}
		}
		$this->ST= $this->ST->multiply (BigDecimal::valueOf ($this->KZTAB));
	}

}