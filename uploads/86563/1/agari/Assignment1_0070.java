
public class Assignment1_0070 {
	private int a, b, c;
	private double discr;
	private double root1,root2;
	
	Assignment1_0070(){
		this.a = 2;
		this.b = 1;
		this.c = 2;
		this.discr = discr();
		findRoots();
	}
	
	public static void main(String args[]){
	}
	
	public double discr(){
		return (this.b*this.b)-(4*this.a*this.c);
	}
	
	public void findRoots(){
		if(discr<0){
			System.out.println("No Real Roots");
		} else if(discr==0){
			double root = (this.b - Math.sqrt(discr))/(2*this.a);
			System.out.println("Root: " + root);
		} else {
			double root = (this.b - Math.sqrt(discr))/(2*this.a);
			double root2 = (this.b + Math.sqrt(discr))/(2*this.a);
			

			System.out.println("Root: " + root);
			System.out.println("Root2 : " + root2);
		}
	}a
}
