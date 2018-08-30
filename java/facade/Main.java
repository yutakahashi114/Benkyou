public class Main {
    public static void main(String argv[]) {
        Obatasan obatasan = new Obatasan();
        Sakuraisan sakuraisan = new Sakuraisan();

        int licenseNumber = sakuraisan.getIntelliJ(obatasan.url, obatasan.cost, obatasan.cardNumber);
        System.out.println(licenseNumber);        
    }
}
