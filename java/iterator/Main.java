public class Main {
    public static void main(String argv[]) {
        DTUMember DTUMember = new DTUMember();
        MyIterator iterator = DTUMember.getIterator();
        System.out.println(iterator.hasNext());
        System.out.println(iterator.next());
        System.out.println(iterator.next());
        System.out.println(DTUMember.getAllMember());
    }
}
