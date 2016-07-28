<?php

namespace Kununu\Services;

/**
 * Interface LohnsteuerInterface
 * 
 * @author Christian Delfs
 * @copyright  kununu GmbH
 */

interface LohnsteuerInterface {
	
	public function main();

	/** 1, wenn die Anwendung des Faktorverfahrens gew�hlt wurden (nur in Steuerklasse IV) */
	public function setaf($arg0);

	/** Auf die Vollendung des 64. Lebensjahres folgende<br>
	             Kalenderjahr (erforderlich, wenn ALTER1=1) */
	public function setAJAHR($arg0);

	/** 1, wenn das 64. Lebensjahr zu Beginn des Kalenderjahres vollendet wurde, in dem<br>
	             der Lohnzahlungszeitraum endet (� 24 a EStG), sonst = 0 */
	public function setALTER1($arg0);

	/** in VKAPA und VMT enthaltene Entsch�digungen nach �24 Nummer 1 EStG in Cent */
	public function setENTSCH($arg0);

	/** eingetragener Faktor mit drei Nachkommastellen */
	public function setf($arg0);

	/** Jahresfreibetrag nach Ma�gabe der Eintragungen auf der<br>
	             Lohnsteuerkarte in Cents (ggf. 0) */
	public function setJFREIB($arg0);

	/** Jahreshinzurechnungsbetrag in Cents (ggf. 0) */
	public function setJHINZU($arg0);

	/** Voraussichtlicher Jahresarbeitslohn ohne sonstige Bez�ge und ohne Verg�tung f�r mehrj�hrige T�tigkeit in Cent. <br>
	             Anmerkung: Die Eingabe dieses Feldes (ggf. 0) ist erforderlich bei Eingabe �sonsti-ger Bez�ge� (Feld SONSTB) <br>
	             oder bei Eingabe der �Verg�tung f�r mehrj�hrige T�tigkeit� (Feld VMT).<br>
	             Sind in einem vorangegangenen Abrechnungszeitraum bereits sonstige Bez�ge gezahlt worden, so sind sie dem <br>
	             voraussichtlichen Jahresarbeitslohn hinzuzurechnen. Verg�tungen f�r mehrere Jahres aus einem vorangegangenen <br>
	             Abrechnungszeitraum sind in voller H�he hinzuzurechnen. */
	public function setJRE4($arg0);

	/** In JRE4 enthaltene Versorgungsbezuege in Cents (ggf. 0) */
	public function setJVBEZ($arg0);

	/** Merker f�r die Vorsorgepauschale<br>
				2 = der Arbeitnehmer ist NICHT in der gesetzlichen Rentenversicherung versichert.<br>
				<br>
				1 = der Arbeitnehmer ist in der gesetzlichen Rentenversicherung versichert, es gilt die <br>
					Beitragsbemessungsgrenze OST.<br>
					<br>
				0 = der Arbeitnehmer ist in der gesetzlichen Rentenversicherung versichert, es gilt die <br>
					Beitragsbemessungsgrenze WEST. */
	public function setKRV($arg0);

	/** Einkommensbezogener Zusatzbeitragssatz eines gesetzlich krankenversicherten Arbeitnehmers, <br>
			 auf dessen Basis der an die Krankenkasse zu zahlende Zusatzbeitrag berechnet wird,<br>
			 in Prozent (bspw. 0,90 f�r 0,90 %) mit 2 Dezimalstellen. <br>
			 Der von der Kranken-kasse festgesetzte Zusatzbeitragssatz ist bei Abweichungen unma�geblich. */
	public function setKVZ($arg0);

	/** Lohnzahlungszeitraum:<br>
	             1 = Jahr<br>
	             2 = Monat<br>
	             3 = Woche<br>
	             4 = Tag */
	public function setLZZ($arg0);

	/** In der Lohnsteuerkarte des Arbeitnehmers eingetragener Freibetrag f�r<br>
	             den Lohnzahlungszeitraum in Cent */
	public function setLZZFREIB($arg0);

	/** In der Lohnsteuerkarte des Arbeitnehmers eingetragener Hinzurechnungsbetrag<br>
	             f�r den Lohnzahlungszeitraum in Cent */
	public function setLZZHINZU($arg0);

	/** Dem Arbeitgeber mitgeteilte Zahlungen des Arbeitnehmers zur privaten<br>
	             Kranken- bzw. Pflegeversicherung im Sinne des �10 Abs. 1 Nr. 3 EStG 2010<br>
	             als Monatsbetrag in Cent (der Wert ist inabh�ngig vom Lohnzahlungszeitraum immer <br>
	             als Monatsbetrag anzugeben). */
	public function setPKPV($arg0);

	/** Krankenversicherung:<br>
	             0 = gesetzlich krankenversicherte Arbeitnehmer<br>
	             1 = ausschlie�lich privat krankenversicherte Arbeitnehmer OHNE Arbeitgeberzuschuss<br>
	             2 = ausschlie�lich privat krankenversicherte Arbeitnehmer MIT Arbeitgeberzuschuss */
	public function setPKV($arg0);

	/** 1, wenn bei der sozialen Pflegeversicherung die Besonderheiten in Sachsen zu ber�cksichtigen sind bzw. <br>
	        	 	zu ber�cksichtigen w�ren, sonst 0. */
	public function setPVS($arg0);

	/** 1, wenn er der Arbeitnehmer den Zuschlag zur sozialen Pflegeversicherung <br>
	        	 	zu zahlen hat, sonst 0. */
	public function setPVZ($arg0);

	/** Religionsgemeinschaft des Arbeitnehmers lt. Lohnsteuerkarte (bei<br>
	             keiner Religionszugehoerigkeit = 0) */
	public function setR($arg0);

	/** Steuerpflichtiger Arbeitslohn vor Beruecksichtigung der Freibetraege<br>
	             fuer Versorgungsbezuege, des Altersentlastungsbetrags und des auf<br>
	             der Lohnsteuerkarte fuer den Lohnzahlungszeitraum eingetragenen<br>
	             Freibetrags in Cents. */
	public function setRE4($arg0);

	/** Sonstige Bezuege (ohne Verguetung aus mehrjaehriger Taetigkeit) einschliesslich<br>
	             Sterbegeld bei Versorgungsbezuegen sowie Kapitalauszahlungen/Abfindungen,<br>
	             soweit es sich nicht um Bezuege fuer mehrere Jahre handelt in Cents (ggf. 0) */
	public function setSONSTB($arg0);

	/** Sterbegeld bei Versorgungsbezuegen sowie Kapitalauszahlungen/Abfindungen,<br>
	             soweit es sich nicht um Bezuege fuer mehrere Jahre handelt<br>
	             (in SONSTB enthalten) in Cents */
	public function setSTERBE($arg0);

	/** Steuerklasse:<br>
	             1 = I<br>
	             2 = II<br>
	             3 = III<br>
	             4 = IV<br>
	             5 = V<br>
	             6 = VI */
	public function setSTKL($arg0);

	/** In RE4 enthaltene Versorgungsbezuege in Cents (ggf. 0) */
	public function setVBEZ($arg0);

	/** Vorsorgungsbezug im Januar 2005 bzw. fuer den ersten vollen Monat<br>
	             in Cents */
	public function setVBEZM($arg0);

	/** Voraussichtliche Sonderzahlungen im Kalenderjahr des Versorgungsbeginns<br>
	             bei Versorgungsempfaengern ohne Sterbegeld, Kapitalauszahlungen/Abfindungen<br>
	             bei Versorgungsbezuegen in Cents */
	public function setVBEZS($arg0);

	/** In SONSTB enthaltene Versorgungsbezuege einschliesslich Sterbegeld<br>
	            in Cents (ggf. 0) */
	public function setVBS($arg0);

	/** Jahr, in dem der Versorgungsbezug erstmalig gewaehrt wurde; werden<br>
	             mehrere Versorgungsbezuege gezahlt, so gilt der aelteste erstmalige Bezug */
	public function setVJAHR($arg0);

	/** Kapitalauszahlungen / Abfindungen / Nachzahlungen bei Versorgungsbez�gen <br>
	             f�r mehrere Jahre in Cent (ggf. 0) */
	public function setVKAPA($arg0);

	/** Verg�tung f�r mehrj�hrige T�tigkeit ohne Kapitalauszahlungen und ohne Abfindungen <br>
				 bei Versorgungsbez�gen in Cent (ggf. 0) */
	public function setVMT($arg0);

	/** Zahl der Freibetraege fuer Kinder (eine Dezimalstelle, nur bei Steuerklassen<br>
	             I, II, III und IV) */
	public function setZKF($arg0);

	/** Zahl der Monate, fuer die Versorgungsbezuege gezahlt werden (nur<br>
	             erforderlich bei Jahresberechnung (LZZ = 1) */
	public function setZMVB($arg0);

	/** In JRE4 enthaltene Entsch�digungen nach � 24 Nummer 1 EStG in Cent */
	public function setJRE4ENT($arg0);

	/** In SONSTB enthaltene Entsch�digungen nach � 24 Nummer 1 EStG in Cent */
	public function setSONSTENT($arg0);

	/** Bemessungsgrundlage fuer die Kirchenlohnsteuer in Cents */
	public function getBK();

	/** Bemessungsgrundlage der sonstigen Einkuenfte (ohne Verguetung<br>
	             fuer mehrjaehrige Taetigkeit) fuer die Kirchenlohnsteuer in Cents */
	public function getBKS();
	public function getBKV();

	/** Fuer den Lohnzahlungszeitraum einzubehaltende Lohnsteuer in Cents */
	public function getLSTLZZ();

	/** Fuer den Lohnzahlungszeitraum einzubehaltender Solidaritaetszuschlag<br>
	             in Cents */
	public function getSOLZLZZ();

	/** Solidaritaetszuschlag fuer sonstige Bezuege (ohne Verguetung fuer mehrjaehrige<br>
	             Taetigkeit) in Cents */
	public function getSOLZS();

	/** Solidaritaetszuschlag fuer die Verguetung fuer mehrjaehrige Taetigkeit in<br>
	             Cents */
	public function getSOLZV();

	/** Lohnsteuer fuer sonstige Einkuenfte (ohne Verguetung fuer mehrjaehrige<br>
	             Taetigkeit) in Cents */
	public function getSTS();

	/** Lohnsteuer fuer Verguetung fuer mehrjaehrige Taetigkeit in Cents */
	public function getSTV();

	/** F�r den Lohnzahlungszeitraum ber�cksichtigte Beitr�ge des Arbeitnehmers zur<br>
				 privaten Basis-Krankenversicherung und privaten Pflege-Pflichtversicherung (ggf. auch<br>
				 die Mindestvorsorgepauschale) in Cent beim laufenden Arbeitslohn. F�r Zwecke der Lohn-<br>
				 steuerbescheinigung sind die einzelnen Ausgabewerte au�erhalb des eigentlichen Lohn-<br>
				 steuerbescheinigungsprogramms zu addieren; hinzuzurechnen sind auch die Ausgabewerte<br>
				 VKVSONST */
	public function getVKVLZZ();

	/** F�r den Lohnzahlungszeitraum ber�cksichtigte Beitr�ge des Arbeitnehmers <br>
				 zur privaten Basis-Krankenversicherung und privaten Pflege-Pflichtversicherung (ggf. <br>
				 auch die Mindestvorsorgepauschale) in Cent bei sonstigen Bez�gen. Der Ausgabewert kann<br>
				 auch negativ sein. F�r tariferm��igt zu besteuernde Verg�tungen f�r mehrj�hrige <br>
				 T�tigkeiten enth�lt der PAP keinen entsprechenden Ausgabewert. */
	public function getVKVSONST();

	/** Verbrauchter Freibetrag bei Berechnung des laufenden Arbeitslohns, in Cent */
	public function getVFRB();

	/** Verbrauchter Freibetrag bei Berechnung des voraussichtlichen Jahresarbeitslohns, in Cent */
	public function getVFRBS1();

	/** Verbrauchter Freibetrag bei Berechnung der sonstigen Bez�ge, in Cent */
	public function getVFRBS2();

	/** F�r die weitergehende Ber�cksichtigung des Steuerfreibetrags nach dem DBA T�rkei verf�gbares ZVE �ber <br>
				dem Grundfreibetrag bei der Berechnung des laufenden Arbeitslohns, in Cent */
	public function getWVFRB();

	/** F�r die weitergehende Ber�cksichtigung des Steuerfreibetrags nach dem DBA T�rkei verf�gbares ZVE �ber dem Grundfreibetrag <br>
				bei der Berechnung des voraussichtlichen Jahresarbeitslohns, in Cent */
	public function getWVFRBO();

	/** F�r die weitergehende Ber�cksichtigung des Steuerfreibetrags nach dem DBA T�rkei verf�gbares ZVE <br>
				�ber dem Grundfreibetrag bei der Berechnung der sonstigen Bez�ge, in Cent */
	public function getWVFRBM();
}