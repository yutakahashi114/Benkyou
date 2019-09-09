import java.util.*;
import java.util.regex.*;

public class Main {
    public static void main(String[] args) {
        // 使うカード
        // ArrayList<Integer> cards = new ArrayList<Integer>(Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
        ArrayList<Integer> cards = new ArrayList<>();
        int card_number = 13;
        for (int i = 1; i <= card_number; i++) {
            cards.add(i);
        }
        // 参加する人
        ArrayList<String> member_names = new ArrayList<>();
        // 参加者の引いたカード
        ArrayList<Integer> member_cards = new ArrayList<>();

        // コマンドライン引数を格納
        String regex = "([A-Z]+)=([0-9]+)";
        for (String data : args) {
            Pattern p = Pattern.compile(regex);
            Matcher m = p.matcher(data);
            if (m.find()){
                member_names.add(m.group(1));
                member_cards.add((Integer.parseInt(m.group(2))));
            }
        }

        // 人を生成
        ArrayList<Person> member = new ArrayList<>();
        for(int i = 0; i < member_names.size(); i++) {
            // 見えている情報をセット
            LinkedHashMap<String, Integer> visible_card = new LinkedHashMap<>();
            for(int j = 0; j < member_cards.size(); j++) {
                if (i != j) {
                    // 自分以外のメンバーの数字
                    visible_card.put(member_names.get(j), member_cards.get(j));
                } else {
                    // 自分の数字は見えない。-1としておく。
                    visible_card.put(member_names.get(j), -1);
                }
            }
            member.add(new Person(member_names.get(i), cards, visible_card));
        }

        boolean result = false;
        int answer_count = 0;
        int member_count = member_names.size();
        while (!result) {
            if (answer_count > cards.size()) {
                System.out.println("");
                System.out.print("infinite loop");
                break;
            }
            Person answer_person = member.get(answer_count % member_count);
            String answer = answer_person.answerResult(answer_count);
            if (answer != "?") {
                result = true;
            }
            System.out.print(answer_person.name + " => " + answer + ", ");
            answer_count++;
        }
        System.out.println("");
    }
}
