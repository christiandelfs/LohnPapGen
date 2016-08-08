package de.powerproject.lohnpap.pap;

import java.math.BigDecimal;

/**
 * 
 * @author Marcel Lehmann (https://github.com/MarcelLehmann/Lohnsteuer) 
 * @date Mon Aug 08 09:30:58 CEST 2016
 * 
 */

public interface LohnsteuerInterface {
	
	public void main();

	/** 1, wenn die Anwendung des Faktorverfahrens gew�hlt wurden (nur in Steuerklasse IV) */
	public void setaf(int arg0);

	/** Auf die Vollendung des 64. Lebensjahres folgende<br>
	             Kalenderjahr (erforderlich, wenn ALTER1=1) */
	public void setAJAHR(int arg0);

	/** 1, wenn das 64. Lebensjahr zu Beginn des Kalenderjahres vollendet wurde, in dem<br>
	             der Lohnzahlungszeitraum endet (� 24 a EStG), sonst = 0 */
	public void setALTER1(int arg0);

	/** in VKAPA und VMT enthaltene Entsch�digungen nach �24 Nummer 1 EStG in Cent */
	public void setENTSCH(BigDecimal arg0);

	/** eingetragener Faktor mit drei Nachkommastellen */
	public void setf(double arg0);

	/** Jahresfreibetrag nach Ma�gabe der Eintragungen auf der<br>
	             Lohnsteuerkarte in Cents (ggf. 0) */
	public void setJFREIB(BigDecimal arg0);

	/** Jahreshinzurechnungsbetrag in Cents (ggf. 0) */
	public void setJHINZU(BigDecimal arg0);

	/** Voraussichtlicher Jahresarbeitslohn ohne sonstige Bez�ge und ohne Verg�tung f�r mehrj�hrige T�tigkeit in Cent. <br>
	             Anmerkung: Die Eingabe dieses Feldes (ggf. 0) ist erforderlich bei Eingabe �sonsti-ger Bez�ge� (Feld SONSTB) <br>
	             oder bei Eingabe der �Verg�tung f�r mehrj�hrige T�tigkeit� (Feld VMT).<br>
	             Sind in einem vorangegangenen Abrechnungszeitraum bereits sonstige Bez�ge gezahlt worden, so sind sie dem <br>
	             voraussichtlichen Jahresarbeitslohn hinzuzurechnen. Verg�tungen f�r mehrere Jahres aus einem vorangegangenen <br>
	             Abrechnungszeitraum sind in voller H�he hinzuzurechnen. */
	public void setJRE4(BigDecimal arg0);

	/** In JRE4 enthaltene Versorgungsbezuege in Cents (ggf. 0) */
	public void setJVBEZ(BigDecimal arg0);

	/** Merker f�r die Vorsorgepauschale<br>
				2 = der Arbeitnehmer ist NICHT in der gesetzlichen Rentenversicherung versichert.<br>
				<br>
				1 = der Arbeitnehmer ist in der gesetzlichen Rentenversicherung versichert, es gilt die <br>
					Beitragsbemessungsgrenze OST.<br>
					<br>
				0 = der Arbeitnehmer ist in der gesetzlichen Rentenversicherung versichert, es gilt die <br>
					Beitragsbemessungsgrenze WEST. */
	public void setKRV(int arg0);

	/** Einkommensbezogener Zusatzbeitragssatz eines gesetzlich krankenversicherten Arbeitnehmers, <br>
			 auf dessen Basis der an die Krankenkasse zu zahlende Zusatzbeitrag berechnet wird,<br>
			 in Prozent (bspw. 0,90 f�r 0,90 %) mit 2 Dezimalstellen. <br>
			 Der von der Kranken-kasse festgesetzte Zusatzbeitragssatz ist bei Abweichungen unma�geblich. */
	public void setKVZ(BigDecimal arg0);

	/** Lohnzahlungszeitraum:<br>
	             1 = Jahr<br>
	             2 = Monat<br>
	             3 = Woche<br>
	             4 = Tag */
	public void setLZZ(int arg0);

	/** In der Lohnsteuerkarte des Arbeitnehmers eingetragener Freibetrag f�r<br>
	             den Lohnzahlungszeitraum in Cent */
	public void setLZZFREIB(BigDecimal arg0);

	/** In der Lohnsteuerkarte des Arbeitnehmers eingetragener Hinzurechnungsbetrag<br>
	             f�r den Lohnzahlungszeitraum in Cent */
	public void setLZZHINZU(BigDecimal arg0);

	/** Dem Arbeitgeber mitgeteilte Zahlungen des Arbeitnehmers zur privaten<br>
	             Kranken- bzw. Pflegeversicherung im Sinne des �10 Abs. 1 Nr. 3 EStG 2010<br>
	             als Monatsbetrag in Cent (der Wert ist inabh�ngig vom Lohnzahlungszeitraum immer <br>
	             als Monatsbetrag anzugeben). */
	public void setPKPV(BigDecimal arg0);

	/** Krankenversicherung:<br>
	             0 = gesetzlich krankenversicherte Arbeitnehmer<br>
	             1 = ausschlie�lich privat krankenversicherte Arbeitnehmer OHNE Arbeitgeberzuschuss<br>
	             2 = ausschlie�lich privat krankenversicherte Arbeitnehmer MIT Arbeitgeberzuschuss */
	public void setPKV(int arg0);

	/** 1, wenn bei der sozialen Pflegeversicherung die Besonderheiten in Sachsen zu ber�cksichtigen sind bzw. <br>
	        	 	zu ber�cksichtigen w�ren, sonst 0. */
	public void setPVS(int arg0);

	/** 1, wenn er der Arbeitnehmer den Zuschlag zur sozialen Pflegeversicherung <br>
	        	 	zu zahlen hat, sonst 0. */
	public void setPVZ(int arg0);

	/** Religionsgemeinschaft des Arbeitnehmers lt. Lohnsteuerkarte (bei<br>
	             keiner Religionszugehoerigkeit = 0) */
	public void setR(int arg0);

	/** Steuerpflichtiger Arbeitslohn vor Beruecksichtigung der Freibetraege<br>
	             fuer Versorgungsbezuege, des Altersentlastungsbetrags und des auf<br>
	             der Lohnsteuerkarte fuer den Lohnzahlungszeitraum eingetragenen<br>
	             Freibetrags in Cents. */
	public void setRE4(BigDecimal arg0);

	/** Sonstige Bezuege (ohne Verguetung aus mehrjaehriger Taetigkeit) einschliesslich<br>
	             Sterbegeld bei Versorgungsbezuegen sowie Kapitalauszahlungen/Abfindungen,<br>
	             soweit es sich nicht um Bezuege fuer mehrere Jahre handelt in Cents (ggf. 0) */
	public void setSONSTB(BigDecimal arg0);

	/** Sterbegeld bei Versorgungsbezuegen sowie Kapitalauszahlungen/Abfindungen,<br>
	             soweit es sich nicht um Bezuege fuer mehrere Jahre handelt<br>
	             (in SONSTB enthalten) in Cents */
	public void setSTERBE(BigDecimal arg0);

	/** Steuerklasse:<br>
	             1 = I<br>
	             2 = II<br>
	             3 = III<br>
	             4 = IV<br>
	             5 = V<br>
	             6 = VI */
	public void setSTKL(int arg0);

	/** In RE4 enthaltene Versorgungsbezuege in Cents (ggf. 0) */
	public void setVBEZ(BigDecimal arg0);

	/** Vorsorgungsbezug im Januar 2005 bzw. fuer den ersten vollen Monat<br>
	             in Cents */
	public void setVBEZM(BigDecimal arg0);

	/** Voraussichtliche Sonderzahlungen im Kalenderjahr des Versorgungsbeginns<br>
	             bei Versorgungsempfaengern ohne Sterbegeld, Kapitalauszahlungen/Abfindungen<br>
	             bei Versorgungsbezuegen in Cents */
	public void setVBEZS(BigDecimal arg0);

	/** In SONSTB enthaltene Versorgungsbezuege einschliesslich Sterbegeld<br>
	            in Cents (ggf. 0) */
	public void setVBS(BigDecimal arg0);

	/** Jahr, in dem der Versorgungsbezug erstmalig gewaehrt wurde; werden<br>
	             mehrere Versorgungsbezuege gezahlt, so gilt der aelteste erstmalige Bezug */
	public void setVJAHR(int arg0);

	/** Kapitalauszahlungen / Abfindungen / Nachzahlungen bei Versorgungsbez�gen <br>
	             f�r mehrere Jahre in Cent (ggf. 0) */
	public void setVKAPA(BigDecimal arg0);

	/** Verg�tung f�r mehrj�hrige T�tigkeit ohne Kapitalauszahlungen und ohne Abfindungen <br>
				 bei Versorgungsbez�gen in Cent (ggf. 0) */
	public void setVMT(BigDecimal arg0);

	/** Zahl der Freibetraege fuer Kinder (eine Dezimalstelle, nur bei Steuerklassen<br>
	             I, II, III und IV) */
	public void setZKF(BigDecimal arg0);

	/** Zahl der Monate, fuer die Versorgungsbezuege gezahlt werden (nur<br>
	             erforderlich bei Jahresberechnung (LZZ = 1) */
	public void setZMVB(int arg0);

	/** In JRE4 enthaltene Entsch�digungen nach � 24 Nummer 1 EStG in Cent */
	public void setJRE4ENT(BigDecimal arg0);

	/** In SONSTB enthaltene Entsch�digungen nach � 24 Nummer 1 EStG in Cent */
	public void setSONSTENT(BigDecimal arg0);

	/** Bemessungsgrundlage fuer die Kirchenlohnsteuer in Cents */
	public BigDecimal getBK();

	/** Bemessungsgrundlage der sonstigen Einkuenfte (ohne Verguetung<br>
	             fuer mehrjaehrige Taetigkeit) fuer die Kirchenlohnsteuer in Cents */
	public BigDecimal getBKS();
	public BigDecimal getBKV();

	/** Fuer den Lohnzahlungszeitraum einzubehaltende Lohnsteuer in Cents */
	public BigDecimal getLSTLZZ();

	/** Fuer den Lohnzahlungszeitraum einzubehaltender Solidaritaetszuschlag<br>
	             in Cents */
	public BigDecimal getSOLZLZZ();

	/** Solidaritaetszuschlag fuer sonstige Bezuege (ohne Verguetung fuer mehrjaehrige<br>
	             Taetigkeit) in Cents */
	public BigDecimal getSOLZS();

	/** Solidaritaetszuschlag fuer die Verguetung fuer mehrjaehrige Taetigkeit in<br>
	             Cents */
	public BigDecimal getSOLZV();

	/** Lohnsteuer fuer sonstige Einkuenfte (ohne Verguetung fuer mehrjaehrige<br>
	             Taetigkeit) in Cents */
	public BigDecimal getSTS();

	/** Lohnsteuer fuer Verguetung fuer mehrjaehrige Taetigkeit in Cents */
	public BigDecimal getSTV();

	/** F�r den Lohnzahlungszeitraum ber�cksichtigte Beitr�ge des Arbeitnehmers zur<br>
				 privaten Basis-Krankenversicherung und privaten Pflege-Pflichtversicherung (ggf. auch<br>
				 die Mindestvorsorgepauschale) in Cent beim laufenden Arbeitslohn. F�r Zwecke der Lohn-<br>
				 steuerbescheinigung sind die einzelnen Ausgabewerte au�erhalb des eigentlichen Lohn-<br>
				 steuerbescheinigungsprogramms zu addieren; hinzuzurechnen sind auch die Ausgabewerte<br>
				 VKVSONST */
	public BigDecimal getVKVLZZ();

	/** F�r den Lohnzahlungszeitraum ber�cksichtigte Beitr�ge des Arbeitnehmers <br>
				 zur privaten Basis-Krankenversicherung und privaten Pflege-Pflichtversicherung (ggf. <br>
				 auch die Mindestvorsorgepauschale) in Cent bei sonstigen Bez�gen. Der Ausgabewert kann<br>
				 auch negativ sein. F�r tariferm��igt zu besteuernde Verg�tungen f�r mehrj�hrige <br>
				 T�tigkeiten enth�lt der PAP keinen entsprechenden Ausgabewert. */
	public BigDecimal getVKVSONST();

	/** Verbrauchter Freibetrag bei Berechnung des laufenden Arbeitslohns, in Cent */
	public BigDecimal getVFRB();

	/** Verbrauchter Freibetrag bei Berechnung des voraussichtlichen Jahresarbeitslohns, in Cent */
	public BigDecimal getVFRBS1();

	/** Verbrauchter Freibetrag bei Berechnung der sonstigen Bez�ge, in Cent */
	public BigDecimal getVFRBS2();

	/** F�r die weitergehende Ber�cksichtigung des Steuerfreibetrags nach dem DBA T�rkei verf�gbares ZVE �ber <br>
				dem Grundfreibetrag bei der Berechnung des laufenden Arbeitslohns, in Cent */
	public BigDecimal getWVFRB();

	/** F�r die weitergehende Ber�cksichtigung des Steuerfreibetrags nach dem DBA T�rkei verf�gbares ZVE �ber dem Grundfreibetrag <br>
				bei der Berechnung des voraussichtlichen Jahresarbeitslohns, in Cent */
	public BigDecimal getWVFRBO();

	/** F�r die weitergehende Ber�cksichtigung des Steuerfreibetrags nach dem DBA T�rkei verf�gbares ZVE <br>
				�ber dem Grundfreibetrag bei der Berechnung der sonstigen Bez�ge, in Cent */
	public BigDecimal getWVFRBM();
}