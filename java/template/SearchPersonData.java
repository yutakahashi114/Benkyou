import java.util.*;

public class SearchPersonData extends SearchData {
    public String start_date;
    public String end_date;

    public SearchPersonData(String start_date, String end_date) {
        this.start_date = start_date;
        this.end_date = end_date;
    }

    public int getCount() {
        return 3;
    }

    public ArrayList getData() {
        ArrayList<LinkedHashMap<String, Object>> resources = new ArrayList();
        for (int i = 0; i < 3; i++) {
            LinkedHashMap<String, Object> resource = new LinkedHashMap<>();
            resource.put("a" + i, "a_person" + i);
            resource.put("b" + i, "b_person" + i);
            resources.add(resource);
        }
        return resources;
    }

}
