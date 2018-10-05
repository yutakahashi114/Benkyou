import java.util.*;

public abstract class SearchData {

    public abstract int getCount();
    public abstract ArrayList getData();

    public Data search() {
        Data data = new Data();
        // 件数検索
        data.total_count = getCount();

        if (data.total_count == 0) {
            System.out.println("件数:" + data.total_count);
        }

        // データ検索
        data.resources = getData();
        
        System.out.println("件数:" + data.total_count);
        System.out.println("データ:");
        for (LinkedHashMap<String, Object> resource : data.resources) {
            for (String key : resource.keySet()) {
                System.out.println(key + " => " + resource.get(key));
            }
        }
        return data;
    }
}
