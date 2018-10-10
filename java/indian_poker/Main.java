import java.util.*;
import java.util.regex.*;

public class Main {
    public static void main(String[] args) {
        // 使うカード
        ArrayList<Integer> cards = new ArrayList<Integer>(Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10));
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
                }
            }
            member.add(new Person(member_names.get(i), member_cards.get(i), cards, member_names, visible_card));
        }

        for(Person person : member) {
            for(int i = 0; i < member_names.size(); i++) {
                String name = member_names.get(i);
                int card = member_cards.get(i);
                if (person.name != name) {
                    // 自分から見えている他メンバーの数字を、自分の候補から削除
                    person.deleteSuggestion(person.name, card);
                    for(String imagine_name : person.people_cards.keySet()) {
                        if ((person.name != imagine_name) && (imagine_name != name)) {
                            // 自分から見えている他メンバーの数字を、他の候補から削除
                            person.deleteSuggestion(imagine_name, card);
                        }
                    }
                }
            }
        }

        boolean result = false;
        int index = 0;
        int member_count = member_names.size();
        int delete_count = 0;
        while (!result) {
            Person answer_person = member.get(index);
            String answer = answer_person.checkMyCard();
            if (answer != "?") {
                result = true;
            }
            System.out.print(answer_person.name + " => " + answer + ", ");
            
            int delete_flag_number = 0;
            for(Person check_person : member) {
                if (answer_person.name != check_person.name) {
                    // 他の回答から自分の候補を削除
                    Boolean delete_flag = check_person.deleteSuggestionByOtherAnswer(answer_person.name);
                    if (delete_flag) {
                        delete_flag_number++;
                    }
                }
            }
            // 候補の削除が1順回っても一度も起きなければ、無限ループになるのでbreak
            if (delete_flag_number == 0) {
                delete_count++;
            } else {
                delete_count = 0;
            }
            if (delete_count == member_count) {
                System.out.println("");
                System.out.print("Infinite loop");
                break;
            } 
            index++;
            index %= member_count;
        }
        System.out.println("");
    }
}
