package fnms;
public class Shirts extends Clothing {
	private int shirtSize;

	public int getShirtSize() {
		return shirtSize;
	}

	public void setShirtSize(int shirtSize) {
		this.shirtSize = shirtSize;
	}
	public Shirts() {
		super.name = "Shirts";
	}
}
