package fnms;
public class Harmonica extends Wind {
	private String key;

	public String getKey() {
		return key;
	}

	public void setKey(String key) {
		this.key = key;
	}
	public Harmonica() {
		super.name = "Harmonica";
	}
}
