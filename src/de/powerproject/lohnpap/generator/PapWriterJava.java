package de.powerproject.lohnpap.generator;

import java.io.File;
import java.io.IOException;
import java.util.Date;

class PapWriterJava extends AbstractWriter {

	private String className, internalName;
	
	public PapWriterJava(PapFile p, File targetDir, String internalName) throws IOException {
		
		super(targetDir + File.separator + File.separator + p.name + ".java");
		this.className = p.name;
		this.internalName = internalName;
		
	}
	
	public PapWriterJava(String fileName) throws IOException {
		super(fileName);
		this.className = "";
		this.internalName = "";
	}

	public void writeWriter(PapFile p) throws IOException {

		writeln("package de.powerproject.lohnpap.pap;");
		writeln();
		writeln("import java.math.BigDecimal;");
		writeln();
		writeln("/**");
		writeln(" * ");
		writeln(" * @author Marcel Lehmann (https://github.com/MarcelLehmann/Lohnsteuer) ");
		writeln(" * @date " + new Date());
		writeln(" * ");
		writeln(" */");
		writeln();
		writeln("public class " + p.name + " implements LohnsteuerInterface {");
		appendln();
		incIndent();
	}
	
	public void writeWriterInterface() throws IOException {

		writeln("package de.powerproject.lohnpap.pap;");
		writeln();
		writeln("import java.math.BigDecimal;");
		writeln();
		writeln("/**");
		writeln(" * ");
		writeln(" * @author Marcel Lehmann (https://github.com/MarcelLehmann/Lohnsteuer) ");
		writeln(" * @date " + new Date());
		writeln(" * ");
		writeln(" */");
		writeln();
		writeln("public interface LohnsteuerInterface {");

		incIndent();

		writeln();
		writeln("public void main();");
	}

	public String writeSetMethod(String uname, String type) {
		return "public void set" + uname + "(" + type + " arg0)";
	}
	
	public String writeSetMethodDef(String pre, String name) {
		return pre + " { this." + name + " = arg0; }";
	}
	
	public String writeGetMethod(String uname, String type) {
	
		return "public " + type + " get" + uname + "()";
	
	}
	
	public String writeGetMethodDef(String pre, String name) {
		return pre + " { return this." + name + "; }";
	}
	
	public String writeConstant(String type, String name, String value) {
		return "protected static final " + type + " " + name + " = " + value + ";";
	}
	
	public String writeMainMethod() {
		return "public void main() {";
	}
	
	public String writeMethod(String methodName) {
		return "protected void " + methodName + "() {";
	}
	
	public String writeExec(String exec) {
		return exec + ";";
	}
	
	public String writeEval(String eval) {
		return eval;
	}
	
	public String writeVar(String type, String name, String def) {
		return "protected " + type + " " + name + " = " + def + ";";
	}

	@Override
	public void write(String s, boolean tab, boolean newLine) throws IOException {

		if (s != null && internalName != null) {
			s = s.replace(internalName, className);
		}

		super.write(s, tab, newLine);
	}

	@Override
	public void close() throws IOException {

		decIndent();

		write("}");

		super.close();
	}
}
