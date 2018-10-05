import java.util.*;

public class SearchCompanyData extends SearchData {
    public String start_date;
    public String end_date;

    public SearchCompanyData(String start_date, String end_date) {
        this.start_date = start_date;
        this.end_date = end_date;
    }

    public int getCount() {
        return 4;
    }

    public ArrayList getData() {
        ArrayList<LinkedHashMap<String, Object>> resources = new ArrayList();
        for (int i = 0; i < 4; i++) {
            LinkedHashMap<String, Object> resource = new LinkedHashMap<>();
            resource.put("a" + i, "a_company" + i);
            resource.put("b" + i, "b_company" + i);
            resources.add(resource);
        }
        return resources;
    }

}
