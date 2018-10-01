class  PerfectMatchSearch extends Search {
    protected Match getSearchMethod() {
        return new PerfectMatch();
    }
}
