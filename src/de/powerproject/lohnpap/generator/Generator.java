package de.powerproject.lohnpap.generator;

import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.net.URLClassLoader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;

import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.Attributes;
import org.xml.sax.SAXException;
import org.xml.sax.ext.LexicalHandler;
import org.xml.sax.helpers.DefaultHandler;

/**
 * 
 * Copyright 2015-2016 Marcel Lehmann
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 * 
 * 
 * @author Marcel Lehmann
 */

public class Generator {

	private static boolean interfaceGenerate = false;
	private static final Map<String, String> inputInterfaceVars = new HashMap<>();
	private static final Map<String, String> outputInterfaceVars = new HashMap<>();
	private static final Map<String, String> internalInterfaceVars = new HashMap<>();
	private static String codeLang = "PHP";
	private static List<String> codeLangList = Arrays.asList( "JAVA", "PHP" );

	public static void main(String[] args) throws Exception {
		
		if(args.length > 0 && codeLangList.contains(args[0])) codeLang = args[0];
		
		String projectDir = new File(".").getCanonicalPath();
		File targetDir = getFile(projectDir, "src", "de", "powerproject", "lohnpap");
		
		File xmlDir = getFile(projectDir, "src", "de", "powerproject", "lohnpap", "xml");
		File[] filesList = xmlDir.listFiles();
		final int len = filesList.length;
		
        //for(File f : filesList){
        for(int i = len - 1;i >= 0;i--){
            //if(f.isFile() && f.getName().endsWith(".xml")){
        		File f = filesList[i];
            	interfaceGenerate = (i == len - 1) ? true : false;
    			Generator g = new Generator(new PapFile(f.getName()), targetDir);
    			g.parse();
            //}
        }

		/*for (int i = 1; i < args.length; i++) {
			interfaceGenerated = (i == args.length - 1) ? false : true;
			Generator g = new Generator(new PapFile(args[i]), targetDir);
			g.parse();
		}*/
	}

	private static String getFilePath(String... elems) {

		StringBuilder sb = new StringBuilder();
		for (String e : elems) {
			sb.append(e);
			sb.append(File.separatorChar);
		}
		return sb.toString();
	}

	private static File getFile(String... elems) {

		return new File(getFilePath(elems));
	}
	
	public static String firstUpper(String s) {

		if (s != null) {
			if (s.length() == 1) {
				return s.toUpperCase();
			} else if (s.length() > 1) {
				return s.substring(0, 1).toUpperCase() + s.substring(1).toLowerCase();
			}
		}
		return s;
	}

	protected File path;
	protected PapFile pf;
	protected AbstractWriterInterface pw;
	protected AbstractWriterInterface piw;

	protected boolean failed = false;

	public Generator(PapFile pf, File path) throws Exception {

		this.pf = pf;
		this.path = path;
		
		if (interfaceGenerate) {
			Class<?>[] paramTypes = { String.class };
			Object[] params = { getFilePath(path.getCanonicalPath(), "pap", codeLang, "LohnsteuerInterface." + codeLang.toLowerCase()) };
			piw = (AbstractWriterInterface)new CustomLoader().load("de.powerproject.lohnpap.generator.PapWriter" + firstUpper(codeLang.toLowerCase()), paramTypes, params);
		    piw.writeWriterInterface();
		}
	}

	private void parse() throws Exception {

		System.out.println("parse file " + pf.xmlfileName);

		File file = getFile(path.getCanonicalPath(), "xml", pf.xmlfileName);

		SAXParserFactory f = SAXParserFactory.newInstance();
		SAXParser p = f.newSAXParser();

		p.setProperty("http://xml.org/sax/properties/lexical-handler", new PAPCommentReader());

		PapHandler h = new PapHandler();
		p.parse(file, h);

		if (piw != null) {
			piw.close();
		}

		if (failed) {
			throw new IOException("error occurred");
		}
	}
	
	public static class CustomLoader extends ClassLoader {
		public Object load(String className, Class<?>[] paramTypes, Object[] params) throws Exception {
            Class<?> loaded = loadClass(className);
            return loaded.getConstructor(paramTypes).newInstance(params);
        }
    }
	
	private boolean variables, constants, methods, method;
	private Map<String, String> inputVars = new HashMap<>();
	private Map<String, String> outputVars = new HashMap<>();
	private Map<String, String> internalVars = new HashMap<>();
	private Map<String, String> constVars = new HashMap<>();
	private Map<String, String> otherVars = new HashMap<>();
	private String lastComment = null;

	protected void printLastComment(AbstractWriterInterface writer) throws IOException {

		if (lastComment != null) {
			if (writer != null && !lastComment.isEmpty()) {
				writer.appendln();
				writer.writeln("/** " + lastComment + " */");
			}
			lastComment = null;
		}
	}
	
	class PapHandler extends DefaultHandler {
		
		@Override
		public void startElement(String uri, String localName, String qName, Attributes attributes)
				throws SAXException {
	
			try {
				if ("PAP".equals(qName)) {
					String internalName = attributes.getValue("name");
					Class<?>[] paramTypes = { PapFile.class, File.class, String.class };
					Object[] params = { pf, getFile(path.getCanonicalPath(), "pap", codeLang), internalName };
					pw = (AbstractWriterInterface)new CustomLoader().load("de.powerproject.lohnpap.generator.PapWriter" + firstUpper(codeLang.toLowerCase()), paramTypes, params);
				    pw.writeWriter(pf);
				} else if ("VARIABLES".equals(qName)) {
					variables = true;
				} else if ("CONSTANTS".equals(qName)) {
					constants = true;
					pw.appendln();
					pw.writeln("/* KONSTANTEN */");
				} else if ("METHODS".equals(qName)) {
					methods = true;
	
					pw.writeln("/* SETTER */");
	
					for (Entry<String, String> e : inputVars.entrySet()) {
						pw.appendln();
						if (inputInterfaceVars.containsKey(e.getKey())) {
							pw.writeln(pw.writeOverride());
						}
						pw.writeln(e.getValue());
					}
					for (Entry<String, String> e : inputInterfaceVars.entrySet()) {
						String name = e.getKey();
						if (!inputVars.containsKey(name)) {
							pw.appendln();
							pw.writeln(pw.writeOverride());
							if (internalVars.containsKey(name)) {
								pw.writeln(pw.writeSetMethodDef(e.getValue(), name));
							} else {
								pw.writeln(e.getValue() + " {  }// required for newer calculator");
							}
						}
					}
	
					pw.appendln();
					pw.writeln("/* GETTER */");
	
					for (Entry<String, String> e : outputVars.entrySet()) {
						pw.appendln();
						if (outputInterfaceVars.containsKey(e.getKey())) {
							pw.writeln(pw.writeOverride());
						}
						pw.writeln(e.getValue());
					}
					for (Entry<String, String> e : outputInterfaceVars.entrySet()) {
						String name = e.getKey();
						if (!outputVars.containsKey(name)) {
							pw.appendln();
							pw.writeln(pw.writeOverride());
							if (internalVars.containsKey(name)) {
								pw.writeln(pw.writeGetMethodDef(e.getValue(), name));
							} else {
								pw.writeln(e.getValue() + " {  return null; }// required for newer calculator");
							}
						}
					}
	
					pw.appendln();
	
					for (Entry<String, String> e : internalVars.entrySet()) {
						if (!outputInterfaceVars.containsKey(e.getKey())) {
							pw.appendln();
							if (internalInterfaceVars.containsKey(e.getKey())) {
								pw.writeln(pw.writeOverride());
							}
							pw.writeln(e.getValue());
						}
					}
					for (Entry<String, String> e : internalInterfaceVars.entrySet()) {
						String name = e.getKey();
						if (!internalVars.containsKey(name)) {
							pw.appendln();
							pw.writeln(pw.writeOverride());
							if (outputVars.containsKey(name)) {
								pw.writeln(pw.writeGetMethodDef(e.getValue(), name));
							} else {
								pw.writeln(pw.writeGetMethodStub(e.getValue()));
							}
						}
					}
	
					pw.appendln();
					
					pw.setOtherVars(otherVars);
					pw.setConstVars(constVars);
					pw.writeInit();
	
				} else if ("INPUT".equals(qName) || "OUTPUT".equals(qName) || "INTERNAL".equals(qName)) {
					if (variables) {
						String type = attributes.getValue("type");
						String name = attributes.getValue("name");
						String def = attributes.getValue("default");
						if (def == null) {
							if ("BigDecimal".equals(type)) {
								def = "new BigDecimal(0)";
							} else {
								def = "0";
							}
						}
						if ("int".equals(type)) {
							def = String.valueOf(Double.valueOf(def).intValue());
						}
	
						if ("INTERNAL".equals(qName)) {
							String pre = pw.writeGetMethod(name, type);
							internalVars.put(name, pw.writeGetMethodDef(pre, name));
							printLastComment(pw);
							//pw.writeln(pw.writeVar("public", type, name, def));
							if (piw != null) {
								piw.writeln(pre + ";");
								internalInterfaceVars.put(name, pre);
							}
						}
						
						pw.writeln(pw.writeVar("protected", type, name, def));
	
						if ("INPUT".equals(qName)) {
							String uname = name;
							String pre = pw.writeSetMethod(uname, type);
							inputVars.put(uname, pw.writeSetMethodDef(pre, name));
							printLastComment(piw);
							//pw.writeln(pw.writeVar("protected", type, name, def));
							if (piw != null) {
								piw.writeln(pre + ";");
								inputInterfaceVars.put(uname, pre);
							}
						} else if ("OUTPUT".equals(qName)) {
							String uname = name;
							String pre = pw.writeGetMethod(uname, type);
							outputVars.put(uname, pw.writeGetMethodDef(pre, name));
							printLastComment(piw);
							//pw.writeln(pw.writeVar("protected", type, name, def));
							if (piw != null) {
								piw.writeln(pre + ";");
								outputInterfaceVars.put(uname, pre);
							}
						}
						otherVars.put(name,def);
					}
				} else if ("CONSTANT".equals(qName)) {
					if (constants) {
						String type = attributes.getValue("type");
						String name = attributes.getValue("name");
						String value = attributes.getValue("value");
						constVars.put(name,value);
						pw.writeln(pw.writeConstant(type, name, value));
					}
				} else if ("MAIN".equals(qName)) {
					if (methods) {
						pw.writeln(pw.writeOverride());
						pw.writeln(pw.writeMainMethod());
						pw.incIndent();
					}
				} else if ("EXECUTE".equals(qName)) {
					String method = attributes.getValue("method");
					pw.appendln();
					pw.write(pw.writeExecMethod(method));
				} else if ("METHOD".equals(qName)) {
					String methodName = attributes.getValue("name");
					pw.writeln(pw.writeMethod(methodName));
					method = true;
					pw.incIndent();
				} else if ("EVAL".equals(qName)) {
					String exec = attributes.getValue("exec");
					pw.appendln();
					pw.write(pw.writeExec(exec));
				} else if ("IF".equals(qName)) {
					String expr = attributes.getValue("expr");
					pw.appendln();
					pw.write("if(" + pw.writeEval(expr) + ") ");
				} else if ("THEN".equals(qName)) {
					pw.append("{");
					pw.incIndent();
				} else if ("ELSE".equals(qName)) {
					pw.append(" else {");
					pw.incIndent();
				}
	
			} catch (Exception e) {
				e.printStackTrace();
				failed = true;
			}
		}
	
		@Override
		public void endElement(String uri, String localName, String qName) throws SAXException {
	
			try {
				if ("PAP".equals(qName)) {
					pw.close();
				} else if ("VARIABLES".equals(qName)) {
					variables = false;
				} else if ("CONSTANTS".equals(qName)) {
					constants = false;
					pw.appendln();
				} else if ("METHODS".equals(qName)) {
					methods = false;
				} else if ("METHOD".equals(qName)) {
					pw.decIndent();
					method = false;
					pw.appendln();
					pw.writeln("}");
					pw.appendln();
				} else if ("MAIN".equals(qName)) {
					pw.decIndent();
					pw.appendln();
					pw.writeln("}");
					pw.appendln();
					methods = false;
				} else if ("THEN".equals(qName) || "ELSE".equals(qName)) {
					pw.decIndent();
					pw.appendln();
					pw.write("}");
				}
			} catch (Exception e) {
				e.printStackTrace();
				failed = true;
			}
		}
	}

	class PAPCommentReader implements LexicalHandler {

		private int count = 0;

		@Override
		public void startDTD(String name, String publicId, String systemId) throws SAXException {
		}

		@Override
		public void endDTD() throws SAXException {
		}

		@Override
		public void startEntity(String name) throws SAXException {
		}

		@Override
		public void endEntity(String name) throws SAXException {
		}

		@Override
		public void startCDATA() throws SAXException {
		}

		@Override
		public void endCDATA() throws SAXException {
		}

		@Override
		public void comment(char[] ch, int start, int length) throws SAXException {

			try {

				String comment = new String(ch, start, length).trim();

				if (!comment.isEmpty()) {

					count++;

					if (lastComment != null) {

						printComment(lastComment);
						lastComment = null;
					}

					comment = comment.replace("\n", "<br>\n");

					if (count > 1) {
						if (variables) {
							lastComment = comment;
							return;
						}
					}

					printComment(comment);

				}

			} catch (Exception e) {
				e.printStackTrace();
				failed = true;
			}
		}

		private void printComment(String comment) throws IOException {

			if ("EINGABEPARAMETER".equals(comment) || "AUSGABEPARAMETER".equals(comment)
					|| "AUSGABEPARAMETER DBA".equals(comment)) {
				pw.appendln();
				pw.writeln("/* " + comment + "*/");
				pw.appendln();
			} else if ("INTERNE FELDER".equals(comment)) {
				pw.appendln();
				pw.writeln("/* " + comment + "*/");
			} else if (method) {
				pw.append("/** " + comment + " */");
			} else if (constants) {
				pw.appendln();
				pw.writeln("/** " + comment + " */");
			} else {
				pw.writeln("/** " + comment + " */");
			}
		}
	}
	
}
