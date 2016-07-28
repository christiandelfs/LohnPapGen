package de.powerproject.lohnpap.generator;

import java.io.Closeable;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

abstract class AbstractWriter implements Closeable,AbstractWriterInterface {

	private FileWriter fw;
	private int indent = 0;
	protected Map<String, String> inputVars = new HashMap<>();
	protected Map<String, String> outputVars = new HashMap<>();
	protected Map<String, String> internalVars = new HashMap<>();
	protected Map<String, String> constVars = new HashMap<>();
	
	public AbstractWriter(String fileName) throws IOException {
		try {
			this.fw = new FileWriter(fileName);
		}catch ( IOException e ) {
			
		}
		
	}

	public void writeln() throws IOException {
		write(null, true, true);
	}

	public void writeln(String s) throws IOException {
		write(s, true, true);
	}

	public void write(String s) throws IOException {
		write(s, true, false);
	}

	public void append(String s) throws IOException {
		write(s, false, false);
	}

	public void appendln() throws IOException {
		write(null, false, true);
	}

	public void write(String s, boolean tab, boolean newLine) throws IOException {

		if (tab) {
			for (int i = 0; i < indent; i++) {
				fw.append('\t');
			}
		}

		if (s != null) {
			fw.append(s);
		}

		if (newLine) {
			fw.append('\n');
		}
	}

	public void incIndent() {
		this.indent++;
	}

	public void decIndent() {
		this.indent--;
	}

	@Override
	public void close() throws IOException {
		fw.close();
	}
	
	public void setInputVars(Map<String, String> inputVars) {
		this.inputVars = inputVars;
	}
	
	public void setOutputVars(Map<String, String> outputVars) {
		this.outputVars = outputVars;
	}
	
	public void setInternalVars(Map<String, String> internalVars) {
		this.internalVars = internalVars;
	}
	
	public void setConstVars(Map<String, String> constVars) {
		this.constVars = constVars;
	}
}