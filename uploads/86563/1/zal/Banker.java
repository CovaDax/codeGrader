/* Author: Andrew Meyers
 * 
 * COP 4610 - Operating Systems
 * 
 * Assignment 7
 * 
 * Banker.java 
 * 
 * Last updated: November 12th, 2014
 * 
 */

public class Banker {
	
	/* Banker Private Variables */
	
	private int resources;
	private int customers;
	private int maxVector[][];
	private int requestVector[][];
	private int allocationVector[][];
	private int initialAvailable[];
	private int currentAvailable[];
	private int requestingVector[];
	
	/* Banker Constructor */
	
	// Receives a number of resources (resource types) and a number of customers (threads)
	// Constructor creates sets of random numbers for available resources 
	// Constructor creates random numbers for the maximum resources that each customer thread will request
	
	public Banker(int resources, int customers) {
		
		this.customers = customers;
		this.resources = resources;
		this.maxVector = new int[customers][resources];
		this.requestVector = new int[customers][resources];
		this.allocationVector = new int[customers][resources];
		this.initialAvailable = new int[resources];
		this.currentAvailable = new int[resources];
		
		
		// Initializing initialAvailable and currentAvailable to random values
		
		System.out.print("\nInitial Set of Resources Available:\n");
		System.out.print("[");
		
		for (int i = 0; i < resources; i++) {
			
			initialAvailable[i] = (int)Math.ceil(Math.random() * 10);
			currentAvailable[i] = initialAvailable[i];
			
			System.out.print(initialAvailable[i]);
			
			if (i < (resources - 1))
					System.out.print(", ");
		}
		
		System.out.print("]");
		
		// Initializing requestVector to random values
		// Customer's requests are randomized from 1 to 10
		
		System.out.print("\n\nMaximum Requests each Customer Makes: ");
		
		for(int i = 0; i < customers; i++) {
			
			System.out.print("\n[");
			
				for (int j = 0; j < resources; j++) {
					
					if (j%2 == 0) {
						
						requestVector[i][j] = (int)(Math.random() * (initialAvailable[j]));
					}
					
					else {
						
						requestVector[i][j] = (int)Math.ceil(Math.random() * (initialAvailable[j]));
					}
					
					maxVector[i][j] = requestVector[i][j];
					System.out.print(requestVector[i][j]);
					
					if (j < (resources - 1))
						System.out.print(", ");
				}
				
				System.out.print("]");
			
			
		}
		
		// Initialize allocationVector to zero
		
		for (int i = 0; i < customers; i++) {
			
			for (int j = 0; j < resources; j++) {
				
				allocationVector[i][j] = 0;
			}
		}	
	}
	
	// Prints Banker's Available Resources
	
	public void printResources() {
		
		System.out.print("\n[");
		
		for (int i = 0; i < resources; i++) {
			
			System.out.print(initialAvailable[i]);
			
			if (i < (resources - 1))
				System.out.print(", ");
		}
		
		System.out.print("]");	
	}
	
	// Prints Banker's Allocation Vector
	
	public void printBankAllocation() {
		
		for(int i = 0; i < customers; i++) {
			
			System.out.print("\n[");
			
			for(int j = 0; j < resources; j++) {
				
				System.out.print(allocationVector[i][j]);
				
				if(j < (resources - 1))
					System.out.print(", ");
			}
				System.out.print("]");
		}
	}

	
	// Checks if a customer's request has been satisfied
	
	public boolean checkIfComplete(int id) {
		
		for (int i = 0; i < resources; i++) {
			
			if (requestVector[id][i] != 0)
				
				return false;
		}
		
		return true;
	}
	
	
	// synchronized request() checks for thread safeStatety
	// Determines when a customer request can be granted or makes the customer wait until the request can be satisfied
	// When a request is possible to grant, this method checks for a safeState sequence 
	
	public synchronized int request(int ID, int numberOfRequests) {
		
		// Local Variables
		
		int Available;
		boolean requestGood = true;
		boolean safeState;
		this.requestingVector = new int[resources];
	
		
		if (numberOfRequests >= 3) {
			
			System.out.print("\n\nCustomer " + ID + " is requesting: ");
			System.out.print("[");
			
				for (int i = 0; i < resources; i++) {
					
					requestingVector[i] = requestVector[ID][i];
					System.out.print(requestingVector[i]);
					
					if (i < (resources - 1))
						System.out.print(", ");
				}
				
				System.out.print("]");
		}
		
		else {
			
			System.out.print("\n\nCustomer " + ID + " is requesting: ");
			System.out.print("[");
			
			for(int i = 0; i < resources; i++) {
				
				Available = requestVector[ID][i];
				requestingVector[i] = (int)Math.floor(Math.random() * Available);
				
				System.out.print(requestingVector[i]);
				
				if(i < (resources - 1))
					System.out.print(", ");
			}
			System.out.print("]");
		}
		
		while(requestGood)
		{
			for(int i = 0; i < resources; i++) {
				
				if(requestingVector[i] > currentAvailable[i]) {
					
					requestGood = false;
					System.out.print("\nCustomer " + ID + " request " + numberOfRequests + " not granted!");
					break;
				}
			}
			
			//Checks for safeState State if all are available
			if(requestGood) {
				
				safeState = true;
				
				for(int i = 0; i < resources; i++){
					
					if((currentAvailable[i] - requestingVector[i]) < (maxVector[ID][i] - (allocationVector[ID][i] + requestingVector[i]))) {
						
						safeState = false;
						break;
						
					}
				}
				
				if(safeState){
					
					System.out.print("\tSafe State!");
					
				}
				else {
		
					System.out.print("\tNot a Safe State!");
					System.out.print("\nCustomer " + ID + " request " + numberOfRequests + " not granted!");
					System.out.print("\nCustomer " + ID + " must wait.");
					requestGood = false;
					
					try {
						wait();
					}
					
					catch(InterruptedException e){
						
						System.out.print("Unknown error occurred...");
					}
				}
			}
			
			if(requestGood) {
				
				for(int i = 0; i < resources; i++) {
					
					currentAvailable[i] -= requestingVector[i];
					requestVector[ID][i] -= requestingVector[i];
				}
			
				for(int j = 0; j < resources; j++) {
					
					allocationVector[ID][j] += requestingVector[j];
				}
				
				System.out.print("\n\nBanker's Current Allocation: ");
				
				for(int i = 0; i < customers; i++) {
					
					System.out.print("\n[");
					
					for(int j = 0; j < resources; j++) {
						
						System.out.print(allocationVector[i][j]);
						
						if(j < (resources - 1))
							System.out.print(", ");
					}
					
					System.out.print("]");
				}
				
				System.out.print("\n\nCustomer "+ ID + " request " + numberOfRequests + " granted.");
				requestGood = false;
			}		
		}
		
		numberOfRequests++;
		return numberOfRequests;
	}

	public synchronized void returnResources(int id) {
	
		for(int i = 0; i < resources; i++) {
		
			currentAvailable[i] += allocationVector[id][i];
			allocationVector[id][i] = 0;
		}
	
		// Notify when all resources have been returned to the bank
		
		notifyAll();
	
		System.out.print("\n\n\n\t[Customer " + id + " has returned their resources and left the bank!]\n");
	
	}

}
