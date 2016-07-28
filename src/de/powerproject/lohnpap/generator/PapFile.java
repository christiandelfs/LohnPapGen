package de.powerproject.lohnpap.generator;

public class PapFile {

	String xmlfileName, name;

	public PapFile(String xmlfileName) {

		this.xmlfileName = xmlfileName;
		this.name = xmlfileName.replace(".xml", "");
	}

	public String getXmlfileName() {
		return xmlfileName;
	}

	public String getName() {
		return name;
	}
}