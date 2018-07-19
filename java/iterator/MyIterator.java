public class MyIterator {
    private String[] array;
    private int now = 0;

    MyIterator(String[] array) {
        this.array = array;
    }

    // 次の値を持っているか判定
    public boolean hasNext() {
        if (this.array.length > this.now) {
            // 持っていればtrueを返す
            return true;
        }
        // 持っていなければfalseを返す
        return false;
    }

    // 次の値を持っていればそれを返す
    public String next() {
        if (this.hasNext() == true) {
            String next = this.array[this.now];
            this.now++;
            return next;
        } else {
            return "no next";
        }
    }

}
