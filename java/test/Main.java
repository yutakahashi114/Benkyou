import java.util.*;
import java.util.regex.*;

public class Main {
    public static void main(String[] args) {
        LinkedHashMap<String, Integer> assumed_visible_card = new LinkedHashMap<>();
        ArrayList<Integer> visible_card = new ArrayList<>();
        assumed_visible_card.put("aa", -1);
        assumed_visible_card.put("bb", 2);
        assumed_visible_card.put("cc", 3);
        int test = assumed_visible_card.size();
        System.out.println(assumed_visible_card);
        System.out.println(test);
        visible_card.add(1);
        visible_card.add(2);
        visible_card.add(3);
        System.out.println(visible_card.indexOf(4));
        
    }
}
