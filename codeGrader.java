import java.io.*;
import java.util.*;
import javax.tools.*;
import java.sql.*;

public class codeGrader {

	Connection conn = null;

	public static void main(String args[]){
		for(String s : args) {
			//System.out.println(s);
		}
		System.out.println("Poop");
		getDB();
	}

	public void getDB(){

		System.out.println("Penis");	

		try{
			Statement query = null;

			//register driver
			Class.forName("com.mysql.jdbc.Driver");

			//open connection
			//conn = DriverManager.getConnection("jdbc:mysql://localhost/test?" + "user=root&password=password");
			conn = DriverManager.getConnection("root", "password");

			//make a query
			query = conn.CreateStatement();
			String sql = "SELECT * FROM users";
			ResultSet = rs = query.executeQuery(sql);

			while(rs.next()){
				int id = rs.getInt("id");
				String firstName = rs.getString("firstName");
					System.out.println(firstName);
				String lastName = rs.getString("lastName");
					System.out.println(lastName);
			}

			rs.close();
			query.close();
			conn.close();




		} catch (SQLException e){
			System.out.println("SQLException: " + ex.getMessage());
    		System.out.println("SQLState: " + ex.getSQLState());
    		System.out.println("VendorError: " + ex.getErrorCode());
		}
	}
}