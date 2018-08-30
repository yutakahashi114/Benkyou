public class PurchaseRequest {
    public static boolean checkPurchaseRequest(String url, int cost) {
        if (!url.isEmpty() && cost < 100000000) {
            return true;
        }
        return false;
    }
}
