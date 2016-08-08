package de.powerproject.lohnpap.generator;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Date;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.Map.Entry;

class PapWriterPhp extends AbstractWriter {

	private String className, internalName;
	
	public PapWriterPhp(PapFile p, File targetDir, String internalName) throws IOException {
		
		super(targetDir + File.separator + File.separator + p.name + ".php");
		this.className = p.name;
		this.internalName = internalName;
		
	}
	
	public PapWriterPhp(String fileName) throws IOException {
		super(fileName);
		this.className = "";
		this.internalName = "";
	}

	public void writeWriter(PapFile p) throws IOException {

		writeln("<?php");
		writeln();
		writeln("namespace Services;");
		writeln();
		writeln("/**");
		writeln(" * Klasse " + p.name);
		writeln(" * ");
		writeln(" * @author Christian Delfs");
		writeln(" */");
		writeln();
		writeln("class " + p.name + " implements LohnsteuerInterface {");
		appendln();
		incIndent();
	}
	
	public void writeWriterInterface() throws IOException {

		writeln("<?php");
		writeln();
		writeln("namespace Services;");
		writeln();
		writeln("/**");
		writeln(" * Interface LohnsteuerInterface");
		writeln(" * ");
		writeln(" * @author Christian Delfs");
		writeln(" */");
		writeln();
		writeln("interface LohnsteuerInterface {");

		incIndent();

		writeln();
		writeln("public function main();");
	}

	public String writeSetMethod(String uname, String type) {
		return "public function set" + uname + "($arg0)";
	}
	
	public String writeSetMethodDef(String pre, String name) {
		return pre + " { $this->" + name + " = $arg0; }";
	}
	
	public String writeGetMethod(String uname, String type) {
	
		return "public function get" + uname + "()";
	
	}
	
	public String writeGetMethodDef(String pre, String name) {
		return pre + " { return $this->" + name + "; }";
	}
	
	public String writeConstant(String type, String name, String value) {
		return "protected static $" + name + ";";// = " + value + "
	}
	
	public String writeMainMethod() {
		return "public function main() {";
	}
	
	public String writeMethod(String methodName) {
		return "protected function " + methodName + "() {";
	}
	
	public String writeExecMethod(String methodName) {
		return "$this->" + methodName + "();";
	}
	
	public String writeExec(String exec) {
		return pseudoToLang(exec) + ";";
	}
	
	public String writeEval(String eval) {
		return pseudoToLang(eval);
	}
	
	private String pseudoToLang(String code) {
		final List<String> objects = Arrays.asList("BigDecimal");
		final String codeClean = code.replaceAll("[\\t]+", "").replaceAll("(\\r\\n)+", "\\n").replace("&lt;", "<").replace("&gt;", ">").replace("&amp;", "&");//.replaceAll("([^a-zA-Z0-9_][\\s]*)\\((.*\\(.*\\))\\)\\.","$1$2.")
		final Pattern pattern = Pattern.compile("^[a-zA-Z_][a-zA-Z0-9_]*$");
		Matcher matcher;
		StringBuilder codeReturn = new StringBuilder();
		final int len = codeClean.length();
		int lastPos = 0;
		List<String> segs = new ArrayList<String>();
		for (int i = 0; i < len; i++) {
	    	final String c = Character.toString(codeClean.charAt(i));
	    	if(c.matches("^[^a-zA-Z0-9_]$")) {
	    		if(i > lastPos) segs.add(codeClean.substring(lastPos, i));
	    		segs.add(c);
	    		lastPos = i + 1;
	    	}
		}
    	if(lastPos < len) {
    		segs.add(codeClean.substring(lastPos, len));
    	}
    	final int segLen = segs.size();
		for(int i = 0;i < segLen;i++) {
			//final String prevSeg = (i == 0) ? "" : segs.get(i - 1);
			final String prevSeg = getPrevNonEmptySeg(segs,i);
			final String seg = segs.get(i);
			//final String nextSeg = (i + 1 == segLen) ? "" : segs.get(i + 1);
			final String nextSeg = getNextNonEmptySeg(segs,i);
			if(pattern.matcher(seg).matches()) {
				if(objects.contains(seg)) {
					codeReturn.append(seg);
				}else{
					if(otherVars.containsKey(seg)) {
						codeReturn.append("$this->" + seg);
					}else if(constVars.containsKey(seg)) {
						codeReturn.append("self::" + seg + "()");
					}else{
						codeReturn.append(seg);
					}
				}
			}else if(".".equals(seg)){
				if(pattern.matcher(prevSeg).matches()) {
					if(objects.contains(prevSeg)) {
						if(nextSeg.substring(0,1).matches("^[a-z]{1,1}")) codeReturn.append("::");
						else codeReturn.append("::$");
					}else{
						codeReturn.append("->");
					}
				}else if(")".equals(prevSeg) || "]".equals(prevSeg)) {
					codeReturn.append("->");
				}else{
					codeReturn.append(seg);
				}
			}else{
				codeReturn.append(seg);
			}
		}
		return codeReturn.toString();
	}
	
	private String getPrevNonEmptySeg(List<String> segs, int idx) {
		String segReturn = "";
		for(int i = idx - 1;i >= 0;i--) {
			if(!" ".equals(segs.get(i))) {
				segReturn = segs.get(i);
				break;
			}
		}
		return segReturn;
	}
	
	private String getNextNonEmptySeg(List<String> segs, int idx) {
		String segReturn = "";
		final int segLen = segs.size();
		for(int i = idx + 1;i < segLen;i++) {
			if(!" ".equals(segs.get(i))) {
				segReturn = segs.get(i);
				break;
			}
		}
		return segReturn;
	}
	
	public String writeVar(String type, String name, String def) {
		return "protected $" + name + ";";// = " + def + "
	}
	
	public String writeOverride() {
		return "";
	}
	
	public void writeInit() throws IOException {
		writeln("function __construct() {");
		for (Entry<String, String> e : otherVars.entrySet()) {
			writeln("$this->" + e.getKey() + "=" + pseudoToLang(e.getValue()) + ";");
		}
		for (Entry<String, String> e : constVars.entrySet()) {
			String valueReturn = e.getValue();
			if(valueReturn.startsWith("{")) {
				valueReturn = "array(" + pseudoToLang(valueReturn.substring(1, valueReturn.length() - 1)) + ")";
			}else{
				valueReturn = pseudoToLang(valueReturn);
			}
			
			writeln("self::$" + e.getKey() + "=" + valueReturn + ";");
		}
		writeln("}");
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
