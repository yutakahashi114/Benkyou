public class DTUMember implements Collection {
    private String[] nameList = {
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m",
        "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"
    };

    public MyIterator getIterator() {
        return new MyIterator(this.nameList);
    }
    public String getAllMember() {
        MyIterator iterator = this.getIterator();
        String result = "";
        while (iterator.hasNext() == true) {
            String name = iterator.next();
            result += name;
            result += "\n";
        }
        return result;
    }
}
