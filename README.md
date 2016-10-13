PAP-Generator
==========

**Build Java-Code**

cd LohnPapGen

ant

**Run Generator**

cd LohnPapGen

java -cp bin de.powerproject.lohnpap.generator.Generator [LANG]

LANG = "PHP" | "JAVA" (Default PHP)

Generates Interface (LohnsteuerInterface.LANG) + Classes (Lohnsteuer...LANG) and put it into folder "src/de/powerproject/lohnpap/pap/LANG/".

**tax-calculator-api integration**

Copy generated Interface + Classes into project "tax-calculator-api" folder "app/src/.../Services/".

Copy files from "resources/PHP/" into project "tax-calculator-api" folder "app/src/.../Services/".

Change "namespace" for all (PHP) files from "Services" to "...\Services"