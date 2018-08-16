public class Main {
    public static void main(String argv[]) {
        CreateNumber createNumber = new CreateNumber();
        Yeah yeah = new Yeah();
        createNumber.addObserver(yeah);
        createNumber.run();
    }
}
