import java.util.*;

abstract class Search {
    public void getSearchResult(String word) {
        Match match = getSearchMethod();

        for (String searchedWord : list) {
            if (match.match(word, searchedWord)) {
                System.out.println(searchedWord);
            }
        }
    }

    protected abstract Match getSearchMethod();

    public List<String> list = Arrays.asList(
        "矢ヶ崎", "小笹", "岩村", "香取", "竹田", "伊藤", "橋下", "小畑", "小柳津", "中村", 
        "山本", "小谷", "城田", "所賀", "蓮見", "柴倉", "高橋", "髙橋", "笠井", "福富",
        "アヤン", "立石", "梅澤", "大竹", "近藤", "塚本"
    );
}
