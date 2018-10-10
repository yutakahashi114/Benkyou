import java.util.*;

public class Person {
    public String name;
    public ArrayList<Integer> all_card = new ArrayList<>();
    public LinkedHashMap<String, Integer> visible_card = new LinkedHashMap<>();

    public Person(String name, ArrayList<Integer> cards, LinkedHashMap<String, Integer> visible_card) {
        this.name = name;
        this.visible_card = visible_card;
        for (int number : cards) {
            all_card.add(number);
        }
    }

    public String answer(LinkedHashMap<String, Integer> visible_card, int answer_count) {
        ArrayList<Integer> answer_visible_number = new ArrayList<>();
        for (int number : visible_card.values()) {
            if (number != -1) {
                answer_visible_number.add(number);
            }
        }
        ArrayList<Integer> answer_candidate_number = new ArrayList<>();
        ArrayList<Integer> reduced_candidate_number = new ArrayList<>();
        for (int number : this.all_card) {
            if (answer_visible_number.indexOf(number) == -1) {
                answer_candidate_number.add(number);
                reduced_candidate_number.add(number);
            }
        }
        // 最初の回答の推測
        if (answer_count == 0) {
            return this.checkAssumedCard(answer_candidate_number, answer_visible_number);
        }
        // 2回目以降の回答の推測
        String now_person_name = "";
        String next_person_name = "";
        int count = 0;
        for (String name : visible_card.keySet()) {
            if (count == (answer_count % visible_card.size())) {
                now_person_name = name;
            }
            if (count == ((answer_count - 1) % visible_card.size())) {
                next_person_name = name;
            }
            count++;
        }
        for (int assumed_number : answer_candidate_number) {
            LinkedHashMap<String, Integer> assumed_visible_card = new LinkedHashMap<>();
            for (String name : visible_card.keySet()) {
                if (name == now_person_name) {
                    assumed_visible_card.put(name, assumed_number);
                } else if (name == next_person_name) {
                    assumed_visible_card.put(name, -1);
                } else {
                    assumed_visible_card.put(name, visible_card.get(name));
                }
            }
            String result = this.answer(assumed_visible_card, answer_count - 1);
            if (result != "?") {
                reduced_candidate_number.remove(reduced_candidate_number.indexOf(assumed_number));
            }
        }
        if (reduced_candidate_number.size() == 0) {
            return "";
        }
        return this.checkAssumedCard(reduced_candidate_number, answer_visible_number);
    }


    public String answerResult(int answer_count) {
        return this.answer(this.visible_card, answer_count);
    }

    public String checkAssumedCard(ArrayList<Integer> candidate_card, ArrayList<Integer> visible_number) {
        int candidate_min = candidate_card.stream().min((a, b) -> a.compareTo(b)).get();
        int candidate_max = candidate_card.stream().min((a, b) -> b.compareTo(a)).get();
        int visible_min = visible_number.stream().min((a, b) -> a.compareTo(b)).get();
        int visible_max = visible_number.stream().min((a, b) -> b.compareTo(a)).get();

        // 全ての候補の最大より大きい数字と全ての候補の最小より小さい数字が見えていればMID
        Boolean mid_min_flag = false;
        Boolean mid_max_flag = false;
        for (int one_visible_number : visible_number) {
            if (one_visible_number < candidate_min) {
                mid_min_flag = true;
            }
            if (candidate_max < one_visible_number){
                mid_max_flag = true;
            }
        }
        boolean mid_flag = (mid_min_flag && mid_max_flag);
        
        // 全ての候補が見えている数字より小さければMIN
        if (candidate_max < visible_min) {
            return "MIN";
        // 全ての候補が見えている数字より大きければMAX
        } else if (candidate_min > visible_max) {
            return "MAX";
        } else if (mid_flag) {
            return "MID";
        } else {
            return "?";
        }
    }
}
