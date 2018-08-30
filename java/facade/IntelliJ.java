import java.lang.Math;

public class IntelliJ {
    public static int registerIntelliJ(String cardNumber) {
        if (!cardNumber.isEmpty()) {
            return (int) (Math.random() * 10000);
        }
        return -1;
    }
}
