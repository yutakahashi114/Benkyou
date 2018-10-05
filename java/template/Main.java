import java.util.Scanner;

public class Main {
    public static void main(String argv[]) {
        SearchData search_person_data = new SearchPersonData("2018-01-01", "2018-12-12");
        Data search_person_data_result = search_person_data.search();
        SearchData search_company_data = new SearchCompanyData("2018-01-01", "2018-12-12");
        Data search_company_data_result = search_company_data.search();
    }
}
