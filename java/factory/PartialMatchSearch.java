class PartialMatchSearch extends Search {
    protected Match getSearchMethod() {
        return new PartialMatch();
    }
}
