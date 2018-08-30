import java.util.*;

public class Sakuraisan {
    public int getIntelliJ(String url, int cost, String cardNumber) {
        List<String> messages = new ArrayList<String>();
        int licenseNumber = -1;
        if (!LegalAffairs.checkLegalAffairs(url, cost)) {
            messages.add("LegalAffairs is wrong");
        }
        if (!PurchaseRequest.checkPurchaseRequest(url, cost)) {
            messages.add("PurcahseRequest is wrong");
        }
        if (messages.size() > 0) {
            for (String message : messages) {
                System.out.println(message);
            }
            return licenseNumber;
        }
        
        licenseNumber = IntelliJ.registerIntelliJ(cardNumber);

        if (licenseNumber == -1) {
            System.out.println("CardNumber is wrong");
        }
        
        return licenseNumber;
    }
}
