public class Yeah implements Observer {
    public void update(Subject subject) {
        int random = ((CreateNumber) subject).random;
        String display = random + "";
        if (random % 3 == 0) {
            display += " : イエー！";
        }
        if (random % 5 == 0) {
            display += " : ウッス！";
        }
        System.out.println(display);
    }
}
