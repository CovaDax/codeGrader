import java.io.*;
import java.util.*;
import javax.tools.*;
import java.sql.*;

public class codeGrader {

	private String dir;
	private File files[];

	public codeGrader(String dir){
		this.dir = dir;
		readFiles(dir);
		gradeFiles();
	}

	public void readFiles(String dir){
		File folder = new File(dir);
		files = folder.listFiles();
		for(File file : files){
			if(file.isFile()){
				System.out.println(file.getName());
			}
		}
	}

	public void gradeFiles(){
		File compile;
		for(File file : file){
			if(file.getName == "Assignment1_0070.java");
		}
	}

	public static void main(String args[]){
		String dir = args[0];
		codeGrader cg = new codeGrader(dir);
	}

}