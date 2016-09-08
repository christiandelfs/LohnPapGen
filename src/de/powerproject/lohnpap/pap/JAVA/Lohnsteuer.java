package de.powerproject.lohnpap.pap.JAVA;

import java.util.Date;
import java.util.Calendar;

/**
* Klasse Lohnsteuer
*
* @author     Christian Delfs
*/

public class Lohnsteuer {

	public static LohnsteuerInterface getInstance() throws Exception {
		return getInstance(null);
	}

	public static LohnsteuerInterface getInstance(String name) throws Exception {

		if (name != null) {

			return (LohnsteuerInterface)new CustomLoader().load("de.powerproject.lohnpap.pap.JAVA.Lohnsteuer" + name, new Class<?>[0], new Object[0]);
			
		}

		return null;
	}
	
	public static class CustomLoader extends ClassLoader {
		public Object load(String className, Class<?>[] paramTypes, Object[] params) throws Exception {
            Class<?> loaded = loadClass(className);
            return loaded.getConstructor(paramTypes).newInstance(params);
        }
    }
}