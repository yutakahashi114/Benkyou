public class LegalAffairs {
    public static boolean checkLegalAffairs(String url, int cost) {
        if (!url.isEmpty() && cost < 100000000) {
            return true;
        }
        return false;
    }
}
