package de.powerproject.lohnpap.generator;

import java.io.IOException;
import java.util.Map;

public interface AbstractWriterInterface {
	
	public void writeln() throws IOException;

	public void writeln(String s) throws IOException;

	public void write(String s) throws IOException;

	public void append(String s) throws IOException;

	public void appendln() throws IOException;

	public void write(String s, boolean tab, boolean newLine) throws IOException;

	public void incIndent();

	public void decIndent();
	
	public String writeSetMethod(String uname, String type);
	
	public String writeSetMethodDef(String pre, String name);
	
	public String writeGetMethod(String uname, String type);
	
	public String writeGetMethodDef(String pre, String name);
	
	public String writeConstant(String type, String name, String value);
	
	public String writeMainMethod();
	
	public String writeMethod(String methodName);
	
	public String writeExec(String exec);
	
	public String writeEval(String eval);
	
	public String writeVar(String type, String name, String def);
	
	public void writeWriter(PapFile p) throws IOException;
	
	public void writeWriterInterface() throws IOException;
	
	public void setInputVars(Map<String, String> inputVars);
	
	public void setOutputVars(Map<String, String> outputVars);
	
	public void setInternalVars(Map<String, String> internalVars);
	
	public void setConstVars(Map<String, String> internalVars);
	
	public void close() throws IOException;

}