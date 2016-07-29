<?php

namespace Services;

/**
 * Klasse Lohnsteuer2010
 * 
 * @author Christian Delfs
 */

class Lohnsteuer2010 implements LohnsteuerInterface {

	/** Stand: 2015-11-16 */
	/** ZIVIT D�sseldorf */

	/* EINGABEPARAMETER*/

	protected $AF = 0;
	protected $AJAHR = 0;
	protected $ALTER1 = 0;
	protected $ENTSCH = new BigDecimal(0);
	protected $F = 0;
	protected $JFREIB = new BigDecimal(0);
	protected $JHINZU = new BigDecimal(0);
	protected $JRE4 = new BigDecimal(0);
	protected $JVBEZ = new BigDecimal(0);
	protected $KRV = 0;
	protected $LZZ = 0;
	protected $LZZFREIB = new BigDecimal(0);
	protected $LZZHINZU = new BigDecimal(0);
	protected $PKPV = new BigDecimal(0);
	protected $PKV = 0;
	protected $PVS = 0;
	protected $PVZ = 0;
	protected $R = 0;
	protected $RE4 = new BigDecimal(0);
	protected $SONSTB = new BigDecimal(0);
	protected $STERBE = new BigDecimal(0);
	protected $STKL = 0;
	protected $VBEZ = new BigDecimal(0);
	protected $VBEZM = new BigDecimal(0);
	protected $VBEZS = new BigDecimal(0);
	protected $VBS = new BigDecimal(0);
	protected $VJAHR = 0;
	protected $VKAPA = new BigDecimal(0);
	protected $VMT = new BigDecimal(0);
	protected $ZKF = new BigDecimal(0);
	protected $ZMVB = 0;

	/* AUSGABEPARAMETER*/

	protected $BK = new BigDecimal(0);
	protected $BKS = new BigDecimal(0);
	protected $BKV = new BigDecimal(0);
	protected $LSTLZZ = new BigDecimal(0);
	protected $SOLZLZZ = new BigDecimal(0);
	protected $SOLZS = new BigDecimal(0);
	protected $SOLZV = new BigDecimal(0);
	protected $STS = new BigDecimal(0);
	protected $STV = new BigDecimal(0);

	/* INTERNE FELDER*/

	/** Altersentlastungsbetrag nach Alterseink�nftegesetz in �,<br>
             Cent (2 Dezimalstellen) */
	protected $ALTE = new BigDecimal(0);

	/** Arbeitnehmer-Pauschbetrag in EURO */
	protected $ANP = new BigDecimal(0);

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents abgerundet */
	protected $ANTEIL1 = new BigDecimal(0);

	/** Auf den Lohnzahlungszeitraum entfallender Anteil von Jahreswerten<br>
             auf ganze Cents aufgerundet */
	protected $ANTEIL2 = new BigDecimal(0);

	/** Bemessungsgrundlage f�r Altersentlastungsbetrag in �, Cent<br>
             (2 Dezimalstellen) */
	protected $BMG = new BigDecimal(0);

	/** Differenz zwischen ST1 und ST2 in EURO */
	protected $DIFF = new BigDecimal(0);

	/** Entlastungsbetrag fuer Alleinerziehende in EURO */
	protected $EFA = new BigDecimal(0);

	/** Versorgungsfreibetrag in �, Cent (2 Dezimalstellen) */
	protected $FVB = new BigDecimal(0);

	/** Versorgungsfreibetrag in �, Cent (2 Dezimalstellen) f�r die Berechnung<br>
             der Lohnsteuer f�r den sonstigen Bezug */
	protected $FVBSO = new BigDecimal(0);

	/** Zuschlag zum Versorgungsfreibetrag in EURO */
	protected $FVBZ = new BigDecimal(0);

	/** Zuschlag zum Versorgungsfreibetrag in EURO fuer die Berechnung<br>
             der Lohnsteuer beim sonstigen Bezug */
	protected $FVBZSO = new BigDecimal(0);

	/** Maximaler Altersentlastungsbetrag in � */
	protected $HBALTE = new BigDecimal(0);

	/** Massgeblicher maximaler Versorgungsfreibetrag in � */
	protected $HFVB = new BigDecimal(0);

	/** Massgeblicher maximaler Zuschlag zum Versorgungsfreibetrag in �,Cent<br>
             (2 Dezimalstellen) */
	protected $HFVBZ = new BigDecimal(0);

	/** Massgeblicher maximaler Zuschlag zum Versorgungsfreibetrag in �, Cent<br>
             (2 Dezimalstellen) f�r die Berechnung der Lohnsteuer f�r den<br>
             sonstigen Bezug */
	protected $HFVBZSO = new BigDecimal(0);

	/** Nummer der Tabellenwerte fuer Versorgungsparameter */
	protected $J = 0;

	/** Jahressteuer nach � 51a EStG, aus der Solidaritaetszuschlag und<br>
             Bemessungsgrundlage fuer die Kirchenlohnsteuer ermittelt werden in EURO */
	protected $JBMG = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechneter LZZFREIB in �, Cent<br>
             (2 Dezimalstellen) */
	protected $JLFREIB = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechnete LZZHINZU in �, Cent<br>
             (2 Dezimalstellen) */
	protected $JLHINZU = new BigDecimal(0);

	/** Jahreswert, dessen Anteil fuer einen Lohnzahlungszeitraum in<br>
             UPANTEIL errechnet werden soll in Cents */
	protected $JW = new BigDecimal(0);

	/** Nummer der Tabellenwerte fuer Parameter bei Altersentlastungsbetrag */
	protected $K = 0;

	/** Merker f�r Berechnung Lohnsteuer f�r mehrj�hrige T�tigkeit.<br>
			 0 = normale Steuerberechnung<br>
			 1 = Steuerberechnung f�r mehrj�hrige T�tigkeit<br>
			 2 = entf�llt */
	protected $KENNVMT = 0;

	/** Summe der Freibetraege fuer Kinder in EURO */
	protected $KFB = new BigDecimal(0);

	/** Beitragssatz des Arbeitgebers zur Krankenversicherung (5 Dezimalstellen) */
	protected $KVSATZAG = new BigDecimal(0).setScale(5);

	/** Beitragssatz des Arbeitnehmers zur Krankenversicherung (5 Dezimalstellen) */
	protected $KVSATZAN = new BigDecimal(0).setScale(5);

	/** Kennzahl fuer die Einkommensteuer-Tabellenart:<br>
             1 = Grundtabelle<br>
             2 = Splittingtabelle */
	protected $KZTAB = 0;

	/** Jahreslohnsteuer in EURO */
	protected $LSTJAHR = new BigDecimal(0);

	/** Zwischenfelder der Jahreslohnsteuer in Cent */
	protected $LST1 = new BigDecimal(0);
	protected $LST2 = new BigDecimal(0);
	protected $LST3 = new BigDecimal(0);
	protected $LSTOSO = new BigDecimal(0);
	protected $LSTSO = new BigDecimal(0);

	/** Mindeststeuer fuer die Steuerklassen V und VI in EURO */
	protected $MIST = new BigDecimal(0);

	/** Beitragssatz des Arbeitgebers zur Pflegeversicherung (5 Dezimalstellen) */
	protected $PVSATZAG = new BigDecimal(0).setScale(5);

	/** Beitragssatz des Arbeitnehmers zur Pflegeversicherung (5 Dezimalstellen) */
	protected $PVSATZAN = new BigDecimal(0).setScale(5);

	/** Rechenwert in Gleitkommadarstellung */
	protected $RW = new BigDecimal(0);

	/** Sonderausgaben-Pauschbetrag in EURO */
	protected $SAP = new BigDecimal(0);

	/** Freigrenze fuer den Solidaritaetszuschlag in EURO */
	protected $SOLZFREI = new BigDecimal(0);

	/** Solidaritaetszuschlag auf die Jahreslohnsteuer in EURO, C (2 Dezimalstellen) */
	protected $SOLZJ = new BigDecimal(0);

	/** Zwischenwert fuer den Solidaritaetszuschlag auf die Jahreslohnsteuer<br>
             in EURO, C (2 Dezimalstellen) */
	protected $SOLZMIN = new BigDecimal(0);

	/** Tarifliche Einkommensteuer in EURO */
	protected $ST = new BigDecimal(0);

	/** Tarifliche Einkommensteuer auf das 1,25-fache ZX in EURO */
	protected $ST1 = new BigDecimal(0);

	/** Tarifliche Einkommensteuer auf das 0,75-fache ZX in EURO */
	protected $ST2 = new BigDecimal(0);

	/** Zwischenfeld zur Ermittlung der Steuer auf Verg�tungen f�r mehrj�hrige T�tigkeit */
	protected $STOVMT = new BigDecimal(0);

	/** Bemessungsgrundlage fuer den Versorgungsfreibetrag in Cents */
	protected $VBEZB = new BigDecimal(0);

	/** Bemessungsgrundlage f�r den Versorgungsfreibetrag in Cent f�r<br>
             den sonstigen Bezug */
	protected $VBEZBSO = new BigDecimal(0);

	/** Hoechstbetrag der Vorsorgepauschale nach Alterseinkuenftegesetz in EURO, C */
	protected $VHB = new BigDecimal(0);

	/** Vorsorgepauschale in EURO, C (2 Dezimalstellen) */
	protected $VSP = new BigDecimal(0);

	/** Vorsorgepauschale nach Alterseinkuenftegesetz in EURO, C */
	protected $VSPN = new BigDecimal(0);

	/** Zwischenwert 1 bei der Berechnung der Vorsorgepauschale nach<br>
             dem Alterseinkuenftegesetz in EURO, C (2 Dezimalstellen) */
	protected $VSP1 = new BigDecimal(0);

	/** Zwischenwert 2 bei der Berechnung der Vorsorgepauschale nach<br>
             dem Alterseinkuenftegesetz in EURO, C (2 Dezimalstellen) */
	protected $VSP2 = new BigDecimal(0);

	/** Hoechstbetrag der Vorsorgepauschale nach � 10c Abs. 3 EStG in EURO */
	protected $VSPKURZ = new BigDecimal(0);

	/** Hoechstbetrag der Vorsorgepauschale nach � 10c Abs. 2 Nr. 2 EStG in EURO */
	protected $VSPMAX1 = new BigDecimal(0);

	/** Hoechstbetrag der Vorsorgepauschale nach � 10c Abs. 2 Nr. 3 EStG in EURO */
	protected $VSPMAX2 = new BigDecimal(0);

	/** Vorsorgepauschale nach � 10c Abs. 2 Satz 2 EStG vor der Hoechstbetragsberechnung<br>
             in EURO, C (2 Dezimalstellen) */
	protected $VSPO = new BigDecimal(0);

	/** Fuer den Abzug nach � 10c Abs. 2 Nrn. 2 und 3 EStG verbleibender<br>
             Rest von VSPO in EURO, C (2 Dezimalstellen) */
	protected $VSPREST = new BigDecimal(0);

	/** Hoechstbetrag der Vorsorgepauschale nach � 10c Abs. 2 Nr. 1 EStG<br>
             in EURO, C (2 Dezimalstellen) */
	protected $VSPVOR = new BigDecimal(0);

	/** Zu versteuerndes Einkommen gem. � 32a Abs. 1 und 2 EStG �, C<br>
             (2 Dezimalstellen) */
	protected $X = new BigDecimal(0);

	/** gem. � 32a Abs. 1 EStG (6 Dezimalstellen) */
	protected $Y = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechnetes RE4 in �, C (2 Dezimalstellen)<br>
             nach Abzug der Freibetr�ge nach � 39 b Abs. 2 Satz 3 und 4. */
	protected $ZRE4 = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechnetes RE4 in �, C (2 Dezimalstellen) */
	protected $ZRE4J = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechnetes RE4 in �, C (2 Dezimalstellen)<br>
             nach Abzug des Versorgungsfreibetrags und des Alterentlastungsbetrags<br>
             zur Berechnung der Vorsorgepauschale in �, Cent (2 Dezimalstellen) */
	protected $ZRE4VP = new BigDecimal(0);

	/** Feste Tabellenfreibetr�ge (ohne Vorsorgepauschale) in �, Cent<br>
             (2 Dezimalstellen) */
	protected $ZTABFB = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechnetes (VBEZ abzueglich FVB) in<br>
             EURO, C (2 Dezimalstellen) */
	protected $ZVBEZ = new BigDecimal(0);

	/** Auf einen Jahreslohn hochgerechnetes VBEZ in �, C (2 Dezimalstellen) */
	protected $ZVBEZJ = new BigDecimal(0);

	/** Zu versteuerndes Einkommen in �, C (2 Dezimalstellen) */
	protected $ZVE = new BigDecimal(0);

	/** Zwischenfelder zu X fuer die Berechnung der Steuer nach � 39b<br>
             Abs. 2 Satz 7 EStG in � */
	protected $ZX = new BigDecimal(0);
	protected $ZZX = new BigDecimal(0);
	protected $HOCH = new BigDecimal(0);
	protected $VERGL = new BigDecimal(0);

	/* KONSTANTEN */

	/** Tabelle fuer die Vomhundertsaetze des Versorgungsfreibetrags */
	protected static final $TAB1 = array(BigDecimal::valueOf (0.0), BigDecimal::valueOf (0.4),                BigDecimal::valueOf (0.384), BigDecimal::valueOf (0.368),                BigDecimal::valueOf (0.352), BigDecimal::valueOf (0.336),                BigDecimal::valueOf (0.32), BigDecimal::valueOf (0.304),                BigDecimal::valueOf (0.288), BigDecimal::valueOf (0.272),                BigDecimal::valueOf (0.256), BigDecimal::valueOf (0.24),                BigDecimal::valueOf (0.224), BigDecimal::valueOf (0.208),                BigDecimal::valueOf (0.192), BigDecimal::valueOf (0.176),                BigDecimal::valueOf (0.16), BigDecimal::valueOf (0.152),                BigDecimal::valueOf (0.144), BigDecimal::valueOf (0.136),                BigDecimal::valueOf (0.128), BigDecimal::valueOf (0.12),                BigDecimal::valueOf (0.112), BigDecimal::valueOf (0.104),                BigDecimal::valueOf (0.096), BigDecimal::valueOf (0.088),                BigDecimal::valueOf (0.08), BigDecimal::valueOf (0.072),                BigDecimal::valueOf (0.064), BigDecimal::valueOf (0.056),                BigDecimal::valueOf (0.048), BigDecimal::valueOf (0.04),                BigDecimal::valueOf (0.032), BigDecimal::valueOf (0.024),                BigDecimal::valueOf (0.016), BigDecimal::valueOf (0.008),                BigDecimal::valueOf (0.0));

	/** Tabelle fuer die Hoechstbetrage des Versorgungsfreibetrags */
	protected static final $TAB2 = array(BigDecimal::valueOf (0), BigDecimal::valueOf (3000),                  BigDecimal::valueOf (2880), BigDecimal::valueOf (2760),                  BigDecimal::valueOf (2640), BigDecimal::valueOf (2520),                  BigDecimal::valueOf (2400), BigDecimal::valueOf (2280),                  BigDecimal::valueOf (2160), BigDecimal::valueOf (2040),                  BigDecimal::valueOf (1920), BigDecimal::valueOf (1800),                  BigDecimal::valueOf (1680), BigDecimal::valueOf (1560),                  BigDecimal::valueOf (1440), BigDecimal::valueOf (1320),                  BigDecimal::valueOf (1200), BigDecimal::valueOf (1140),                  BigDecimal::valueOf (1080), BigDecimal::valueOf (1020),                  BigDecimal::valueOf (960), BigDecimal::valueOf (900),                  BigDecimal::valueOf (840), BigDecimal::valueOf (780),                  BigDecimal::valueOf (720), BigDecimal::valueOf (660),                  BigDecimal::valueOf (600), BigDecimal::valueOf (540),                  BigDecimal::valueOf (480), BigDecimal::valueOf (420),                  BigDecimal::valueOf (360), BigDecimal::valueOf (300),                  BigDecimal::valueOf (240), BigDecimal::valueOf (180),                  BigDecimal::valueOf (120), BigDecimal::valueOf (60),                  BigDecimal::valueOf (0));

	/** Tabelle fuer die Zuschlaege zum Versorgungsfreibetrag */
	protected static final $TAB3 = array(BigDecimal::valueOf (0), BigDecimal::valueOf (900),                  BigDecimal::valueOf (864), BigDecimal::valueOf (828),                  BigDecimal::valueOf (792), BigDecimal::valueOf (756),                  BigDecimal::valueOf (720), BigDecimal::valueOf (684),                  BigDecimal::valueOf (648), BigDecimal::valueOf (612),                  BigDecimal::valueOf (576), BigDecimal::valueOf (540),                  BigDecimal::valueOf (504), BigDecimal::valueOf (468),                  BigDecimal::valueOf (432), BigDecimal::valueOf (396),                  BigDecimal::valueOf (360), BigDecimal::valueOf (342),                  BigDecimal::valueOf (324), BigDecimal::valueOf (306),                  BigDecimal::valueOf (288), BigDecimal::valueOf (270),                  BigDecimal::valueOf (252), BigDecimal::valueOf (234),                  BigDecimal::valueOf (216), BigDecimal::valueOf (198),                  BigDecimal::valueOf (180), BigDecimal::valueOf (162),                  BigDecimal::valueOf (144), BigDecimal::valueOf (126),                  BigDecimal::valueOf (108), BigDecimal::valueOf (90),                  BigDecimal::valueOf (72), BigDecimal::valueOf (54),                  BigDecimal::valueOf (36), BigDecimal::valueOf (18),                  BigDecimal::valueOf (0));

	/** Tabelle fuer die Vomhundertsaetze des Altersentlastungsbetrags */
	protected static final $TAB4 = array(BigDecimal::valueOf (0.0), BigDecimal::valueOf (0.4),                  BigDecimal::valueOf (0.384), BigDecimal::valueOf (0.368),                  BigDecimal::valueOf (0.352), BigDecimal::valueOf (0.336),                  BigDecimal::valueOf (0.32), BigDecimal::valueOf (0.304),                  BigDecimal::valueOf (0.288), BigDecimal::valueOf (0.272),                  BigDecimal::valueOf (0.256), BigDecimal::valueOf (0.24),                  BigDecimal::valueOf (0.224), BigDecimal::valueOf (0.208),                  BigDecimal::valueOf (0.192), BigDecimal::valueOf (0.176),                  BigDecimal::valueOf (0.16), BigDecimal::valueOf (0.152),                  BigDecimal::valueOf (0.144), BigDecimal::valueOf (0.136),                  BigDecimal::valueOf (0.128), BigDecimal::valueOf (0.12),                  BigDecimal::valueOf (0.112), BigDecimal::valueOf (0.104),                  BigDecimal::valueOf (0.096), BigDecimal::valueOf (0.088),                  BigDecimal::valueOf (0.08), BigDecimal::valueOf (0.072),                  BigDecimal::valueOf (0.064), BigDecimal::valueOf (0.056),                  BigDecimal::valueOf (0.048), BigDecimal::valueOf (0.04),                  BigDecimal::valueOf (0.032), BigDecimal::valueOf (0.024),                  BigDecimal::valueOf (0.016), BigDecimal::valueOf (0.008),                  BigDecimal::valueOf (0.0));

	/** Tabelle fuer die Hoechstbetraege des Altersentlastungsbetrags */
	protected static final $TAB5 = array(BigDecimal::valueOf (0), BigDecimal::valueOf (1900),                  BigDecimal::valueOf (1824), BigDecimal::valueOf (1748),                  BigDecimal::valueOf (1672), BigDecimal::valueOf (1596),                  BigDecimal::valueOf (1520), BigDecimal::valueOf (1444),                  BigDecimal::valueOf (1368), BigDecimal::valueOf (1292),                  BigDecimal::valueOf (1216), BigDecimal::valueOf (1140),                  BigDecimal::valueOf (1064), BigDecimal::valueOf (988),                  BigDecimal::valueOf (912), BigDecimal::valueOf (836),                  BigDecimal::valueOf (760), BigDecimal::valueOf (722),                  BigDecimal::valueOf (684), BigDecimal::valueOf (646),                  BigDecimal::valueOf (608), BigDecimal::valueOf (570),                  BigDecimal::valueOf (532), BigDecimal::valueOf (494),                  BigDecimal::valueOf (456), BigDecimal::valueOf (418),                  BigDecimal::valueOf (380), BigDecimal::valueOf (342),                  BigDecimal::valueOf (304), BigDecimal::valueOf (266),                  BigDecimal::valueOf (228), BigDecimal::valueOf (190),                  BigDecimal::valueOf (152), BigDecimal::valueOf (114),                  BigDecimal::valueOf (76), BigDecimal::valueOf (38),                  BigDecimal::valueOf (0));

	/** Zahlenkonstanten fuer im Plan oft genutzte BigDecimal Werte */
	protected static final $ZAHL1 = BigDecimal::$ONE;
	protected static final $ZAHL2 = new BigDecimal(2);
	protected static final $ZAHL3 = new BigDecimal(3);
	protected static final $ZAHL4 = new BigDecimal(4);
	protected static final $ZAHL5 = new BigDecimal(5);
	protected static final $ZAHL6 = new BigDecimal(6);
	protected static final $ZAHL7 = new BigDecimal(7);
	protected static final $ZAHL8 = new BigDecimal(8);
	protected static final $ZAHL9 = new BigDecimal(9);
	protected static final $ZAHL10 = BigDecimal::$TEN;
	protected static final $ZAHL11 = new BigDecimal(11);
	protected static final $ZAHL12 = new BigDecimal(12);
	protected static final $ZAHL100 = new BigDecimal(100);
	protected static final $ZAHL360 = new BigDecimal(360);
	protected static final $ZAHL500 = new BigDecimal(500);
	protected static final $ZAHL700 = new BigDecimal(700);

	/* SETTER */

	@Override
	public function setPVS($arg0) { $this->PVS = $arg0; }

	@Override
	public function setJVBEZ($arg0) { $this->JVBEZ = $arg0; }

	@Override
	public function setF($arg0) { $this->F = $arg0; }

	@Override
	public function setVBEZM($arg0) { $this->VBEZM = $arg0; }

	@Override
	public function setLZZ($arg0) { $this->LZZ = $arg0; }

	@Override
	public function setALTER1($arg0) { $this->ALTER1 = $arg0; }

	@Override
	public function setSTKL($arg0) { $this->STKL = $arg0; }

	@Override
	public function setRE4($arg0) { $this->RE4 = $arg0; }

	@Override
	public function setVBS($arg0) { $this->VBS = $arg0; }

	@Override
	public function setR($arg0) { $this->R = $arg0; }

	@Override
	public function setSONSTB($arg0) { $this->SONSTB = $arg0; }

	@Override
	public function setPKV($arg0) { $this->PKV = $arg0; }

	@Override
	public function setPVZ($arg0) { $this->PVZ = $arg0; }

	@Override
	public function setLZZHINZU($arg0) { $this->LZZHINZU = $arg0; }

	@Override
	public function setVBEZS($arg0) { $this->VBEZS = $arg0; }

	@Override
	public function setJRE4($arg0) { $this->JRE4 = $arg0; }

	@Override
	public function setSTERBE($arg0) { $this->STERBE = $arg0; }

	@Override
	public function setENTSCH($arg0) { $this->ENTSCH = $arg0; }

	@Override
	public function setJHINZU($arg0) { $this->JHINZU = $arg0; }

	@Override
	public function setJFREIB($arg0) { $this->JFREIB = $arg0; }

	@Override
	public function setZKF($arg0) { $this->ZKF = $arg0; }

	@Override
	public function setVJAHR($arg0) { $this->VJAHR = $arg0; }

	@Override
	public function setKRV($arg0) { $this->KRV = $arg0; }

	@Override
	public function setAJAHR($arg0) { $this->AJAHR = $arg0; }

	@Override
	public function setZMVB($arg0) { $this->ZMVB = $arg0; }

	@Override
	public function setLZZFREIB($arg0) { $this->LZZFREIB = $arg0; }

	@Override
	public function setPKPV($arg0) { $this->PKPV = $arg0; }

	@Override
	public function setVMT($arg0) { $this->VMT = $arg0; }

	@Override
	public function setAF($arg0) { $this->AF = $arg0; }

	@Override
	public function setVKAPA($arg0) { $this->VKAPA = $arg0; }

	@Override
	public function setVBEZ($arg0) { $this->VBEZ = $arg0; }

	@Override
	public function setHINZUR($arg0) { /* required for newer calculator */ }

	@Override
	public function setWFUNDF($arg0) { /* required for newer calculator */ }

	/* GETTER */

	@Override
	public function getSTS() { return $this->STS; }

	@Override
	public function getSOLZV() { return $this->SOLZV; }

	@Override
	public function getSTV() { return $this->STV; }

	@Override
	public function getSOLZS() { return $this->SOLZS; }

	@Override
	public function getBKS() { return $this->BKS; }

	@Override
	public function getSOLZLZZ() { return $this->SOLZLZZ; }

	@Override
	public function getBKV() { return $this->BKV; }

	@Override
	public function getBK() { return $this->BK; }

	@Override
	public function getLSTLZZ() { return $this->LSTLZZ; }

	/** PROGRAMMABLAUFPLAN 2010, PAP Seite 10 */
	@Override
	public function main() {

		MRE4JL();
		$VBEZBSO= BigDecimal::$ZERO;
		$KENNVMT= 0;
		MRE4();
		MRE4ABZ();
		MZTABFB();
		MLSTJAHR();
		$LSTJAHR= $ST->multiply(BigDecimal::valueOf($F)).setScale(0,BigDecimal::$ROUND_DOWN);
		$JW= $LSTJAHR->multiply(self::$ZAHL100);
		UPANTEIL();
		$LSTLZZ= $ANTEIL1;
		if($ZKF->compareTo (BigDecimal::$ZERO) == 1) {
			$ZTABFB= ($ZTABFB->add ($KFB)).setScale (2, BigDecimal::$ROUND_DOWN);
			MRE4ABZ();
			MLSTJAHR();
			$JBMG= $ST->multiply(BigDecimal::valueOf($F)).setScale(0, BigDecimal::$ROUND_DOWN);
		} else {
			$JBMG= $LSTJAHR;
		}
		MSOLZ();
		MSONST();
		MVMT();
	}

	/** Ermittlung des Jahresarbeitslohns nach � 39 b Abs. 2 Satz 2 EStG, PAP Seite 11 */
	protected function MRE4JL() {

		if($LZZ == 1) {
			$ZRE4J= $RE4->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			$ZVBEZJ= $VBEZ->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			$JLFREIB= $LZZFREIB->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			$JLHINZU= $LZZHINZU->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
		} else {
			if($LZZ == 2) {
				$ZRE4J= ($RE4->multiply (self::$ZAHL12)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				$ZVBEZJ= ($VBEZ->multiply (self::$ZAHL12)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				$JLFREIB= ($LZZFREIB->multiply (self::$ZAHL12)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				$JLHINZU= ($LZZHINZU->multiply (self::$ZAHL12)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
			} else {
				if($LZZ == 3) {
					$ZRE4J= ($RE4->multiply (self::$ZAHL360)).divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
					$ZVBEZJ= ($VBEZ->multiply (self::$ZAHL360)).divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
					$JLFREIB= ($LZZFREIB->multiply (self::$ZAHL360)).divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
					$JLHINZU= ($LZZHINZU->multiply (self::$ZAHL360)).divide (self::$ZAHL700, 2, BigDecimal::$ROUND_DOWN);
				} else {
					$ZRE4J= ($RE4->multiply (self::$ZAHL360)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
					$ZVBEZJ= ($VBEZ->multiply (self::$ZAHL360)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
					$JLFREIB= ($LZZFREIB->multiply (self::$ZAHL360)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
					$JLHINZU= ($LZZHINZU->multiply (self::$ZAHL360)).divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
				}
			}
		}
		if($AF == 0) {
			$F= 1;
		}
	}

	/** Freibetr�ge f�r Versorgungsbez�ge, Altersentlastungsbetrag (� 39b Abs. 2 Satz 3 EStG), PAP Seite 12 */
	protected function MRE4() {

		if($ZVBEZJ->compareTo (BigDecimal::$ZERO) == 0) {
			$FVBZ= BigDecimal::$ZERO;
			$FVB= BigDecimal::$ZERO;
			$FVBZSO= BigDecimal::$ZERO;
			$FVBSO= BigDecimal::$ZERO;
		} else {
			if($VJAHR < 2006) {
				$J= 1;
			} else {
				if($VJAHR < 2040) {
					$J= $VJAHR - 2004;
				} else {
					$J= 36;
				}
			}
			if($LZZ == 1) {
				$VBEZB= ($VBEZM->multiply (BigDecimal::valueOf ($ZMVB))).add ($VBEZS);
				$HFVB= self::$TAB2[$J].divide (self::$ZAHL12).multiply (BigDecimal::valueOf ($ZMVB));
				$FVBZ= self::$TAB3[$J].divide (self::$ZAHL12).multiply (BigDecimal::valueOf ($ZMVB)).setScale (0, BigDecimal::$ROUND_UP);
			} else {
				$VBEZB= (($VBEZM->multiply (self::$ZAHL12)).add ($VBEZS)).setScale (2, BigDecimal::$ROUND_DOWN);
				$HFVB= self::$TAB2[$J];
				$FVBZ= self::$TAB3[$J];
			}
			$FVB= (($VBEZB->multiply (self::$TAB1[$J]))).divide (self::$ZAHL100).setScale (2, BigDecimal::$ROUND_UP);
			if($FVB->compareTo ($HFVB) == 1) {
				$FVB = $HFVB;
			}
			$FVBSO= ($FVB->add(($VBEZBSO->multiply (self::$TAB1[$J])).divide (self::$ZAHL100))).setScale (2, BigDecimal::$ROUND_UP);
			if($FVBSO->compareTo (self::$TAB2[$J]) == 1) {
				$FVBSO = self::$TAB2[$J];
			}
			$HFVBZSO= ((($VBEZB->add($VBEZBSO)).divide (self::$ZAHL100)).subtract ($FVBSO)).setScale (2, BigDecimal::$ROUND_DOWN);
			$FVBZSO= ($FVBZ->add(($VBEZBSO).divide (self::$ZAHL100))).setScale (0, BigDecimal::$ROUND_UP);
			if($FVBZSO->compareTo ($HFVBZSO) == 1) {
				$FVBZSO = $HFVBZSO->setScale(0, BigDecimal::$ROUND_UP);
			}
			if($FVBZSO->compareTo (self::$TAB3[$J]) == 1) {
				$FVBZSO = self::$TAB3[$J];
			}
			$HFVBZ= (($VBEZB->divide (self::$ZAHL100)).subtract ($FVB)).setScale (2, BigDecimal::$ROUND_DOWN);
			if($FVBZ->compareTo ($HFVBZ) == 1) {
				$FVBZ = $HFVBZ->setScale (0, BigDecimal::$ROUND_UP);
			}
		}
		MRE4ALTE();
	}

	/** Altersentlastungsbetrag (� 39b Abs. 2 Satz 3 EStG), PAP Seite 13 */
	protected function MRE4ALTE() {

		if($ALTER1 == 0) {
			$ALTE= BigDecimal::$ZERO;
		} else {
			if($AJAHR < 2006) {
				$K= 1;
			} else {
				if($AJAHR < 2040) {
					$K= $AJAHR - 2004;
				} else {
					$K= 36;
				}
			}
			$BMG= $ZRE4J->subtract ($ZVBEZJ);/** Lt. PAP muss hier auf ganze EUR gerundet werden */
			$ALTE = ($BMG->multiply(self::$TAB4[$K])).setScale(0, BigDecimal::$ROUND_UP);
			$HBALTE= self::$TAB5[$K];
			if($ALTE->compareTo ($HBALTE) == 1) {
				$ALTE= $HBALTE;
			}
		}
	}

	/** Ermittlung des Jahresarbeitslohns nach Abzug der Freibetr�ge nach � 39 b Abs. 2 Satz 3 und 4 EStG, PAP Seite 15 */
	protected function MRE4ABZ() {

		$ZRE4= ($ZRE4J->subtract ($FVB).subtract   ($ALTE).subtract ($JLFREIB).add ($JLHINZU)).setScale (2, BigDecimal::$ROUND_DOWN);
		if($ZRE4->compareTo (BigDecimal::$ZERO) == -1) {
			$ZRE4= BigDecimal::$ZERO;
		}
		$ZRE4VP= $ZRE4J;
		if($KENNVMT == 2) {
			$ZRE4VP = $ZRE4VP->subtract($ENTSCH->divide(self::$ZAHL100)).setScale(2,BigDecimal::$ROUND_DOWN);
		}
		$ZVBEZ = $ZVBEZJ->subtract($FVB).setScale(2, BigDecimal::$ROUND_DOWN);
		if($ZVBEZ->compareTo(BigDecimal::$ZERO) == -1) {
			$ZVBEZ = BigDecimal::$ZERO;
		}
	}

	/** Ermittlung der festen Tabellenfreibetr�ge (ohne Vorsorgepauschale), PAP Seite 16 */
	protected function MZTABFB() {

		$ANP= BigDecimal::$ZERO;
		if($ZVBEZ->compareTo (BigDecimal::$ZERO) >= 0 && $ZVBEZ->compareTo($FVBZ) == -1) {
			$FVBZ= $ZVBEZ->setScale (0, BigDecimal::$ROUND_DOWN);
		}
		if($STKL < 6) {
			if($ZVBEZ->compareTo (BigDecimal::$ZERO) == 1) {
				if(($ZVBEZ->subtract ($FVBZ)).compareTo (BigDecimal::valueOf (102)) == -1) {
					$ANP= ($ZVBEZ->subtract ($FVBZ)).setScale (0, BigDecimal::$ROUND_UP);
				} else {
					$ANP= BigDecimal::valueOf (102);
				}
			}
		} else {
			$FVBZ= BigDecimal::valueOf (0);
			$FVBZSO= BigDecimal::valueOf (0);
		}
		if($STKL < 6) {
			if($ZRE4->compareTo ($ZVBEZ) == 1) {
				if(($ZRE4->subtract ($ZVBEZ)).compareTo (BigDecimal::valueOf (920)) == -1) {
					$ANP= ($ANP->add ($ZRE4).subtract ($ZVBEZ)).setScale (0, BigDecimal::$ROUND_UP);
				} else {
					$ANP= $ANP->add (BigDecimal::valueOf (920));
				}
			}
		}
		$KZTAB= 1;
		if($STKL == 1) {
			$SAP= BigDecimal::valueOf (36);
			$KFB= ($ZKF->multiply (BigDecimal::valueOf (7008))).setScale (0, BigDecimal::$ROUND_DOWN);
		} else {
			if($STKL == 2) {
				$EFA= BigDecimal::valueOf (1308);
				$SAP= BigDecimal::valueOf (36);
				$KFB= ($ZKF->multiply (BigDecimal::valueOf (7008))).setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				if($STKL == 3) {
					$KZTAB= 2;
					$SAP= BigDecimal::valueOf (36);
					$KFB= ($ZKF->multiply (BigDecimal::valueOf (7008))).setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					if($STKL == 4) {
						$SAP= BigDecimal::valueOf (36);
						$KFB= ($ZKF->multiply (BigDecimal::valueOf (3504))).setScale (0, BigDecimal::$ROUND_DOWN);
					} else {
						if($STKL == 5) {
							$SAP= BigDecimal::valueOf (36);
							$KFB= BigDecimal::$ZERO;
						} else {
							$KFB= BigDecimal::$ZERO;
						}
					}
				}
			}
		}
		$ZTABFB= ($EFA->add ($ANP).add ($SAP).add ($FVBZ)).setScale (2, BigDecimal::$ROUND_DOWN);
	}

	/** Ermittlung Jahreslohnsteuer, PAP Seite 17 */
	protected function MLSTJAHR() {

		UPEVP();
		if($KENNVMT != 1) {
			$ZVE= ($ZRE4->subtract ($ZTABFB).subtract ($VSP)).setScale (2, BigDecimal::$ROUND_DOWN);
			UPMLST();
		} else {
			$ZVE= ($ZRE4->subtract ($ZTABFB).subtract ($VSP).subtract (($VMT).divide (self::$ZAHL100)).subtract (($VKAPA).divide (self::$ZAHL100))).setScale (2, BigDecimal::$ROUND_DOWN);
			if($ZVE->compareTo (BigDecimal::$ZERO) == -1) {
				$ZVE= ((($ZVE->add (($VMT).divide (self::$ZAHL100))).add (($VKAPA).divide (self::$ZAHL100))).divide (self::$ZAHL5)).setScale (2, BigDecimal::$ROUND_DOWN);
				UPMLST();
				$ST= ($ST->multiply (self::$ZAHL5)).setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				UPMLST();
				$STOVMT= $ST;
				$ZVE= ($ZVE->add((($VMT->add ($VKAPA)).divide (self::$ZAHL500)))).setScale (2, BigDecimal::$ROUND_DOWN);
				UPMLST();
				$ST= ((($ST->subtract ($STOVMT)).multiply (self::$ZAHL5)).add ($STOVMT)).setScale (0, BigDecimal::$ROUND_DOWN);
			}
		}
	}

	/** PAP Seite 18 Ermittlung der Jahreslohnsteuer aus dem Einkommensteuertarif */
	protected function UPMLST() {

		if($ZVE->compareTo (self::$ZAHL1) == -1) {
			$ZVE= BigDecimal::$ZERO;
			$X= BigDecimal::$ZERO;
		} else {
			$X= ($ZVE->divide (BigDecimal::valueOf($KZTAB))).setScale (0, BigDecimal::$ROUND_DOWN);
		}
		if($STKL < 5) {
			UPTAB10();
		} else {
			MST5_6();
		}
	}

	/** Vorsorgepauschale (� 39b Abs. 2 Satz 5 Nr 3 EStG) nach dem B�rgerentlastungsgesetz Krankenversicherung<br>
  			Achtung: Es wird davon ausgegangen, dass	<br>
  				a) Die Rentenversicherungsbemessungsgrenze sich 2010 f�r die alten Bundesl�nder auf 66.000 Euro erh�ht<br>
  					 und f�r die neuen Beundesl�nder auf 55.800 festgelegt wird sowie		<br>
  					 <br>
  				b) der Beitragssatz zur Rentenversicherung gegen�ber 2009 unver�ndert bleibt. <br>
  			<br>
  			PAP Seite 19 */
	protected function UPEVP() {

		if($KRV > 1) {
			$VSP1= BigDecimal::$ZERO;
		} else {
			if($KRV == 0) {
				if($ZRE4VP->compareTo (BigDecimal::valueOf (66000)) == 1) {
					$ZRE4VP= BigDecimal::valueOf (66000);
				}
			} else {
				if($ZRE4VP->compareTo (BigDecimal::valueOf (55800)) == 1) {
					$ZRE4VP= BigDecimal::valueOf (55800);
				}
			}
			$VSP1= ($ZRE4VP->multiply (BigDecimal::valueOf (0.4))).setScale (2, BigDecimal::$ROUND_DOWN);
			$VSP1= ($VSP1->multiply (BigDecimal::valueOf (0.0995))).setScale (2, BigDecimal::$ROUND_DOWN);
		}
		$VSP2= ($ZRE4VP->multiply (BigDecimal::valueOf (0.12))).setScale (2, BigDecimal::$ROUND_DOWN);
		if($STKL == 3) {
			$VHB = BigDecimal::valueOf(3000);
		} else {
			$VHB = BigDecimal::valueOf(1900);
		}
		if($VSP2->compareTo ($VHB) == 1) {
			$VSP2= $VHB;
		}
		$VSPN= ($VSP1->add ($VSP2)).setScale (0, BigDecimal::$ROUND_UP);
		MVSP();
		if($VSPN->compareTo ($VSP) == 1) {
			$VSP= $VSPN->setScale (2, BigDecimal::$ROUND_DOWN);
		}
	}

	/** Vorsorgepauschale (�39b Abs. 2 Satz 5 Nr 3 EStG) Vergleichsberechnung fuer Guenstigerpruefung, PAP Seite 20 */
	protected function MVSP() {

		if($ZRE4VP->compareTo( BigDecimal::valueOf(45000) ) == 1) {
			$ZRE4VP = BigDecimal::valueOf(45000L);
		}
		if($PKV > 0) {
			if($STKL == 6) {
				$VSP = BigDecimal::$ZERO;
			} else {
				$VSP = $PKPV->multiply(self::$ZAHL12).divide(self::$ZAHL100);
				if($PKV == 2) {
					$KVSATZAG = BigDecimal::valueOf(0.067).setScale(5);
					if($PVS == 1) {
						$PVSATZAG = BigDecimal::valueOf(0.00475D).setScale(5);
					} else {
						$PVSATZAG = BigDecimal::valueOf(0.00975D).setScale(5);
					}
					$VSP = $VSP->subtract($ZRE4VP->multiply($KVSATZAG->add($PVSATZAG))).setScale(2, BigDecimal::$ROUND_DOWN);
				}
			}
		} else {
			$KVSATZAN = BigDecimal::valueOf(0.076D).setScale(5);
			if($PVS == 1) {
				$PVSATZAN = BigDecimal::valueOf(0.01475D).setScale(5);
			} else {
				$PVSATZAN = BigDecimal::valueOf(0.00975D).setScale(5);
			}
			if($PVZ == 1) {
				$PVSATZAN = $PVSATZAN->add(BigDecimal::valueOf(0.0025D));
			}
			$VSP = $ZRE4VP->multiply($KVSATZAN->add($PVSATZAN)).setScale(2, BigDecimal::$ROUND_DOWN);
		}
		$VSP = $VSP->add($VSP1).setScale(0, BigDecimal::$ROUND_UP);
	}

	/** Lohnsteuer fuer die Steuerklassen V und VI (� 39b Abs. 2 Satz 7 EStG), PAP Seite 21 */
	protected function MST5_6() {

		$ZZX= $X;
		if($ZZX->compareTo (BigDecimal::valueOf (26441)) == 1) {
			$ZX= BigDecimal::valueOf (26441);
			UP5_6();
			if($ZZX->compareTo (BigDecimal::valueOf (200584)) == 1) {
				$ST= ($ST->add ((BigDecimal::valueOf (200584).subtract (BigDecimal::valueOf (26441))).multiply (BigDecimal::valueOf (0.42)))).setScale (0, BigDecimal::$ROUND_DOWN);
				$ST= ($ST->add (($ZZX->subtract (BigDecimal::valueOf (200584))).multiply (BigDecimal::valueOf (0.45)))).setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				$ST= ($ST->add (($ZZX->subtract (BigDecimal::valueOf (26441))).multiply (BigDecimal::valueOf (0.42)))).setScale (0, BigDecimal::$ROUND_DOWN);
			}
		} else {
			$ZX= $ZZX;
			UP5_6();
			if($ZZX->compareTo (BigDecimal::valueOf (9429)) == 1) {
				$VERGL= $ST;
				$ZX= BigDecimal::valueOf (9429);
				UP5_6();
				$HOCH= ($ST->add (($ZZX->subtract (BigDecimal::valueOf (9429))).multiply (BigDecimal::valueOf (0.42)))).setScale (0, BigDecimal::$ROUND_DOWN);
				if($HOCH->compareTo ($VERGL) == -1) {
					$ST= $HOCH;
				} else {
					$ST= $VERGL;
				}
			}
		}
	}

	/** Unterprogramm zur Lohnsteuer fuer die Steuerklassen V und VI (� 39b Abs. 2 Satz 7 EStG), PAP Seite 21 */
	protected function UP5_6() {

		$X= ($ZX->multiply (BigDecimal::valueOf (1.25))).setScale (2, BigDecimal::$ROUND_DOWN);
		UPTAB10();
		$ST1= $ST;
		$X= ($ZX->multiply (BigDecimal::valueOf (0.75))).setScale (2, BigDecimal::$ROUND_DOWN);
		UPTAB10();
		$ST2= $ST;
		$DIFF= ($ST1->subtract ($ST2)).multiply (self::$ZAHL2);
		$MIST= ($ZX->multiply (BigDecimal::valueOf (0.14))).setScale (0, BigDecimal::$ROUND_DOWN);
		if($MIST->compareTo ($DIFF) == 1) {
			$ST= $MIST;
		} else {
			$ST= $DIFF;
		}
	}

	/** Solidaritaetszuschlag, PAP Seite 22 */
	protected function MSOLZ() {

		$SOLZFREI= BigDecimal::valueOf (972 * $KZTAB);
		if($JBMG->compareTo ($SOLZFREI) == 1) {
			$SOLZJ= ($JBMG->multiply (BigDecimal::valueOf (5.5))).divide(self::$ZAHL100).setScale(2, BigDecimal::$ROUND_DOWN);
			$SOLZMIN= ($JBMG->subtract ($SOLZFREI)).multiply (BigDecimal::valueOf (20)).divide (self::$ZAHL100).setScale (2, BigDecimal::$ROUND_DOWN);
			if($SOLZMIN->compareTo ($SOLZJ) == -1) {
				$SOLZJ= $SOLZMIN;
			}
			$JW= $SOLZJ->multiply (self::$ZAHL100).setScale (0, BigDecimal::$ROUND_DOWN);
			UPANTEIL();
			$SOLZLZZ= $ANTEIL1;
		} else {
			$SOLZLZZ= BigDecimal::$ZERO;
		}
		if($R > 0) {
			$JW= $JBMG->multiply (self::$ZAHL100);
			UPANTEIL();
			$BK= $ANTEIL1;
		} else {
			$BK= BigDecimal::$ZERO;
		}
	}

	/** Anteil von Jahresbetraegen fuer einen LZZ (� 39b Abs. 2 Satz 9 EStG), PAP Seite 23 */
	protected function UPANTEIL() {

		if($LZZ == 1) {
			$ANTEIL1= $JW;
			$ANTEIL2= $JW;
		} else {
			if($LZZ == 2) {
				$ANTEIL1= $JW->divide (self::$ZAHL12, 0, BigDecimal::$ROUND_DOWN);
				$ANTEIL2= $JW->divide (self::$ZAHL12, 0, BigDecimal::$ROUND_UP);
			} else {
				if($LZZ == 3) {
					$ANTEIL1= ($JW->multiply (self::$ZAHL7)).divide (self::$ZAHL360, 0, BigDecimal::$ROUND_DOWN);
					$ANTEIL2= ($JW->multiply (self::$ZAHL7)).divide (self::$ZAHL360, 0, BigDecimal::$ROUND_UP);
				} else {
					$ANTEIL1= $JW->divide (self::$ZAHL360, 0, BigDecimal::$ROUND_DOWN);
					$ANTEIL2= $JW->divide (self::$ZAHL360, 0, BigDecimal::$ROUND_UP);
				}
			}
		}
	}

	/** Berechnung sonstiger Bezuege nach � 39b Abs. 3 Saetze 1 bis 8 EStG), PAP Seite 24 */
	protected function MSONST() {

		$LZZ= 1;
		if($ZMVB == 0) {
			$ZMVB= 12;
		}
		if($SONSTB->compareTo (BigDecimal::$ZERO) == 0) {
			$LSTSO= BigDecimal::$ZERO;
			$STS= BigDecimal::$ZERO;
			$SOLZS= BigDecimal::$ZERO;
			$BKS= BigDecimal::$ZERO;
		} else {
			MOSONST();
			$ZRE4J= (($JRE4->add ($SONSTB)).divide (self::$ZAHL100)).setScale (2, BigDecimal::$ROUND_DOWN);
			$ZVBEZJ= (($JVBEZ->add ($VBS)).divide (self::$ZAHL100)).setScale (2, BigDecimal::$ROUND_DOWN);
			$VBEZBSO= $STERBE;
			MRE4SONST();
			MLSTJAHR();
			$LSTSO= $ST->multiply (self::$ZAHL100);/** lt. PAP muss hier auf ganze EUR aufgerundet werden, <br>
        			allerdings muss der Wert in Cent vorgehalten werden,<br>
        			deshalb nach dem Aufrunden auf ganze EUR durch 'divide(ZAHL100, 0, BigDecimal.ROUND_DOWN)'<br>
        			wieder die Multiplikation mit 100 */
			$STS = $LSTSO->subtract($LSTOSO).multiply(BigDecimal::valueOf($F)).divide(self::$ZAHL100, 0, BigDecimal::$ROUND_DOWN).multiply(self::$ZAHL100);
			if($STS->compareTo (BigDecimal::$ZERO) == -1) {
				$STS= BigDecimal::$ZERO;
			}
			$SOLZS= $STS->multiply (BigDecimal::valueOf (5.5)).divide (self::$ZAHL100, 0, BigDecimal::$ROUND_DOWN);
			if($R > 0) {
				$BKS= $STS;
			} else {
				$BKS= BigDecimal::$ZERO;
			}
		}
	}

	/** Berechnung der Verguetung fuer mehrjaehrige Taetigkeit nach � 39b Abs. 3 Satz 9 und 10 EStG), PAP Seite 25 */
	protected function MVMT() {

		if($VKAPA->compareTo (BigDecimal::$ZERO) == -1) {
			$VKAPA= BigDecimal::$ZERO;
		}
		if(($VMT->add ($VKAPA)).compareTo (BigDecimal::$ZERO) == 1) {
			if($LSTSO->compareTo (BigDecimal::$ZERO) == 0) {
				MOSONST();
				$LST1= $LSTOSO;
			} else {
				$LST1= $LSTSO;
			}
			$VBEZBSO= $STERBE->add ($VKAPA);
			$ZRE4J= (($JRE4->add ($SONSTB).add ($VMT).add ($VKAPA)).divide (self::$ZAHL100)).setScale (2, BigDecimal::$ROUND_DOWN);
			$ZVBEZJ= (($JVBEZ->add ($VBS).add ($VKAPA)).divide (self::$ZAHL100)).setScale (2, BigDecimal::$ROUND_DOWN);
			$KENNVMT = 2;
			MRE4SONST();
			MLSTJAHR();
			$LST3= $ST->multiply (self::$ZAHL100);
			MRE4ABZ();
			$KENNVMT= 1;
			MLSTJAHR();
			$LST2= $ST->multiply (self::$ZAHL100);
			$STV= $LST2->subtract ($LST1);
			$LST3= $LST3->subtract ($LST1);
			if($LST3->compareTo ($STV) == -1) {
				$STV= $LST3;
			}
			if($STV->compareTo (BigDecimal::$ZERO) == -1) {
				$STV= BigDecimal::$ZERO;
			} else {/** lt. PAP muss hier auf ganze EUR abgerundet werden.<br>
   	        	Allerdings muss auch hier der Wert in Cent vorgehalten werden,<br>
        			weshalb nach dem Aufrunden auf ganze EUR durch 'divide(ZAHL100, 0, BigDecimal.ROUND_DOWN)'<br>
        			wieder die Multiplikation mit 100 erfolgt. */
				$STV = $STV->multiply(BigDecimal::valueOf($F)).divide(self::$ZAHL100, 0, BigDecimal::$ROUND_DOWN).multiply(self::$ZAHL100);
			}
			$SOLZV= (($STV->multiply (BigDecimal::valueOf (5.5))).divide (self::$ZAHL100)).setScale (0, BigDecimal::$ROUND_DOWN);
			if($R > 0) {
				$BKV= $STV;
			} else {
				$BKV= BigDecimal::$ZERO;
			}
		} else {
			$STV= BigDecimal::$ZERO;
			$SOLZV= BigDecimal::$ZERO;
			$BKV= BigDecimal::$ZERO;
		}
	}

	/** Sonderberechnung ohne sonstige Bez�ge f�r Berechnung bei sonstigen Bez�gen oder Verg�tung f�r mehrj�hrige T�tigkeit, PAP Seite 26 */
	protected function MOSONST() {

		$ZRE4J= ($JRE4->divide (self::$ZAHL100)).setScale (2, BigDecimal::$ROUND_DOWN);
		$ZVBEZJ= ($JVBEZ->divide (self::$ZAHL100)).setScale (2, BigDecimal::$ROUND_DOWN);
		$JLFREIB= $JFREIB->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
		$JLHINZU= $JHINZU->divide (self::$ZAHL100, 2, BigDecimal::$ROUND_DOWN);
		MRE4();
		MRE4ABZ();
		MZTABFB();
		MLSTJAHR();
		$LSTOSO= $ST->multiply (self::$ZAHL100);
	}

	/** Sonderberechnung mit sonstige Bez�ge f�r Berechnung bei sonstigen Bez�gen oder Verg�tung f�r mehrj�hrige T�tigkeit, PAP Seite 26 */
	protected function MRE4SONST() {

		MRE4();
		$FVB= $FVBSO;
		MRE4ABZ();
		$FVBZ= $FVBZSO;
		MZTABFB();
	}

	/** Tarifliche Einkommensteuer �32a EStG, PAP Seite 27 */
	protected function UPTAB10() {

		if($X->compareTo (BigDecimal::valueOf (8005)) == -1) {
			$ST= BigDecimal::$ZERO;
		} else {
			if($X->compareTo (BigDecimal::valueOf (13470)) == -1) {
				$Y= ($X->subtract (BigDecimal::valueOf (8004))).divide (BigDecimal::valueOf (10000), 6, BigDecimal::$ROUND_DOWN);
				$RW= $Y->multiply (BigDecimal::valueOf (912.17));
				$RW= $RW->add (BigDecimal::valueOf (1400));
				$ST= ($RW->multiply ($Y)).setScale (0, BigDecimal::$ROUND_DOWN);
			} else {
				if($X->compareTo (BigDecimal::valueOf (52882)) == -1) {
					$Y= ($X->subtract (BigDecimal::valueOf (13469))).divide (BigDecimal::valueOf (10000), 6, BigDecimal::$ROUND_DOWN);
					$RW= $Y->multiply (BigDecimal::valueOf (228.74));
					$RW= $RW->add (BigDecimal::valueOf (2397));
					$RW= $RW->multiply ($Y);
					$ST= ($RW->add (BigDecimal::valueOf (1038))).setScale (0, BigDecimal::$ROUND_DOWN);
				} else {
					if($X->compareTo (BigDecimal::valueOf (250731)) == -1) {
						$ST= (($X->multiply (BigDecimal::valueOf (0.42))).subtract (BigDecimal::valueOf (8172))).setScale (0, BigDecimal::$ROUND_DOWN);
					} else {
						$ST= (($X->multiply (BigDecimal::valueOf (0.45))).subtract (BigDecimal::valueOf (15694))).setScale (0, BigDecimal::$ROUND_DOWN);
					}
				}
			}
		}
		$ST= $ST->multiply (BigDecimal::valueOf ($KZTAB));
	}

}