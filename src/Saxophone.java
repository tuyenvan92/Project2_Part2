package fnms;
public class Saxophone extends Wind {
	private String type;

	public String getType() {
		return type;
	}

	public void setType(String type) {
		this.type = type;
	}
	public Saxophone() {
		super.name = "Cassette";
	}
}
