import java.util.Scanner;

public class Main {
    public static void main(String argv[]) {
        System.out.print("検索文字列:");
        Scanner scan = new Scanner(System.in);
        String searchWord = scan.next();

        System.out.println("前方一致:");
        new ForwardMatchSearch().getSearchResult(searchWord);

        System.out.println("部分一致:");
        new PartialMatchSearch().getSearchResult(searchWord);

        System.out.println("完全一致:");
        new PerfectMatchSearch().getSearchResult(searchWord);
    }
}
