import java.util.*;

public class Person {
    public String name;
    public int card;
    public ArrayList<Integer> all_card = new ArrayList<>();
    public LinkedHashMap<String, Integer> visible_card = new LinkedHashMap<>();
    public LinkedHashMap<String, ArrayList<Integer>> people_cards = new LinkedHashMap<>();

    public Person(String name, int card, ArrayList<Integer> cards, ArrayList<String> member, LinkedHashMap<String, Integer> visible_card) {
        this.name = name;
        this.card = card;
        this.visible_card = visible_card;
        for (int number : cards) {
            all_card.add(number);
        }

        for (String member_name : member) {
            // 値渡し
            ArrayList clone_cards = new ArrayList<>();
            for (int number : cards) {
                clone_cards.add(number);
            }
            this.people_cards.put(member_name, clone_cards);
        }
    }

    public ArrayList<Integer> getMyCard() {
        return this.people_cards.get(this.name);
    }

    public void deleteSuggestion(String name, int number) {
        ArrayList<Integer> target_card = this.people_cards.get(name);
        target_card.remove(target_card.indexOf(number));
    }

    public Boolean deleteSuggestionByOtherAnswer(String answer_person_name) {
        ArrayList<Integer> check_card = this.people_cards.get(answer_person_name);
        ArrayList<Integer> my_card = this.people_cards.get(this.name);
        ArrayList<Integer> impossible_numbers = new ArrayList<>();
        for (int number : my_card) {
            ArrayList clone_check_card = new ArrayList<>();
            for (int add_number : check_card) {
                clone_check_card.add(add_number);
            }
            clone_check_card.remove(clone_check_card.indexOf(number));

            ArrayList answer_visible_card = new ArrayList<>();
            for (String name : this.visible_card.keySet()) {
                if (name != answer_person_name) {
                    answer_visible_card.add(this.visible_card.get(name));
                }
            }
            answer_visible_card.add(number);

            String answer = this.checkImagineCard(clone_check_card, answer_visible_card);
            if (answer != "?") {
                // "?"以外であれば、そうなる数字を自分の候補から削除
                impossible_numbers.add(number);
            }
        }
        for (int impossible_number : impossible_numbers) {
            this.deleteSuggestion(this.name, impossible_number);
        }
        // 候補の削除が一度でも起きればtrueを返す
        return (impossible_numbers.size() > 0);
    }

    public String checkImagineCard(ArrayList<Integer> candidate_card, ArrayList<Integer> visible_number) {
        int candidate_min = candidate_card.stream().min((a, b) -> a.compareTo(b)).get();
        int candidate_max = candidate_card.stream().min((a, b) -> b.compareTo(a)).get();
        int visible_min = visible_number.stream().min((a, b) -> a.compareTo(b)).get();
        int visible_max = visible_number.stream().min((a, b) -> b.compareTo(a)).get();
        int mid_flag_number = 1;
        for (int one_visible_number : visible_number) {
            if ((one_visible_number < candidate_min) || (candidate_max < one_visible_number)){
                mid_flag_number *= 1;
            } else {
                mid_flag_number *= 0;
            }
        }
        boolean mid_flag = (mid_flag_number == 1);
        
        // 全ての候補が見えている数字より小さい
        if (candidate_max < visible_min) {
            return "MIN";
        // 全ての候補が見えている数字より大きい
        } else if (candidate_min > visible_max) {
            return "MAX";
        } else if (mid_flag) {
            return "MID";
        } else {
            return "?";
        }
    }

    public String checkMyCard() {
        ArrayList<Integer> my_card = this.people_cards.get(this.name);
        ArrayList visible_number = new ArrayList<>();
            for (String name : this.visible_card.keySet()) {
                visible_number.add(this.visible_card.get(name));
            }
        return this.checkImagineCard(my_card, visible_number);
    }
}
