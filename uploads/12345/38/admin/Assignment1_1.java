public class Assignment1_1 {

	public int a, b, c;
	public double root1, root2;
	
	public static void main(String[] args){
		int a = Integer.parseInt(args[0]);
		int b = Integer.parseInt(args[1]);
		int c = Integer.parseInt(args[2]);

		System.out.println();
		System.out.print(args[0] + ", ");
		System.out.print(args[1] + ", ");
		System.out.println(args[2]);

		//System.out.println(a + " " + b + " " +c);
		Assignment1_1 x = new Assignment1_1(a,b,c);
		x.findRoots();
	}
	
	public Assignment1_1(int a, int b, int c){
		this.a = a;
		this.b = b;
		this.c = c;
	}
	
	public double discr(){
		return (b*b)-(4*a*c);
	}
	
	public void findRoots(){
		if(discr()<0){
			System.out.println("No Real Roots");
		} else if(
		discr()==0){
			double root = (b - Math.sqrt(discr()))/(2*a);
			System.out.println("Root: " + root);
		} else {
			double root = (b - Math.sqrt(discr()))/(2*a);
			double root2 = (b + Math.sqrt(discr()))/(2*a);
			
			this.root1 = root;
			this.root2 = root2;

			System.out.println("Root: " + root);
			System.out.println("Root2: " + root2);
		}
	}
}
