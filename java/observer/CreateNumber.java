import java.lang.Math;

public class CreateNumber extends Subject {
    public int random;

    public void run() {
        int sum = 0;
        for (int i = 0; i < 100; i++) {
            int random = (int) (Math.random() * 101);
            sum += random;
            this.random = random;
            notifyObservers();
        }
        System.out.println("total count : " + sum);
    }
}
